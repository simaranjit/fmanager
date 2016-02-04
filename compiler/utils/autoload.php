<?php

// Or, using an anonymous function as of PHP 5.3.0
spl_autoload_register(function ($class) {
	$firstChunk = explode('\\', $class)[0];

	include 'utils/'.$firstChunk . '/src/' . str_replace('\\', '/', $class) . '.php';
});