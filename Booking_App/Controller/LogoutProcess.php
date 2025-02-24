<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require_once '../../helper/SessionClass.php';
require_once '../Model/UserController.php';

$controller = new UserController();
$controller->LogOut();