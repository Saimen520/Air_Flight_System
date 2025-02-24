<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of SessionClass
 *
 * @author SHABI
 */
class SessionClass {
    
    private static $timeout = 1800; 

    public static function start(){
        
        
        
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > self::$timeout) {
            
            self::destroy();
            header("Location: ../Booking_App/View/email.html"); 
            exit();
        }
        
        
        $_SESSION['LAST_ACTIVITY'] = time();

        if (!isset($_SESSION['Logged'])) {
            $_SESSION['Logged'] = false; 
        }
    }
    
    public static function set($key, $value){
        $_SESSION[$key] = $value;
    }
    
    public static function get($key) {
        return $_SESSION[$key] ?? null;
    }
    
    public static function has($key){
        return isset($_SESSION[$key]);
    }
    
    public static function remove($key){
        if(self::has($key)){
            unset($_SESSION[$key]);
        }
    }
    
    public static function destroy(){
        if (session_status() != PHP_SESSION_NONE) {
            session_unset();
            session_destroy();
            $_SESSION = array(); 
        }
    }
}

