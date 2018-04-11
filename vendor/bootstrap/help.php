<?php 

if (!function_exists('autoload')) {
	function autoload($class){
          $name           =   strstr($class, '\\', true); 
          $path       =   ROOT_PATH.'/' ;
          $filename       =   $path . str_replace('\\', '/', $class) . '.class.php';
          if(is_file($filename)) {
              include $filename;
          }
	}
}


if (!function_exists('config')) {
	function config($config){
		if (strpos('.', $config) !== false) {
			
		}else{
			// $config = require __CONFIG'config'.php
		}
	}
}


















 ?>