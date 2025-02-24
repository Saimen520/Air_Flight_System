<?php
// Include necessary files
require_once '../../config/database.php';  
require_once '../Controller/FlightController.php';  

// Create an instance of the FlightController
$flightController = new FlightController($pdo);

// Get flight data
$data = $flightController->getFlightDetails();
$flights = $data['flights'];
$prices = $data['prices'];
$departure_city = $data['departure_city'];
$destination_city = $data['destination_city'];
$city_names = $data['city_names'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Flight Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            widows: 100%;
            background-color: #f4f4f4;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        .flight-list {
            margin: 20px 0;
        }
        .flight {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #fff;
        }
        .flight h3 {
            margin-top: 0;
        }
        select, button {
            padding: 5px;
            margin: 5px 0;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
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
    <h1>Flight Details</h1>
     <div class="city-info">
        <p><strong>Departure City:</strong> <?php echo htmlspecialchars($departure_city); ?></p>
        <p><strong>Destination City:</strong> <?php echo htmlspecialchars($destination_city); ?></p>
    </div>
    <form id="bookingForm" method="post" action="FlightCheckout.php">
        <table id="flightTable">
            <thead>
                <tr>
                    <th>Flight Name</th>
                    <th>Departure Time</th>
                    <th>Arrival Time</th>
                    <th>Date</th>
                    <th>Class</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($flights as $flight): ?>
                    <tr data-flight-id="<?php echo htmlspecialchars($flight['id']); ?>">
                        <td><?php echo htmlspecialchars($flight['flight_name']); ?></td>
                        <td><?php echo htmlspecialchars($flight['departure_time']); ?></td>
                        <td><?php echo htmlspecialchars($flight['arrival_time']); ?></td>
                        <td><?php echo htmlspecialchars($flight['flight_date']); ?></td>
                        <td>
                            <select class="flight-class">
                                <?php foreach (['Economy', 'Business'] as $class): ?>
                                    <?php if (isset($prices[$class])): ?>
                                        <option value="<?php echo htmlspecialchars($class); ?>" data-price="<?php echo htmlspecialchars($prices[$class]); ?>">
                                            <?php echo htmlspecialchars($class); ?> - RM<?php echo htmlspecialchars(number_format($prices[$class], 2)); ?>
                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        
                        <td>
                            <button type="button" class="book-button">Proceed to Book</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const flightTable = document.getElementById('flightTable');

           

            flightTable.addEventListener('click', function(event) {
                if (event.target.classList.contains('book-button')) {
                    const row = event.target.closest('tr');
                    const flightId = row.getAttribute('data-flight-id');
                    const selectElement = row.querySelector('.flight-class');
                    const selectedClass = selectElement.value;
                    const selectedOption = selectElement.querySelector(`option[value="${selectedClass}"]`);
                    const price = selectedOption ? selectedOption.getAttribute('data-price') : '0.00';
                    
                    console.log('Flight ID:', flightId);
                    console.log('Class Type:', selectedClass);
                    console.log('Price:', price);
                    // Set hidden fields in the form for submission
                    const form = document.getElementById('bookingForm');
                    form.action = `FlightCheckout.php?flight_id=${flightId}&class=${encodeURIComponent(selectedClass)}&price=${encodeURIComponent(price)}`;
                    
                    // Optionally, submit the form
                    form.submit();
                }
            });
        });
    </script>
</body>

</html>
