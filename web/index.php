<?php

/**
 * @author Andrew Grigorkin
 * @copyright 2019
 */

require_once __DIR__ . '/../vendor/autoload.php';

use core\Router;

date_default_timezone_set('Europe/Berlin');

session_start();

new Router();

// session_destroy();