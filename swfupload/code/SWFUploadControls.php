<?php

class SWFUploadControls extends Controller
{
	public static $image_class = "Image";
	public static $file_class = "File";
	
	public function handleswfupload()
	{
		if (isset($_FILES["swfupload_file"]) && is_uploaded_file($_FILES["swfupload_file"]["tmp_name"])) {
			$ext = strtolower(end(explode('.', $_FILES['swfupload_file']['name'])));
			$class = in_array($ext, array('jpg','jpeg','gif','png')) ? self::$image_class : self::$file_class;
			$file = new $class();
			$u = new Upload();
			$dir = SWFUploadConfig::get_var('default_upload_dir');
			if(!$dir) $dir = "Uploads";
			$u->loadIntoFile($_FILES['swfupload_file'], $file, $dir);
			$file->write();			
			echo $file->ID;
		} 
		else {
			echo ' '; // return something or SWFUpload won't fire uploadSuccess
		}
		
	}
}