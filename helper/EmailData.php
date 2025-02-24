<?php
// Start the session
session_start(); 

// Set the content type to XML
header('Content-Type: application/xml');

// Create a new XML document
$xml = new SimpleXMLElement('<root/>');

// Add the session email data to the XML
if (isset($_SESSION['User_Email'])) {
    $xml->addChild('User_Email', htmlspecialchars($_SESSION['User_Email']));
} else {
    $xml->addChild('User_Email', 'No email set');
}


// Output the XML
echo $xml->asXML();
?>