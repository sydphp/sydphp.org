var start_seconds;

function swfUploadLoaded() {
	if(document.getElementById("Form_"+form_name)) {
		form = document.getElementById("Form_"+form_name);
	}
	else {
		for(var i = 0; i < document.forms.length; i++) {
			if(document.forms[i].id.match(form_name)) {
				form = document.forms[i];
				break;
			}
		}
	}

	inputs = form.getElementsByTagName("input");
	
	for(var i = 0; i < inputs.length; i++)
	{
		if(inputs[i].type == 'submit')
		{
			btnSubmit = inputs[i];
			break;
		}
	}
	
	btnSubmit.onclick = doSubmit;
	if(required) {
		btnSubmit.style.display = 'none';
	}
	txtFileNames = document.getElementById("file_list");


}


function fileBrowse() {
	if(this.settings.file_upload_limit > 1)
		this.selectFiles();
	else
		this.selectFile();
}


// Called by the submit button to start the upload
function doSubmit(e) {
	e = e || window.event;
	if (e.stopPropagation) {
		e.stopPropagation();
	}
	e.cancelBubble = true;
	
		var params = swfu.settings.post_params;
		for(var name in params) {
			if(name.match('__dynamic__')) {
				key = name.replace('__dynamic__','');
				value = document.getElementById(params[name]).value;
				swfu.addPostParam(key,value);
			}
		}
		
    // validation
    if(typeof(form.onsubmit) == 'function' && !form.onsubmit())
      return false;
    
		btnSubmit.disabled=true;
		if(swfu.getStats().files_queued > 0)
			swfu.startUpload();
		else
		  form.submit();
	return false;
}

 // Called by the queue complete handler to submit the form
function uploadDone() {
}

function uploadStart()
{
	d = new Date();
	start_seconds = d/1000;
}


