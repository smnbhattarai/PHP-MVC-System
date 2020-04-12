<?php

/**
 * Front Controller
 */

//echo 'Request URL = ' . $_SERVER['QUERY_STRING'];

require_once '../Core/Router.php';
require_once '../App/Controllers/Posts.php';

$router = new Router();

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');

$router->dispatch($_SERVER['QUERY_STRING']);
