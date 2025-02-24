<?php
// Ensure no whitespace before this line
require_once dirname(__FILE__) . '/../../helper/SessionClass.php';
header('Content-Type: text/xml');

// Output XML declaration right at the start
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<?xml-stylesheet type="text/xsl" href="Booking_History.xsl"?>';

// Database connection setup
$host = 'localhost';
$db = 'flight_booking_system';
$user = 'root';
$pass = '';

// Start the session and get the user's email
SessionClass::start();
$userEmail = SessionClass::get('User_Email');

// Check if the user is logged in
if (!$userEmail) {
    echo "<error>User not logged in</error>";
    exit;
}

try {
    // Establish a database connection
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle connection failure
    echo '<error>Connection failed: ' . htmlspecialchars($e->getMessage()) . '</error>';
    exit;
}

// Fetch booking history for the logged-in user (using the email from the session)
$sql = "SELECT flight_id, customer_name, identification_card, class_type, price, payment_amount, booking_date
        FROM booking_history 
        WHERE email = :email";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':email', $userEmail, PDO::PARAM_STR);
$stmt->execute();
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle no bookings found case
if (empty($bookings)) {
    echo "<error>No bookings found</error>";
    exit;
}

// Output the bookings as XML
echo '<bookings>';
foreach ($bookings as $booking) {
    echo '<booking>';
    echo '<flight_id>' . htmlspecialchars($booking['flight_id']) . '</flight_id>';
    echo '<customer_name>' . htmlspecialchars($booking['customer_name']) . '</customer_name>';
    echo '<identification_card>' . htmlspecialchars($booking['identification_card']) . '</identification_card>';
    echo '<class_type>' . htmlspecialchars($booking['class_type']) . '</class_type>';
    echo '<price>' . number_format($booking['price'], 2) . '</price>';
    echo '<payment_amount>' . number_format($booking['payment_amount'], 2) . '</payment_amount>';
    echo '<booking_date>' . htmlspecialchars($booking['booking_date']) . '</booking_date>';
    echo '</booking>';
}
echo '</bookings>';
?>
