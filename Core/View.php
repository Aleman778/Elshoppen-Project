<?php

    namespace Core;

    /**
     * Static view class used to render html files.
     */
    class View {

        private static $viewDir = "";

        /**
         * Renders a view.
         * 
         * @param string $view the html view file
         * @param array $args array of data to display in view (optional)
         * 
         * @return void
         */
        public static function render($view, $args = []) {
            extract($args, EXTR_SKIP);
            $file = View::$viewDir . $view;
            if (is_readable($file)) {
                require $file;
            } else {
                throw new \Exception("The file \"$file\" was not found.");
            }
        }

        /**
         * Renders a view template using Twig.
         * 
         * @param string $template the html template file
         * @param array $args array of data to display in view (optional)
         * 
         * @return void
         */
        public static function renderTemplate($template, $args = []) {
            static $twig = null;

            if ($twig === null) {
                $loader = new \Twig_Loader_Filesystem(View::$viewDir);
                $twig = new \Twig_Environment($loader);
            }

            echo $twig->render($template, $args);
        }

        /**
         * Set the view directory.
         * 
         * @param string $dir the view directory
         * 
         * @return void
         */
        public static function setViewDirectory($dir) {
            View::$viewDir = dirname(__DIR__) . $dir;
        }

    }

?>