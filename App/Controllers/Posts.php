<?php

namespace App\Controllers;

use Core\View;
use App\Models\Post;

/**
 * Post controller
 * PHP version 7
 */
class Posts extends \Core\Controller {
    /**
     * show index page
     * @return void
     */
    public function indexAction(){
        $posts = Post::getAll();
        View::renderTemplate('Posts/index.html', [
            'posts' => $posts
        ]);
    }
    
    /**
     * Show the add new page
     * @return void
     */
    public function addNewAction(){
        echo "Hello, You are at Posts Controller's add new page";
    }
    
    /**
     * Show the edit page
     * @return void
     */
    public function editAction(){
        echo "Hello, You are in edit of postcontroller ";
        echo "<p>Parameters are: <pre>".
        htmlspecialchars(print_r($this->route_params, true))."</pre></p>";
        
    }
}