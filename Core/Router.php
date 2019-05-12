<?php
/**
 * Router
 * PHP version 7
 */
class Router{
    /**
     * associative array of routes
     * @var array
     */
    protected $routes = [];
    /**
     * Add a route to routing table
     * @param string $route the route URL
     * @param array $params Parameters (controller, action, etc)
     * return void
     */
    public function add($route, $params){        
        $this->routes[$route] = $params;            
    }
    
    /**
     * get all the routes from routing table
     * @return array
     */
    
    public function getRoutes(){
        return $this->routes;
    }
}
