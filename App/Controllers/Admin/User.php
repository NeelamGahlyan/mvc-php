<?php

namespace App\Controllers\Admin;

/**
 * Admin User controller
 * PHP 7
 */

class User extends \Core\Controller {
    /**
     * Show the index page
     * @return void
     */
    public function indexAction(){
        echo "Hello from index page of Admin Controller";
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