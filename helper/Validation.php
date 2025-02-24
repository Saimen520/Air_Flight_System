<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Validation
 *
 * @author SHABI
 */

require_once dirname(__FILE__) . '/../Class/admin.php';


class Validation {
    //put your code here
    public function checkName($name){
        if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
            return false;
            
        }else{
            return true;
        }
    }
    
     public function checkType($type){
        $validTypes = ["User", "Pilot"];
        
        if (in_array($type, $validTypes)) {
            return $type;
        } else {
            // You can return null or throw an error if the type is invalid
            return "Admin";
        }
    }
    public function checkCode($code){
        if($code != null){
            $a = new admin();
            if($a->CheckReference($code) == true){
                return true;
            }else{
//                echo "<script>alert('Invalid Code'); window.location.href = './UI/adminReg.html';</script>";
                return false;
            }
        }else{
            return null;
        }
        
    }
   
    public function validatePassword($password) {
        $minLength = 8;
        
        if (strlen($password) < $minLength) {
            return 1;
            
        }
        
        else if (!preg_match('/[a-zA-Z]/', $password)) {
            return 2;
        }
        
        else if (!preg_match('/\d/', $password)) {
            return 3;
        }
        
        else if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
            return 4;
        }
        
        return 0;
    }
    
    
    public function validateID($id){
        if (strlen($id) !== 12) {
            return false;
        }else if(!ctype_digit($id)){
            return false;
        }
        else{
            return true;
        }
    } 
    public function validateDate($date) {

        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            return false;
        } else {
            $birthDateTimestamp = strtotime($date);
            $currentDateTimestamp = time();
            if ($birthDateTimestamp > $currentDateTimestamp) {
                return false;
            } else {
               
                return true;
                
            }
        }
    }

    public function checkAge($age,$birthDay){
        if (!ctype_digit($age) || (int)$age <= 0) {
            return false;
        }
        try {
            $birthDate = new DateTime($birthDay);
        } catch (Exception $e) {
            return false; 
        }

        $currentDate = new DateTime();
        $calculatedAge = $currentDate->diff($birthDate)->y;

        return $calculatedAge === (int)$age;
    
    }
    public function validateExperience($experience){
        if (!ctype_digit($experience) || (int)$experience < 0) {
            return false;
        }
        return true;

    }
    public function validateSalary($salary){
       if (!is_numeric($salary) || $salary <= 0) {
            return false;
        }
        return true;
    } 
    public function validateLicense($license) {
        if (strlen($license) !== 7) {
            return false;
        }else if(!ctype_digit($license)){
            return false;
        }
        else{
            return true;
        }
    }
}
