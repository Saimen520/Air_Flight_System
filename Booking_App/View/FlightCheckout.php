<?php
// Start session
session_start();

// Include necessary files
require_once '../../config/database.php';  
require_once '../controller/FlightController.php';  

// Create an instance of the FlightController
$flightController = new FlightController($pdo);

// Fetch flight ID, class, and price from the URL
$flight_id = isset($_GET['flight_id']) ? $_GET['flight_id'] : null;
$class_type = isset($_GET['class']) ? $_GET['class'] : null;
$price = isset($_GET['price']) ? $_GET['price'] : null;

// Fetch flight details by flight ID
$flight = $flightController->getFlightById($flight_id);

// Check if flight data is available
if (!$flight) {
    echo "Invalid flight ID or flight not found.";
    exit;
}



?>

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Flight Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .checkout-container>h2{
             margin-top: 50px;
        }
        .checkout-container {
            max-width: 600px;
            margin: 0 auto;
        }
        .flight-details, .checkout-form {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;  
        }
        .checkout-form label {
            display: block;
            margin-bottom: 5px;
        }
        .checkout-form input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .checkout-form button {
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .checkout-form button:hover {
            background-color: #218838;
        }
        .error-message {
            color: red;
            margin-bottom: 10px;
        }
        
          footer {
           background-color: #333;
           color: #fff;
           padding: 20px;
           text-align: center;
       }

       .footer-content {
           display: flex;
           flex-wrap: wrap;
           justify-content: space-between;
           align-items: center;
       }

       .footer-left, .footer-center, .footer-right {
           flex: 1;
           padding: 10px;
       }

       .footer-links {
           list-style: none;
           padding: 0;
           margin: 0;
           display: flex;
           justify-content: center;
       }

       .footer-links li {
           margin: 0 10px;
       }

       .footer-links a {
           color: #fff;
           text-decoration: none;
       }

       .footer-links a:hover {
           text-decoration: underline;
       }

       .social-media {
           list-style: none;
           padding: 0;
           margin: 0;
           display: flex;
           justify-content: center;
       }

       .social-media li {
           margin: 0 10px;

       }

       .social-media img {
           width: 50px;
           height: 50px;
            border-radius: 320px;
       }
    </style>
            <link rel="stylesheet" href="../../helper/Header.css">

</head>
<header>
        <a href="Home.php"><img id="logo" src="../../image/logo" alt="Logo"></a>
        <nav>
        <ul>
            <li><a href="Home.php">Home</a></li>
            <li><a href="BookingFlight.php">Flight</a></li>
            <li><a href="booking_history.php">Booking History</a></li>
            <?php if (isset($_SESSION['Logged']) && $_SESSION['Logged'] == true): ?>
                    
                    <li><a href="UserProfile.php"><img id="ProLogo" src="../../image/profileLogo.png" alt="User Logo"> My Profile</a></li>
            <?php else: ?>
                   
                    <li><a href="email.html"><img id="ProLogo" src="../../image/profileLogo.png" alt="Profile Logo"> Sign In</a></li>
            <?php endif; ?>
        </ul>
        </nav>
    </header>
<body>
    <div class="checkout-container">
        <h2>Flight Checkout</h2>

        <div class="flight-details">
            <h3>Flight Details</h3>
     
     <p><strong>Flight ID:</strong> <?= htmlspecialchars($flight_id); ?></p>
    <p><strong>Flight Name:</strong> <?= htmlspecialchars($flight['flight_name']); ?></p>
    <p><strong>Departure City:</strong> <?= htmlspecialchars($flight['departure_city']); ?></p>
    <p><strong>Destination City:</strong> <?= htmlspecialchars($flight['destination_city']); ?></p>
    <p><strong>Class Type:</strong> <?= htmlspecialchars($class_type); ?></p>
    <p><strong>Price:</strong> RM <?= htmlspecialchars(number_format($price, 2)); ?></p>
    <p><strong>Date:</strong> <?= htmlspecialchars($flight['flight_date']); ?></p>
    <p><strong>Departure Time:</strong> <?= htmlspecialchars($flight['departure_time']); ?></p>
    <p><strong>Arrival Time:</strong> <?= htmlspecialchars($flight['arrival_time']); ?></p>
        </div>

        <div class="checkout-form">
            <h3>Your Details</h3>
  <form action="../Controller/processpayment.php" method="post">
        <input type="hidden" name="flight_id" value="<?= htmlspecialchars($flight_id) ?>">
        <input type="hidden" name="class_type" value="<?= htmlspecialchars($class_type) ?>">
        <input type="hidden" name="price" value="<?= htmlspecialchars($price) ?>">
        
        <label for="customer_name">Name:</label>
        <input type="text" name="customer_name" required><br>
        
        <label for="identification_card">Identification Card:</label>
        <input type="text" name="identification_card" required><br>
        
        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" required><br>
        
        <label for="email">Email:</label>
        <input type="text" name="email" required><br>
        <button type="submit">Proceed to Payment</button>
    </form>

            

</body>

</html>

