<?php
namespace Core;
/**
 * Base controller
 * PHP 7
 */

abstract class Controller {
    /**
     * Parameters to match route
     * @var array
     */
    protected $route_params = [];
    
    /**
     * Class constructor 
     * @param array $route_params Parameters from the route
     * @return void
     */
    public function __construct($route_params) {
        return $this->route_params = $route_params;
    }
    
    /**
     * call magic method
     * @params string $name of the method to be called
     * @params array $args Arguments to be passed for the method
     * return void
     */
    public function __call($name, $args) {
        $method = $name . "Action";
        
        if(method_exists($this, $method)){
            if($this->before() !== false) {
                call_user_func_array([$this, $method], $args);
            }
        } else{
            //echo "Method $method not found in controller". get_class($this);
            throw new Exception("Method $method not found in controller ". get_class());
        }
    }
    
    /**
     * Before filter - to be called before any action method
     * @return void
     */
    protected function before(){}
    
    /**
     * After filter - to be called after any action method
     * @return void
     */
    protected function after(){}
}

