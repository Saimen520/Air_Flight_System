<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Logging
 *
 * @author SHABI
 */
require_once '../../config/database.php';
require_once 'EmailValidation.php';

require_once '../../helper/SessionClass.php';
require_once '../Model/UserController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    SessionClass::start();

    
    $LogPas = isset($_POST['textPas']) ? trim($_POST['textPas']) : null;
    
    $u = new UserController();
    try {
        $loginResult = $u->UserLogin($LogPas);

        if ($loginResult === true) {
            
            header('Location:../View/Home.php');
            exit();
        } else {
            
            echo "<script>alert('Invalid Account or Password.Login Attempts Left ".$loginResult."'); window.location.href = '../View/Login.html';</script>";
            exit();
        }
    } catch (Exception $e) {
        
        echo "<script>alert('An unexpected error occurred: " . $e->getMessage() . "'); window.location.href = '../View/Login.html';</script>";
        exit();
    }
}