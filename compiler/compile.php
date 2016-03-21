<?php

/**
 * CommonJS compiler
 *
 * Write CommonJS-syntax JavaScript modules and deliver them to clients as a single file.
 *
 * How does it work
 *
 *
 * @author Simaranjit Singh <simaranjit.singh@virdi.me>
 */

require_once __DIR__ . '/utils/autoload.php';

(new \CommonJS\CommonJS())->save(true);


