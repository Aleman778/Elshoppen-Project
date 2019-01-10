<?php 
    //Composer autoload function
    require dirname(__DIR__) . "/vendor/autoload.php";

    //Custom autoload function
    spl_autoload_register(function ($class_name) {
        require "../" . str_replace('\\', '/', $class_name) . ".php";
    });

    //Set the view directory
    Core\View::setViewDirectory("/App/Views/");

    //Setup router
    $router = new Core\Router();
    $router->setNamespace("App\Controllers\\");
    $router->add("", ["controller" => "Home", "action" => "index"]);
    $router->add("login/", ["controller" => "Home", "action" => "login"]);
    $router->add("{controller}/{action}");
    
    $router->dispatch($_SERVER["QUERY_STRING"]);
?>