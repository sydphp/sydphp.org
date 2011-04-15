<?php

class SWFUploadConfig
{
	static $form_name;
	static $upload_url;
	static $file_destination_path;
	static $file_post_name;
	static $post_params;
	static $file_size_limit;
	static $file_types_list;
	static $file_types_description;
	static $browse_button_text;
	static $file_upload_limit;
	static $file_queue_limit;

	static $required;

	// Event handler settings
	static $swfupload_loaded_handler;
				
	static $file_dialog_start_handler;
	static $file_queued_handler;
	static $file_queue_error_handler;
	static $file_dialog_complete_handler;
				
	static $upload_start_handler;
	static $upload_progress_handler;
	static $upload_error_handler;
	static $upload_success_handler;
	static $upload_complete_handler;

	// Flash Settings
	static $flash_url;

	// UI settings
	static $swfupload_element_id;
	static $degraded_element_id;
			
	static $progress_target;
	static $upload_successful;
	
	// Button settings
	static $button_image_url;
	static $button_width;
	static $button_height;
	static $button_text_style;
	static $button_text_top_padding;
	static $button_text_left_padding;
	
	// Debug settings
	static $debug = "false";
	
	// Silverstripe settings
	static $default_upload_dir = "Uploads";
	
	static function addFileType($type)
	{
		if(self::$file_types_list == '*.*')
			self::$file_types_list = '';
    $file_str = '*.' . str_replace('.','',strtolower($type)) .';'.
                '*.' . str_replace('.','',strtoupper($type)) .';';
    if(stristr(self::$file_types_list,$file_str) === false)
  		self::$file_types_list .= $file_str;
	}
	
	static function addFileTypes($types)
	{	
		if(is_array($types)) {
			foreach($types as $type)
				self::addFileType($type);
		}
	}
	
	// Deprecated. Used addStaticPostParam()
	static function addPostParam($param, $value)
	{
		self::addStaticPostParam($param, $value);
	}

	static function addStaticPostParam($param, $value)
	{
    $param_str = "'" . $param . "' : '" . $value . "'";			
    if(stristr(self::$post_params,$param_str) === false) {
  		if(!empty(self::$post_params))
  			self::$post_params .= ",";
      self::$post_params .= $param_str;
    }
	}

	// Deprecated. Use addStaticPostParams()
	static function addPostParams($params)
	{
		self::addStaticPostParams($params);
	}

	static function addStaticPostParams($params)
	{
		if(is_array($params)) {
			foreach($params as $param => $value)
				self::addStaticPostParam($param,$value);
		}
	}
	
	static function addDynamicPostParam($name, $id)
	{
		self::addStaticPostParam('__dynamic__'.$name, $id);
	}
	
	static function addDynamicPostParams($params)
	{
		if(is_array($params)) {
			foreach($params as $name => $id)
				self::addDynamicPostParam($name, $id);
		}
	}
	
	static function debug()
	{
		self::set_var('debug','true');
	}

	static function get_var($var)
	{
		return self::$$var;
	}
	
	static function set_var($var, $value)
	{
		if(property_exists('SWFUploadConfig', $var))
			self::$$var = $value;
	}
	
	static function set_default_upload_dir($dir)
	{
		self::$default_upload_dir = $dir;
	}
	
	static function Configure($properties)
	{
		if(is_array($properties))
		{
			foreach($properties as $k => $v)
			{
				if(property_exists('SWFUploadConfig', $k))
				{
					self::$$k = $v;
				}
			}
		}
	}
	
	static function DumpConfiguration()
	{
		return get_class_vars(__CLASS__);
	}
	
	static function Bootstrap()
	{
		Requirements::css('swfupload/css/swfupload.css');

		Requirements::javascript('swfupload/javascript/swfupload.js');
		Requirements::javascript('swfupload/javascript/swfupload.graceful_degradation.js');
		Requirements::javascript('swfupload/javascript/fileprogress.js');
		Requirements::javascriptTemplate('swfupload/javascript/swfupload_vars.js', array(
			'form_name' => self::get_var('form_name'),
			'required' => self::get_var('required')
		));
		Requirements::javascript('swfupload/javascript/handlers.js');
		Requirements::javascriptTemplate('swfupload/javascript/swfu.js', self::DumpConfiguration());	
	}
	
	
}



?>