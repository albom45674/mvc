<?php

/**
 * Autoload classes
 */
define('MVC_DIR', realpath(dirname(__FILE__)));

function mvc_autoloader($class)
{
    $filename = MVC_DIR . '/lib/' . str_replace('\\', '/', $class) . '.php';

	if (file_exists($filename) && is_readable($filename)) {
	    require_once($filename);
	} else {
		throw new Exception('I can\'t create class: ' . $class);
	}
}

spl_autoload_register('mvc_autoloader');

/**
 * Testing
 */

?>
