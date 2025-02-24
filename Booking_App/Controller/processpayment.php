<?php
// Start session
session_start();

// Include necessary files
require_once '../../config/database.php';  
require_once 'FlightBookingController.php';

// Instantiate the FlightBookingController
$controller = new FlightBookingController($pdo);

// Fetch POST data
$flight_id = $_POST['flight_id'];
$class_type = $_POST['class_type'];
$price = $_POST['price'];
$formData = [
    'customer_name' => $_POST['customer_name'],
    'identification_card' => $_POST['identification_card'],
    'phone_number' => $_POST['phone_number'],
    'email' => $_POST['email'],
        
];

// Call the handlePayment method
$controller->handlePayment($flight_id, $formData, $class_type, $price);

