<?php

use MattCG\cjsDelivery\Delivery;

/**
 * cjsDelivery
 *
 * Write CommonJS-syntax JavaScript modules and deliver them to clients as a single file.
 *
 * @author Matthew Caruana Galizia <m@m.cg>
 * @copyright Copyright (c) 2012, Matthew Caruana Galizia
 * @package cjsDelivery
 */

require_once __DIR__ . '/autoload.php';

$includes = array('../source/modules');
$delivery = Delivery::create(array('includes' => $includes));
$delivery->addModule('../source/main');
$delivery->setMainModule('../source/main');
//$content = $delivery->getOutput();
$content = JShrink\Minifier::minify($delivery->getOutput());

file_put_contents('../js/script.js', $content);