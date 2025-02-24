<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
require_once dirname(__FILE__) . '/../config/database.php';
require_once dirname(__FILE__) . '/../Booking_App/Model/UserController.php';
require_once dirname(__FILE__) . '/../FactoryClass/FactoryClass.php';
require_once dirname(__FILE__) . '/../helper/SessionClass.php';
require_once 'Pilot.php';
require_once 'People.php';
class User extends People{
     
    private $UserID;
    protected $role;
    
    

    public function __construct($Name,$Password, $IDNumber, $Address, $BirthdayDate, $Age,$Email,$role) {
        
        parent::__construct($Name, $Password, $IDNumber, $Address, $BirthdayDate, $Age, $Email);
        $this->role = $role;
    }
   
    
    
    public function getRole() {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
    }
    public function getUserID() {
        return $this->UserID;
    }

    public function setUserID($UserID) {
        $this->UserID = $UserID;
    }

        public function StoreToDatabase() {
                $u = new UserController();
            $userID = $u->register(
                $this->Name,
                $this->Password,
                $this->IDNumber,
                $this->Address,
                $this->BirthdayDate,
                $this->Age,
                $this->role
            );

            if ($userID) {
                $this->UserID = $userID; 
                return $userID;
            } else {
                throw new Exception("Failed to store user data in the database.");
            }
    
    }

    
}
