<?php

/**
 * Autoload classes
 */
define('BASE_PATH', realpath(dirname(__FILE__)));

function mvc_autoloader($class)
{
    $filename = BASE_PATH . '/lib/' . str_replace('\\', '/', $class) . '.php';

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

$base = new Base;

$bugaga = new Test\Bugaga;

$bad = new Test\Bad;

?>
