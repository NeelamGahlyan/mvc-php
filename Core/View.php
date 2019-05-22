<?php
/**
 * View Rendering functionality
 * PHP 7
 */

namespace Core;

class View{
    /**
     * Check if view file exits and then embed it into the code
     * 
     * @param string $view The file name
     * 
     * @return void
     */
    public static function render($view, $args=[]){
        //== extract the arguments into variables
        extract($args, EXTR_SKIP);
        
        $file = "../App/Views/$view";
        
        if(is_readable($file)){
            require $file;
        } else{
            echo "$file not found";
        } 
    }
    /**
     * Render view template using twig
     * 
     * @param string $template The template file
     * @param array $args Associative araay of the data to display in the view
     * 
     * @return void
     */
    public static function renderTemplate($template, $args=[]){
        static $twig = NULL;
        
        if($twig === NULL){
            $loader = new \Twig_Loader_Filesystem('../App/Views');
            $twig = new \Twig_Environment($loader);
        }
        echo $twig->render($template, $args);
    }
}

