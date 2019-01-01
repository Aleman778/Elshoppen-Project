<?php

    namespace Core;

    /**
     * Router class is used to direct the user to a requested controller and action.
     */
    class Router {

        /**
         * Dictionary of routes.
         */
        protected $routes = [];

        /**
         * List of currently matched parameters.
         */
        protected $params = [];

        /**
         * The current active namespace defined.
         */
        protected $namespace = "";

        /**
         * Add a new route and the parameters of that route.
         * 
         * @param string $route the route to add
         * @param array $params an array of parameters
         * 
         * @return void
         */
        public function add($route, $params = []) {
            $route = preg_replace('/\//', '\\/', $route);
            $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
            $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
            $route = '/^' . $route . '$/i';
            $this->routes[$route] = $params;
        }

        /**
         * Check if the given url matches with any of the provided routes.
         * 
         * @param string $url the route url
         * 
         * @return boolean true if a match found, false otherwise
         */
        public function match($url) {
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
         * Dispatch the user to the requested controller, if there is no matched route
         * an exception is thrown.
         * @param $url the url to dispatch
         * @return void
         */
        public function dispatch($url) {
            $url = $this->removeQueryVars($url);
            if ($this->match($url)) {
                $controller = $this->params["controller"];
                $controller = $this->getNamespace() . $controller;
                if (class_exists($controller)) {
                    $controllerObject = new $controller($this->params);
                    $action = $this->params["action"];
                    if (preg_match('/action$/i', $action) == 0) {
                        $controllerObject->$action();
                    } else {
                        throw new \Exception("Method $action in controller $controller cannot be called directly - remove the Action suffix to call this method.");
                    }
                } else {
                    throw new \Exception("Controller class \"$controller\" not found.");
                }
            } else {
                throw new \Exception("No route matched.");
            }

        }

        /**
         * Remove the variables in the $_SERVER["QUERY_STRING"].
         * e.g. if input is "foo&bar=1" then the function returns only "foo".
         */
        protected function removeQueryVars($url) {
            if ($url != "") {
                $parts = explode("&", $url, 2);
                if (strpos($parts[0], "=") === false) {
                    $url = $parts[0];
                } else {
                    $url = "";
                }
            }
            return $url;
        }
        
        /**
         * Get the namespace used by this route.
         */
        protected function getNamespace() {
            $namespace = $this->namespace;
            if (array_key_exists("namespace", $this->params)) {
                $namespace .= $this->params["namespace"] . "\\";
            }
            return $namespace;
        }

        /**
         * Set a different namespace.
         */
        public function setNamespace($namespace) {
            $this->namespace = $namespace;
        }

        /**
         * Get all the routes defined.
         */
        public function getRoutes() {
            return $routes;
        }

        /**
         * Get all the currently matched parameters.
         */
        public function getParams() {
            return $params;
        }
    }

?>