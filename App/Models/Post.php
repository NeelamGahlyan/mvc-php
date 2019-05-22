<?php

namespace App\Models;

use Core\DB;
use PDO;
/**
 * Post Model
 * PHP 7
 */
class Post extends DB {
    /**
     * Get all the posts as an associative array 
     * @retun array
     */
    public static function getAll(){
        try{
            $db = DB::getDB();
            
            $data = $db->query('Select id, title, content FROM posts');
            $result = $data->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;

        } catch (Exception $ex) {

        }
    }
}

