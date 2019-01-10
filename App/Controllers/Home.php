<?php

    namespace App\Controllers;

    use \Core\View;

    /**
     * Home controller is the root of the website.
     */
    class Home extends \Core\Controller {
        
        public function indexAction() {
            View::renderTemplate("Home/index.html");
        }

        public function loginAction() {
            View::renderTemplate("Home/login.html");
            $user = User::fromSession();
        }

    }


?>