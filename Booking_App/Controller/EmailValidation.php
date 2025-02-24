<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
require_once dirname(__FILE__) . '/../../config/database.php';
require_once dirname(__FILE__) . '/../../helper/SessionClass.php';
class EmailValidation extends Database{
    
    private $Email ;
    
    public function __construct() {
        parent::__construct();
        
      
        
    }
    public function getEmail() {
        
        return $this->Email;
    }

    public function setEmail($Email) {
        
             $this->Email = $Email;
    }
    
    public function CheckEmail($Email){
        if (empty($Email)) {
            throw new Exception( "Email is required.");
            
        } elseif (!preg_match('/^[a-zA-Z0-9]+@(gmail\.com|hotmail\.com|yahoo\.com)$/', $Email)) {
            throw new Exception("Invalid email format.");
        }
         try {
            $stmt = $this->pdo->prepare("SELECT Email FROM users WHERE Email = :email");
            $stmt->bindParam(':email', $Email, PDO::PARAM_STR);
            $stmt->execute();
            $check = $stmt->fetch(PDO::FETCH_ASSOC);
            SessionClass::start();
            SessionClass::set('User_Email', $Email);
            if ($check) {
                
               
                return true;
                
            } else {
                return false;
            }
        } catch (PDOException $e) {
            
            error_log("Database error: " . $e->getMessage());
            throw new Exception("An error occurred while checking the email. Please try again.");
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    if (isset($_POST['txtEmail'])) {
        $Email = $_POST['txtEmail'];

        
        $emailValidation = new EmailValidation();

        try {
           
            if ($emailValidation->CheckEmail($Email)) {
                echo "<script>alert('Pls Log In To Continue'); window.location.href = '../View/Login.html';</script>";
                
                exit();
            } else {
                header('Location: ../Controller/Valid.php');
                exit();
            }
        } catch (Exception $e) {
            echo "<script>alert('" . $e->getMessage() . "');window.location.href = '../View/email.html';</script>";
        }
    } 
}



