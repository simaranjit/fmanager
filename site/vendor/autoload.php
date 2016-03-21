<?php

// Or, using an anonymous function as of PHP 5.3.0
spl_autoload_register(function ($class) {
    $class = explode('\\', $class);
    array_shift($class);

    $class = implode('\\', $class);

    include str_replace('\\', '/', $class) . '.php';
});