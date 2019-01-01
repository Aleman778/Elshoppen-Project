<?php 
    //Composer autoload function
    require "vendor/autoload.php";

    //Custom autoload function
    spl_autoload_register(function ($class_name) {
        include $class_name . '.php';
    });

    //Set the view directory
    Core\View::setViewDirectory("/App/Views/");

    //Setup router
    $router = new Core\Router();
    $router->setNamespace("App\Controllers\\");
    $router->add("", ["controller" => "Home", "action" => "index"]);
    $router->add("{controller}/{action}");
    
    $router->dispatch($_SERVER["QUERY_STRING"]);
?>