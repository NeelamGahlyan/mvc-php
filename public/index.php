<?php

/**
 * Front controller
 * PHP 7
 */

require '../vendor/autoload.php';
/**
 * Autoloader
 * Now its commnted because we are using composer autoloader
 */
//spl_autoload_register(function ($class){
//       $root = dirname(__DIR__); //Get parent dir
//       $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
//       if(is_readable($file)){
//           require $root. '/' . str_replace('\\', '/', $class) . '.php';
//       }
//});

/**
 * Error and Exception handling
 * 
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

$router = new Core\Router();

$router->add('', ['controller' => 'Home', 'action' => 'index']);
//$router->add('posts/new', ['controller' => 'Posts', 'action' => 'new']);
$router->add('{controller}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);
$router->add('{controller}/{id:\d+}/{action}');
$url = $_SERVER['QUERY_STRING'];

//if($router->match($url)){
//    echo "<pre>";
//    var_dump($router->getParams());
//    echo "</pre>";
//} else{
//    echo "No route found";
//}

//echo "</pre>";
//echo htmlspecialchars(print_r($router->getRoutes(),true));
//echo "</pre>";


$router->dispatch($url);
