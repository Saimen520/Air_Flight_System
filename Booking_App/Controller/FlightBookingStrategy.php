<?php

require_once '../../Strategy/BookingStrategy.php';

class FlightBookingStrategy implements BookingStrategy {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    
    public function getFlightDetails($flightId)
    {
        // Debugging: Display the flightId received
        echo "Inside getFlightDetails with flightId: $flightId<br>";

        // Fetch flight details from the database
        $stmt = $this->pdo->prepare("SELECT * FROM flights WHERE id = :flight_id");
        $stmt->execute([':flight_id' => $flightId]);
        $flight = $stmt->fetch(PDO::FETCH_ASSOC);

        // Debugging: Check if the flight is found
        if (!$flight) {
            echo "<p>Error: Flight not found in database.</p>";
            return null;
        }

        return $flight;
    }

    public function calculatePrice($flight, $classType)
    {
        // Calculate price based on the route and class type
        $stmt = $this->pdo->prepare("SELECT price FROM route_prices WHERE departure_city = :departure_city AND destination_city = :destination_city AND class_type = :class_type");
        $stmt->execute([
            ':departure_city' => $flight['departure_city'],
            ':destination_city' => $flight['destination_city'],
            ':class_type' => $classType
        ]);

        $price = $stmt->fetchColumn();
        if ($price) {
            return $price;
        } else {
            echo "<p>Error: Price not found for the selected class.</p>";
            return null;
        }
    }

    public function bookFlight($bookingData) {
        $stmt = $this->pdo->prepare("INSERT INTO bookings (flight_id, customer_name, identification_card, phone_number, email, class_type, price, booking_date) VALUES (:flight_id, :customer_name, :identification_card, :phone_number, :email, :class_type, :price, NOW())");
        return $stmt->execute($bookingData);
    }
}

?>