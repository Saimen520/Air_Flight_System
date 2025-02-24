<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of FactoryClass
 *
 * @author SHABI
 */
require_once dirname(__FILE__) . '/../Class/People.php';
require_once dirname(__FILE__) . '/../Class/Pilot.php';
require_once dirname(__FILE__) . '/../Class/User.php';
require_once dirname(__FILE__) . '/../Class/admin.php';


class FactoryClass {
    //put your code here    
    public function userFactory($type,$Name,$Password, $IDNumber, $Address, $BirthdayDate, $Age,$Email,$Experience , $Salary , $License,$referenceCode ){
        if ($type == "Pilot"){
            $p = new Pilot($Name,$Password, $IDNumber, $Address, $BirthdayDate, $Age,$Email,$type, $Experience, $Salary, $License);
            return $p;
        }elseif($type == "User"){
            $u = new User($Name,$Password, $IDNumber, $Address, $BirthdayDate, $Age,$Email,$type);
            return $u;
        }elseif($type == "Admin"){
            $a = new admin($Name, $Password, $IDNumber, $Address, $BirthdayDate, $Age, $Email,$type,$referenceCode);
            return $a;
        }else{
            return null;
        }
        
    }
    
    
}
