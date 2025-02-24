<?php
require_once '../../config/database.php';
require_once '../Controller/FlightBookingStrategy.php';

require_once '../../Strategy/BookingStrategy.php';

class FlightBookingModel
{
    private $bookingStrategy;
    private $validationStrategy;
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->bookingStrategy = new FlightBookingStrategy($pdo);
    }

     public function getFlightDetails($flight_id)
    {
        // Fetch flight details from the database
        return $this->bookingStrategy->getFlightDetails($flight_id);
    }   

    public function calculatePrice($flight, $class_type)
    {
        return $this->bookingStrategy->calculatePrice($flight, $class_type);
    }



    public function bookFlight($flight_id, $formData, $class_type, $price)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO bookings (flight_id, customer_name, identification_card, phone_number, email, class_type, price, booking_date) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
            $stmt->execute([$flight_id, $formData['customer_name'], $formData['identification_card'], $formData['phone_number'], $formData['email'], $class_type, $price]);

            $stmt_history = $this->pdo->prepare("INSERT INTO booking_history (flight_id, customer_name, identification_card,email, class_type, price, payment_amount, booking_date) VALUES (?, ?,?, ?, ?, ?, ?, NOW())");
            $stmt_history->execute([$flight_id, $formData['customer_name'], $formData['identification_card'],$formData['email'], $class_type, $price, $price]);
        } catch (PDOException $e) {
            error_log($e->getMessage(), 3, 'errors.log');
            throw $e;
        }
    }
}
?>
