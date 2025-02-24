<?php
$emailPagePath = '../Booking_App/View/email.html';

if (file_exists($emailPagePath)) {
    header('Location: ' . $emailPagePath);
    exit; 
} else {
    header('Location: 404.html');
    exit; 
}

?>