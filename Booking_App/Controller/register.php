<?php //

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of register
 *
 * @author SHABI
 */
require_once  '../../config/database.php';
require_once '../Model/UserController.php';
require_once '../../FactoryClass/FactoryClass.php';
require_once '../../helper/SessionClass.php';
require_once'../../helper/Validation.php';

class register{
    public function StoreFactory($type,$name,$pas,$IDNumber,$add,$birthdayDate,$Age,$Experience,$Salary,$License,$referenceCode) {
        SessionClass::start();
        $fac = new FactoryClass();

        try {
            $f = $fac->userFactory(
                    $type,
                    $name,
                    password_hash($pas, PASSWORD_DEFAULT),
                    $IDNumber,
                    $add,
                    $birthdayDate,
                    $Age,
                    SessionClass::get('User_Email'),
                    $Experience,
                    $Salary,
                    $License,
                    $referenceCode
            );
            $f->StoreToDatabase();
            
            if ($f) {
                echo "<script>alert('Register Successful'); window.location.href = '../View/Login.html';</script>";
                exit();
            } else {
                echo "<script>alert('Register Fail'); window.location.href = '../View/UserReg.php';</script>";
                exit();
            }
        } catch (Exception $e) {
            echo "<script>alert('Error: " . $e . "'); window.location.href = '../View/UserReg.html';</script>";
        }
    }
}

