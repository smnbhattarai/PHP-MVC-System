<?php

class Router
{

    /**
     * The routing table
     * @var array
     */
    protected $routes = [];

    /**
     * Parameters for matched route
     * @var array
     */
    protected $params = [];

    /**
     * Add route to routing table
     * @param $route
     * @param $params
     * @return void
     */
    public function add($route, $params) {
        $this->routes[$route] = $params;
    }

    /**
     * Get all routes from routing table
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * Match the route to the routes in the routing table. setting
     * $params property if a route is found.
     * @param $url
     * @return bool
     */
    public function match($url)
    {
        foreach ($this->routes as $route => $params) {
            if($url == $route) {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    /**
     * Get the currently matched parameters
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

}