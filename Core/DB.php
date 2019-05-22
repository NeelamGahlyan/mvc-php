<?php

namespace Core;

use PDO;
use App\Config;

/**
 * Base DB model
 * 
 * PHP 7
 */

abstract class DB{
    /**
     * Get the PDO Database connection
     * 
     * @return mixed
     */
    protected static function getDB(){
        static $DB = null;
        
        if($DB === null){
            $host = Config::DB_HOST;
            $dbname = Config::DB_NAME;
            $username = Config::DB_USER;
            $password = Config::DB_PASSWORD;
            
            try {
                $DB = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
                              
            } catch (\PDOException $ex) {
                echo $ex->getMessage();

            }
            return $DB;

        }
    }
}
