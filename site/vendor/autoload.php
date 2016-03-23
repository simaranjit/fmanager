<?php

// Or, using an anonymous function as of PHP 5.3.0
spl_autoload_register(function ($class) {
    $class = explode('\\', $class);
    $primary = array_shift($class);

    if ($primary != 'fmanager') {
        return;
    }

    $class = implode('\\', $class);

    include str_replace('\\', '/', $class) . '.php';
});