<?php
	SWFUploadConfig::Configure( array(
		
		// Backend settings
		'upload_url' => Director::absoluteURL('SWFUploadControls/handleswfupload'),
		'file_post_name' => 'swfupload_file',
		'post_params' => '',
		
		// Flash file settings
		'file_size_limit' => str_replace("M","MB",ini_get('upload_max_filesize')),	
		'file_types' => '*.*',
		'file_types_description' => '',
		'browse_button_text' => 'Browse...',
		'file_upload_limit' => '100',
		'file_queue_limit' => '100', // This isn't needed because the upload_limit will automatically place a queue limit
	
    'required' => 'false',
    
		// Event handler settings
		'swfupload_loaded_handler' => 'swfUploadLoaded',
					
		'file_dialog_start_handler' => 'fileDialogStart',
		'file_queued_handler' => 'fileQueued',
		'file_queue_error_handler' => 'fileQueueError',
		'file_dialog_complete_handler' => 'fileDialogComplete',
					
		'upload_start_handler' => 'uploadStart',
		'upload_progress_handler' => 'uploadProgress',
		'upload_error_handler' => 'uploadError',
		'upload_success_handler' => 'uploadSuccess',
		'upload_complete_handler' => 'uploadComplete',
		
	
		// Flash Settings
		'flash_url' => Director::absoluteURL('swfupload/javascript/swfupload.swf'),
	
		// UI settings
		'swfupload_element_id' => 'flashUI',		// setting for the graceful degradation plugin
		'degraded_element_id' => 'degradedUI',
				
		'progress_target' => 'fsUploadProgress',
		'upload_successful' => 'false',
		
		// Button settings
		'button_image_url' => Director::absoluteURL('swfupload/images/upload_button.png'),	// Relative to the SWF file
		'button_placeholder_id' => 'spanButtonPlaceholder',
		'button_width' => '180',
		'button_height' => '24',
		'button_text_style' => '.button { font-family: Helvetica, Arial, sans-serif; font-size: 12px; }',
		'button_text_top_padding' => '6',
		'button_text_left_padding' => '6'
		
	));
	
Director::addRules(10, array(
	'swfuploadfile/$Action/$Class/$ID/$Field' => 'SWFUploadFileIFrameField_Uploader'
));
	
?>