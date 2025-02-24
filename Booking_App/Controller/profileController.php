<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require_once dirname(__FILE__) . '/../../config/database.php';
require_once dirname(__FILE__) . '/../../helper/SessionClass.php';

SessionClass::start();
$email = SessionClass::get('User_Email');
if(!SessionClass::has('User_Email')) {
    $email = "waikangng12@gmail.com";
}
header('Content-Type: text/html');

$pdo = Database::getInstance()->getConnection();

$stmt = $pdo->prepare("SELECT UserID, Name, IDNumber, Address, BirthdayDate, Age, Email, Role FROM users WHERE Email = :email");
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// Create XML structure
$xml = new SimpleXMLElement('<root/>');
if ($row) {
    $item = $xml->addChild('item');
    foreach ($row as $key => $value) {
        if ($key == 'IDNumber') {
            $maskedID = str_repeat('*', strlen($value) - 2) . substr($value, -2);
            $item->addChild($key, htmlspecialchars($maskedID));
        } else {
            $item->addChild($key, htmlspecialchars($value));
        }
    }
} else {
    $xml->addChild('error', 'No user found with the specified email.');
}

// Save XML to a file
$xmlFilePath = dirname(__FILE__) . '/../View/user_data.xml';
$xml->asXML($xmlFilePath);

// Load XSL
$xsl = new DOMDocument;
if (!$xsl->load(dirname(__FILE__) . '/style.xsl')) {
    die('Error loading XSL file.');
}

$domXml = new DOMDocument;
$domXml->loadXML($xml->asXML());

$proc = new XSLTProcessor;
$proc->importStylesheet($xsl);

$html = $proc->transformToXML($domXml);

if ($html === false) {
    die('Error during XSL transformation.');
}



