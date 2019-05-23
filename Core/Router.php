<?php

namespace Core;

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
    /**
     * parameters from the matched route
     * @var array
     */
    protected $params = [];
    /**
     * match the route to the routes in the routing table, setting the $params property if a route is found
     * @param string $url The route URL
     * @return boolean true if match found, false otherwise
     */
    public function match($url){
       // $reg_exp = "/^(?P<controller>[a-zA-Z]+)\/(?P<action>[a-zA-Z]+)$/";
        foreach($this->routes as $route => $params){
            if(preg_match($route, $url, $matches)){
                foreach($matches as $key=>$match){
                    if(is_string($key)){
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
     * Get the currently matched parameters
     * @return array
     */
    public function getParams(){
       return $this->params;
    }
    /**
     * 
     * @param type $route
     * @param type $params
     * @return void
     */
    
    
    public function add($route, $params=[]){        
        //convert the route to a regular expression: escape forward slashes
        $route = preg_replace('/\//', '\\/', $route);
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
        $route = '/^'.$route.'$/i';
        $this->routes[$route] = $params;            
    }
    
    /**
     * get all the routes from routing table
     * @return array
     */
    
    public function getRoutes(){
        return $this->routes;
    }
    /**
     * dispatching -- create controller object and run the method
     * @param string $url The route URL
     * @return void
     */
    public function dispatch($url){
        $url = $this->removeQueryStringVariables($url);
        
        if($this->match($url)){
            $controller = $this->params['controller'];
            $controller = $this->convertToStudlyCaps($controller);
            $controller = $this->getNamespace() . $controller;
            if(class_exists($controller)){
                $controller_object = new $controller($this->params);
                $action = $this->params['action'];
                $action = $this->convertToCamelCase($action);
                $methodVariable = array($controller_object, $action);
                if(is_callable($methodVariable, false)){
                    $controller_object->$action();
                } else{
                    //echo "Method $action not found in $controller";
                    throw new \Exception("Method $method nof found in (controller $controller)");
                }
            } else{
                throw new \Exception("Controller class $controller not found");
            }
                    
        } else{
            echo "$url not found";
        }
        
    }
    /**
     * convert the string with hyphen to studlyCaps
     * e.g post-author > PostAuthors
     * @params string $string The string to convert
     * @return string
     */
        
    protected function convertToStudlyCaps($string){
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }
        
    /**
     * convert the string with hyphen to cameCase
     * e.g post-author => postAuthor
     * @param string $string
     * @return string
     */
    protected function convertToCamelCase($string){
        return lcfirst($this->convertToStudlyCaps($string));
    }
    
    /**
     * @param string $url The full URL
     * @return string  The URL with the query string removed
     */
    protected function removeQueryStringVariables($url){
        if($url != ''){
            $parts = explode("&", $url, 2);
            
            if(strpos($parts[0], '=') === false){
                $url = $parts[0];
            } else{
                $url = '';
            }
        }
        return $url;
    }
    
    /**
     * Get the Namespace of the controller class. The namespace defined from the route will be added
     * @return string The request URL 
     */
    protected function getNamespace(){
        $namespace = 'App\Controllers\\';
        
        if(array_key_exists('namespace', $this->params)){
            $namespace .= $this->params['namespace'] . '\\';
        }
        
        return $namespace;
    }
        
}
