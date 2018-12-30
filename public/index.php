<?php 
    spl_autoload_register(function ($class_name) {
        include "../" . $class_name . '.php';
    });

    echo "Hello World. Routing to: " . $_SERVER["QUERY_STRING"];

    $router = new Core\Router();
    $router->add("", ["controller" => "Home", "action" => "index"]);
    $router->add("{controller}/{action}");
    $router->dispatch($_SERVER["QUERY_STRING"]);

?>