<?php
spl_autoload_register(function($file_name) {
	// echo $file_name;die;
	if(file_exists('classes/models/'.$file_name.'.php')) {
		if(is_readable('classes/models/'.$file_name.'.php')) {
			include 'classes/models/'.$file_name.'.php';
		}
	}
});
