<?php

namespace App\Controllers;

use Core\View;

/**
 * Home controller
 * PHP 7
 */

class Home extends \Core\Controller {
    /**
     * Show the index page
     * @return void
     */
    public function indexAction(){
        View::renderTemplate('Home/index.html', [
            'name' => "Neelam",
            "colours" => ['red', 'green', 'blue']
        ]);
    }
    
    /**
     * implement before filter
     * @return void
     */
    protected function before() {
        echo "Before method";
    }
    
    /**
     * implement after filter
     * 
     * @return void
     */
    protected function after(){
        echo "After method called";
    }
}