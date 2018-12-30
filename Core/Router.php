<?php

namespace Core;

class Router {

    protected $routes = [];

    protected $params = [];

    public function add($route, $params = []) {
        $route = preg_replace('/\//', '\\/', $route);
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
        $route = '/^' . $route . '$/i';
        echo $route;
    }

    public function getRoutes() {
        return $routes;
    }

    public function dispatch($query) {
        foreach ($routes as $route) {
            if ($route.match())
        }
    }
}

?>