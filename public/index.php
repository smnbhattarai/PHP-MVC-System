<?php

/**
 * Autoload composer dependencies
 */
require __DIR__ . '/../vendor/autoload.php';

/**
 * Routing
 */
$router = new \Core\Router();

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);

$router->dispatch($_SERVER['QUERY_STRING']);
