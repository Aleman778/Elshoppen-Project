<?php

    namespace Core;

    /**
     * Abstract controller.
     */
    abstract class Controller {
        
        /**
         * The params given by the route.
         */
        protected $params;

        /**
         * Constructor.
         * 
         * @param $param the parameters from the route
         * 
         * @return void
         */
        public function __construct($params) {
            $this->params = $params;
        }

        /**
         * Magic method called when non-existent or inaccessible method is called.
         * This method is specifically used to direct the user to an action method,
         * e.g. indexAction(), showAction() etc. It is also used to call before()
         * and after() methods.
         * 
         * @param $name the name of the method
         * @param $args the arguments passed to the method
         * 
         * @return void
         */
        public function __call($name, $args) {
            $method = $name . "Action";
            if (method_exists($this, $method)) {
                if ($this->before() !== false) {
                    call_user_func_array([$this, $method], $args);
                    $this->after();
                }
            } else {
                throw new \Exception("Method $method not found in controller \"" . get_class($this) . "\".");
            }
        }

        /**
         * Before method is called before an action method.
         * 
         * @return void
         */
        public function before() { }
        
        /**
         * After method is called before an action method.
         * 
         * @return void
         */
        public function after() { }
    }

?>