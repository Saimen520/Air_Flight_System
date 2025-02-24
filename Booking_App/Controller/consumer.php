<?php
// Include the ExternalApiController class
require_once 'APIcontroller.php'; // Adjust the path according to your project structure

// Instantiate the controller
$controller = new ExternalApiController();

// Call the method that makes the API request
$controller->proveConsumerStatus();
?>
