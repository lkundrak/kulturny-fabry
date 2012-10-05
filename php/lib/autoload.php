<?php
$path = $_ENV['OPENSHIFT_REPO_DIR'].'php/';

if(!defined('AUTOLOAD')) {
	if(substr(phpversion(), 0, 1) == '5') {
		function __autoload($class) {
			GLOBAL $path;
			
			if(!class_exists($class, false)) {
			    	if(file_exists(sprintf('%slib/%s.class.php', $path, $class))) {
						include_once(sprintf('%slib/%s.class.php', $path, $class));
				}
			}
		}
	}
    define('AUTOLOAD', 1);
}

include_once($path.'header.php');
?>
