		var swfu;
		var onLoadFunction;
		swfupload_load = function () {
			swfu = new SWFUpload({
				upload_url:"$upload_url",
				file_post_name:"$file_post_name",
				post_params: { $post_params },
				file_size_limit :"$file_size_limit",
				file_types :"$file_types_list",
				file_types_description :"$file_types_description",
				file_upload_limit :"$file_upload_limit",
				file_queue_limit :"$file_queue_limit",
				swfupload_loaded_handler : $swfupload_loaded_handler,
				file_queued_handler : $file_queued_handler,
				file_queue_error_handler : $file_queue_error_handler,
				file_dialog_start_handler : $file_dialog_start_handler,
				upload_start_handler: $upload_start_handler,
				file_dialog_complete_handler : $file_dialog_complete_handler,
				upload_progress_handler : $upload_progress_handler,
				upload_error_handler : $upload_error_handler,
				upload_success_handler : $upload_success_handler,
				upload_complete_handler : $upload_complete_handler,
				flash_url :"$flash_url",
				swfupload_element_id :"$swfupload_element_id",
				degraded_element_id :"$degraded_element_id",

				custom_settings : {
					progress_target :"$progress_target",
					upload_successful : $upload_successful
				},

				// Button Settings
				button_image_url : "$button_image_url",	// Relative to the SWF file
				button_placeholder_id : "spanButtonPlaceholder",
				button_width: $button_width,
				button_height: $button_height,
				button_text : "<span class='button'>$browse_button_text</span>",
				button_text_style : "$button_text_style",
				button_text_top_padding: $button_text_top_padding,
				button_text_left_padding: $button_text_left_padding,				
				
				// Debug settings
				debug: $debug
			});

		};
		
		window.onload = function() {
			swfupload_load();
		};
		
		
		
		
		