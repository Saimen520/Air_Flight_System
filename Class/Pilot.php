<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of newPHPClass
 *
 * @author SHABI
 */
require_once dirname(__FILE__) . '/../config/database.php';
require_once dirname(__FILE__) . '/../Booking_App/Model/UserController.php';
require_once dirname(__FILE__) . '/../FactoryClass/FactoryClass.php';
require_once dirname(__FILE__) . '/../helper/SessionClass.php';


require_once 'People.php';

class Pilot extends People {
    //put your code here
   
    private $Experience;
    private $Salary;
    private $License;
    

    public function __construct( $Name,$Password, $IDNumber, $Address, $BirthdayDate, $Age,$Email,$role, $Experience, $Salary, $License) {
        parent::__construct( $Name,$Password, $IDNumber, $Address, $BirthdayDate, $Age,$Email);
        
        $this->Experience = $Experience;
        $this->Salary = $Salary;
        $this->License = $License;
        $this->role = $role;
    }
   
    public function getLicense() {
        return $this->License;
    }

    public function setLicense($License) {
        $this->License = $License;
    }

   
    public function getExperience() {
        return $this->Experience;
    }

    public function getSalary() {
        return $this->Salary;
    }

    

    public function setExperience($Experience) {
        $this->Experience = $Experience;
    }

    public function setSalary($Salary) {
        $this->Salary = $Salary;
    }
    
    public function StoreToDatabase(){
      
    
        // Store the User to the database
        $user = new User(
            $this->Name,
            $this->Password,
            $this->IDNumber,
            $this->Address,
            $this->BirthdayDate,
            $this->Age,
            $this->Email,
            $this->role
        );

        // Store the user and get the UserID
        $userId = $user->StoreToDatabase();

        if ($userId) {
           
            $p = new UserController();
            $p->registerPilot($this->Experience, $this->Salary, $this->License, $userId);
        } else {
            throw new Exception("Failed to store user data in the database.");
        }
    
    }
}
