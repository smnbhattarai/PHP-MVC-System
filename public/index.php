<?php

/**
 * Front Controller
 */

//echo 'Request URL = ' . $_SERVER['QUERY_STRING'];

require_once '../Core/Router.php';

$router = new Router();

//echo get_class($router);

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
$router->add('posts/new', ['controller' => 'Posts', 'action' => 'new']);


// Display routing table
//echo '<pre>';
//print_r($router->getRoutes());
//echo '</pre>';


// Match the requested route
$url = $_SERVER['QUERY_STRING'];

if($router->match($url)) {
    echo '<pre>';
    print_r($router->getParams());
    echo '</pre>';
} else {
    echo 'No route fould for URL: ' . $url;
}