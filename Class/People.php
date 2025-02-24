<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of People
 *
 * @author SHABI
 */
abstract class People {
    //put your code here
    protected $Name;
    protected $Password;
    protected $IDNumber;
    protected $Address;
    protected $BirthdayDate;
    protected $Age;
    protected $Email;
    
    public function __construct($Name, $Password, $IDNumber, $Address, $BirthdayDate, $Age, $Email) {
        $this->Name = $Name;
        $this->Password = $Password;
        $this->IDNumber = $IDNumber;
        $this->Address = $Address;
        $this->BirthdayDate = $BirthdayDate;
        $this->Age = $Age;
        $this->Email = $Email;
    }
    public function getName() {
        return $this->Name;
    }

    public function getPassword() {
        return $this->Password;
    }

    public function getIDNumber() {
        return $this->IDNumber;
    }

    public function getAddress() {
        return $this->Address;
    }

    public function getBirthdayDate() {
        return $this->BirthdayDate;
    }

    public function getAge() {
        return $this->Age;
    }

    public function getEmail() {
        return $this->Email;
    }

    public function setName($Name) {
        $this->Name = $Name;
    }

    public function setPassword($Password) {
        $this->Password = $Password;
    }

    public function setIDNumber($IDNumber) {
        $this->IDNumber = $IDNumber;
    }

    public function setAddress($Address) {
        $this->Address = $Address;
    }

    public function setBirthdayDate($BirthdayDate) {
        $this->BirthdayDate = $BirthdayDate;
    }

    public function setAge($Age) {
        $this->Age = $Age;
    }

    public function setEmail($Email) {
        $this->Email = $Email;
    }

    abstract public function StoreToDatabase();
    
}
