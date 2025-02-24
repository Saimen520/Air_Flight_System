<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */



require_once dirname(__FILE__) . '/../../config/database.php';
require_once dirname(__FILE__) . '/../Model/UserController.php';
require_once dirname(__FILE__) . '/../../FactoryClass/FactoryClass.php';
require_once dirname(__FILE__) . '/../../helper/SessionClass.php';
require_once dirname(__FILE__) . '/../../helper/Validation.php';
require_once dirname(__FILE__) . '/register.php';


$errors = [];
$type = 'User';
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $v = new Validation();
    $type = $v->checkType(isset($_POST["redio"]) ? trim($_POST["redio"]) : 'User');
    $name = isset($_POST["textName"]) ? trim($_POST["textName"]) : null;
    $pas = isset($_POST["textPass"]) ? trim($_POST["textPass"]) : null;
    $IDNumber = isset($_POST["textID"]) ? trim($_POST["textID"]) : null;
    $add = isset($_POST["textAdd"]) ? trim($_POST["textAdd"]) : null;
    $birthdayDate = isset($_POST["textDate"]) ? trim($_POST["textDate"]) : null;
    $Age = isset($_POST["textAge"]) ? trim($_POST["textAge"]) : null;

    $Experience = isset($_POST['textExperience']) ? trim($_POST['textExperience']) : null; 
    $Salary = isset($_POST['textSalary']) ? trim($_POST['textSalary']) : null; 
    $License =isset($_POST['textLicense']) ? trim($_POST['textLicense']) : null;

    $referenceCode = isset($_POST['textReference']) ? trim($_POST['textReference']) : null;
    
    
    if($name == null){
        $errors['textName'] = "Name cannot be empty";
    }
    elseif(!$v->checkName($name)){
        $errors['textName'] = "Name can only contain letters and spaces.";
    }

  
    if($pas == null){
        $errors['textPass'] = "Password cannot be empty.";
    }else{
        switch ($v->validatePassword($pas)){
        case 1:
            $errors['textPass'] = "Password must be at least 8 characters.";
            break;
        case 2:
            $errors['textPass'] = "Password must be include letter.";
            break;
        case 3:
            $errors['textPass'] = "Password must have digit.";
            break;
        case 4:
            $errors['textPass'] = "Password must have SpecialChaaracter(?/!#@).";
            break;
        default :
            $pas = trim($_POST['textPass']);
        }
    }
    
    

    
    if (!$v->validateID($IDNumber)) {
        $errors['textID'] = "ID number must contain 12 digits.";
    }
    
    
    
    
  
    if (!$v->validateDate($birthdayDate)) {
        $errors['textDate'] = "Birthdate must be in YYYY-MM-DD format.";
    }

   
    if (!$v->checkAge($Age, $birthdayDate)) {
        $errors['textAge'] = "Invalid Age.";
    }
    
    if ($type == 'Pilot') {
       
        if (!$v->validateExperience($Experience)) {
            $errors['textExperience'] = "Invalid Experience.";
        }
       
       
        if (!$v->validateSalary($Salary)) {
            $errors['textSalary'] = "Salary must be a positive number.";
        } 

      
        if (!$v->validateLicense($License)) {
            $errors['textLicense'] = "Invalid License Number.";
        }
    }
    if($type == "Admin" && (!$v->checkCode($referenceCode))){
        $errors['textReference'] = "Invalid Admin Code.";
    }
    
    if (empty($errors)) {
        $r = new register();
        $r->StoreFactory($type, $name, $pas, $IDNumber, $add, $birthdayDate, $Age, $Experience, $Salary, $License, $referenceCode);
        echo "<script>alert('Register Successful'); window.location.href = '../View/Login.html';</script>";
        
    }
}


require '../View/UserReg.php';
