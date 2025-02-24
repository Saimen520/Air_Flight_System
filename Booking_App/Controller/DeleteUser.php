<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */


require_once dirname(__FILE__) . '/../../config/database.php';
require_once dirname(__FILE__) . '/../Model/UserController.php';
require_once dirname(__FILE__) . '/../../FactoryClass/FactoryClass.php';
require_once dirname(__FILE__) . '/../../helper/SessionClass.php';
$controller = new UserController();
$controller->DeleteAcc();