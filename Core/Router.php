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
    public function add($route, $params = [])
    {
        // Convert the route to a regular expression: escape forward slashes
        $route = preg_replace('/\//', '\\/', $route);

        // convert variables eg {controller}
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

        // convert variables with custom regular expressions eg {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        // add start and end delimiters and case insensitive flag
        $route = '/^' . $route . '$/i';

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
            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }
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

    /**
     * @param $url
     */
    public function dispatch($url)
    {
        if ($this->match($url)) {
            $controller = $this->params['controller'];
            $controller = $this->convertToStudlyCaps($controller);

            if (class_exists($controller)) {
                $controller_object = new $controller();
                $action            = $this->params['action'];
                $action            = $this->convertToCamelCase($action);

                if (is_callable([$controller_object, $action])) {
                    $controller_object->$action();
                } else {
                    echo "Method $action (in controller $controller) not found.";
                }
            } else {
                echo "Controller class $controller not found.";
            }
        } else {
            echo "No route matched.";
        }
    }

    /**
     * @param $string
     * @return mixed
     */
    protected function convertToStudlyCaps($string)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    protected function convertToCamelCase($string) {
        return lcfirst($this->convertToStudlyCaps($string));
    }

}