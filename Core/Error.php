<?php

namespace Core;

/**
 * Error and Exception Handler
 * Php version 7
 */
class Error{
    /**
     * Error Handler. Convert all errors to Exception by throwning an ErrorException
     * 
     * @param int $level (Error Level)
     * @param string $message (Error Message)
     * @param string $file (Filename of the error raised)
     * @param int $line Line number
     */
    public static function errorHandler($level, $message, $file, $line){
        if(error_reporting() !== 0){
            throw new \ErrorException($message, 0, $level, $file, $line);
        }
    }
    
    /**
     * Exception Handler
     * @param Exception $exception The exception
     * @return void
     */
    public static function exceptionHandler($exception){
        echo "<h1>Fatal Error</h1>";
        echo "<p>Uncaught Exception :".$exception->getMessage()."</p>";
        echo "<p>Stack trace<pre>".$exception->getTraceAsString()."</pre></p>";
        echo "<p><Thrown In '".$exception->getFile."' on Line".$exception->getLine()."";
        
    }
}