function fileQueueError(file, errorCode, message)  {
	try {
		// Handle this error separately because we don't want to create a FileProgress element for it.
		switch (errorCode) {
		case SWFUpload.QUEUE_ERROR.QUEUE_LIMIT_EXCEEDED:
			alert("You have attempted to queue too many files.\n" + (message == 0 ? "You have reached the upload limit." : "You may select " + (message > 1 ? "up to " + message + " files." : message)));
			return;
		case SWFUpload.QUEUE_ERROR.FILE_EXCEEDS_SIZE_LIMIT:
			size = file.size/1024/1024
			alert("The file you selected is too big. The maximum size allowed is " + swfu.settings.file_size_limit + ". This file is " + (Math.round(size*10)/10)+'M');
			this.debug("Error Code: File too big, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			return;
		case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:
			alert("The file you selected is empty.  Please select another file.");
			this.debug("Error Code: Zero byte file, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			return;
		case SWFUpload.QUEUE_ERROR.INVALID_FILETYPE:
			alert("The file you choose is not an allowed file type.");
			this.debug("Error Code: Invalid File Type, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			return;
		default:
			alert("An error occurred in the upload. Try again later.");
			this.debug("Error Code: " + errorCode + ", File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			return;
		}
	} catch (e) {
	}
}

function fileQueued(file) {
	try {
		li = document.createElement("li");
		li.setAttribute('id', 'file-' + file.id);
		filename = new String(file.name);
		if(filename.length > 30)
			filename = filename.substr(0,29) + '...';
			
		li.innerHTML = "<div class='queue-file-name'>" + filename + "</div><div class='queue-remove-btn'><a href='javascript:void(0);' onclick='return removeFileFromQueue(\""+file.id+"\");'>remove</a></div>";
		txtFileNames.appendChild(li);
		btnSubmit.style.display = 'block';
		var progress = new FileProgress(file, 'file-' + file.id);
		progress.setProgress(0);
		meg = file.size > 1024*1024;
		size = meg ? file.size/1024/1024 : file.size/1024;
		rounded = Math.round(size*10)/10;
		formatted = meg ? rounded : addCommas(Math.ceil(rounded));
		suffix = meg ? 'M' : 'k';
		progress.setStatus('Queued ('+formatted+suffix+')');
		progress.fileProgressElement.childNodes[2].className = 'progressBarStatus queued';
				
	} catch (e) {
	}

}

function removeFileFromQueue(file_id) {
	swfu.cancelUpload(file_id);
	txtFileNames.removeChild(document.getElementById("file-"+file_id));
	if(!txtFileNames.childNodes.length) {
		btnSubmit.style.display = 'none';
	}
	return false;
}

function fileDialogStart(numFilesSelected, numFilesQueued)
{

}
function fileDialogComplete(numFilesSelected, numFilesQueued) {
	
}

function uploadProgress(file, bytesLoaded, bytesTotal) {
	try {
		var percent = Math.ceil((bytesLoaded / bytesTotal) * 100);

		//file.id = "singlefile";	// This makes it so FileProgress only makes a single UI element, instead of one for each file
		var progress = new FileProgress(file, 'file-' + file.id);
		progress.fileProgressElement.childNodes[2].className = 'progressBarStatus progress';		
		progress.setProgress(percent);
		if(percent == 100)
			progress.setStatus("Processing...");
		else {
			// Get the rate
			d = new Date();
			current_seconds = d/1000;
			elapsed_seconds = Math.floor(current_seconds - start_seconds);
			
			bps = Math.ceil(bytesLoaded/elapsed_seconds);
			kbps = Math.ceil(bps/1024);
			
			// Calculate time remaining
			remaining_bytes = bytesTotal - bytesLoaded;
			diff = remaining_bytes/bps;
			seconds = zeroPad(Math.floor(diff % 60));
			diff = diff/60;
			minutes = zeroPad(Math.floor(diff % 60));
			diff = diff/60;
			hours = zeroPad(Math.floor(diff % 24));
			diff = diff/24;
			time = new String(hours+":"+minutes+":"+seconds+" remaining ("+kbps+"kb/sec)");
			// don't show a time until the upload has been going for a bit
			if(elapsed_seconds <= 5) {
				progress.setStatus("Uploading...");
			}
			else {
					progress.setStatus("Uploading..." + time);
			}
		}
	} catch (e) {
		alert(e);
	}
}

function uploadSuccess(file, serverData) {
	try {
		if(swfu.settings.debug)
			alert("Server said " + serverData);
			
		//file.id = "singlefile";	// This makes it so FileProgress only makes a single UI element, instead of one for each file
		var progress = new FileProgress(file, 'file-' + file.id);
		progress.setComplete();
		progress.setProgress(100);
		progress.setStatus("Complete.");
		progress.toggleCancel(false);
		
		if (serverData === " ") {
			this.customSettings.upload_successful = false;
		} else {
			this.customSettings.upload_successful = true;
			hidden = document.createElement('input');
			hidden.setAttribute('type','hidden');
			hidden.setAttribute('value', serverData);
			hidden.setAttribute('name','uploaded_files[]');
			form.appendChild(hidden);
		}
		
	} catch (e) {
		alert(e);
	}
}

function uploadComplete(file) {
	try {
		if (this.customSettings.upload_successful) {
	
			//btnBrowse.disabled = "true";
			try {
				if (this.getStats().files_queued > 0) {
					swfu.startUpload();
				}
				else {
					if(!swfu.settings.debug) {
						form.submit();
					}
				}
			} catch (ex) {
				alert("Error submitting form:" + ex);
			}
		} else {
			txtFileNames.removeChild(document.getElementById("file-"+file.id));
			alert("There was a problem with the upload.\nThe server did not accept it.\n ");
		}
	} catch (e) {
	}
}

function uploadError(file, errorCode, message) {
	try {
		
		// Handle this error separately because we don't want to create a FileProgress element for it.
		switch (errorCode) {
		case SWFUpload.UPLOAD_ERROR.MISSING_UPLOAD_URL:
			alert("There was a configuration error.");
			this.debug("Error Code: No backend file, File name: " + file.name + ", Message: " + message);
			return;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_LIMIT_EXCEEDED:
			alert("You may only upload 1 file.");
			this.debug("Error Code: Upload Limit Exceeded, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			return;
		case SWFUpload.UPLOAD_ERROR.FILE_CANCELLED:
		case SWFUpload.UPLOAD_ERROR.UPLOAD_STOPPED:
			break;
		default:
			alert("An error occurred in the upload. Try again later.");
			this.debug("Error Code: " + errorCode + ", File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			return;
		}

		switch (errorCode) {
		case SWFUpload.UPLOAD_ERROR.HTTP_ERROR:
			progress.setStatus("Upload Error");
			this.debug("Error Code: HTTP Error, File name: " + file.name + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_FAILED:
			progress.setStatus("Upload Failed.");
			this.debug("Error Code: Upload Failed, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.IO_ERROR:
			progress.setStatus("Server (IO) Error");
			this.debug("Error Code: IO Error, File name: " + file.name + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.SECURITY_ERROR:
			progress.setStatus("Security Error");
			this.debug("Error Code: Security Error, File name: " + file.name + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.FILE_CANCELLED:
			progress.setStatus("Upload Cancelled");
			this.debug("Error Code: Upload Cancelled, File name: " + file.name + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_STOPPED:
			progress.setStatus("Upload Stopped");
			this.debug("Error Code: Upload Stopped, File name: " + file.name + ", Message: " + message);
			break;
		}
	} catch (ex) {
	}
	
	
}


function addCommas(nStr)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}

function zeroPad(num) {
	var s = '0'+num;
	return s.substring(s.length-2)
}

