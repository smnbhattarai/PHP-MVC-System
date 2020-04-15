<?php

/**
 * Autoload composer dependencies
 */
require __DIR__ . '/../vendor/autoload.php';

/**
 * Error and exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

/**
 * Routing
 */
$router = new \Core\Router();

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('{controller}/{action}');

$router->dispatch($_SERVER['QUERY_STRING']);
