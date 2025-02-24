<?php
class FlightModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Fetch multiple flights based on departure and destination city
    public function getFlights($departure_city, $destination_city) {
        $sql = "SELECT * FROM flights WHERE departure_city = :departure_city AND destination_city = :destination_city";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':departure_city', $departure_city);
        $stmt->bindParam(':destination_city', $destination_city);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getFlightById($flight_id) {
    // Correct the column name to 'id' instead of 'flight_id'
    $stmt = $this->pdo->prepare('SELECT * FROM flights WHERE id = ?');
    $stmt->execute([$flight_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    // Calculate price based on class type
    public function calculatePrice($class_type) {
        if ($class_type == 'Business') {
            return 500; // Example price for Business class
        } else {
            return 300; // Example price for Economy class
        }
    }
}
?>
