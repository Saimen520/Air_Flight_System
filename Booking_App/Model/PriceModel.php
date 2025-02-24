<?php
class PriceModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getPrices($departure_city, $destination_city) {
        $query = "
            SELECT class_type, price 
            FROM route_prices 
            WHERE departure_city = :departure_city 
              AND destination_city = :destination_city
        ";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':departure_city', $departure_city);
        $stmt->bindParam(':destination_city', $destination_city);
        $stmt->execute();

        $prices = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $prices[$row['class_type']] = $row['price'];
        }
        return $prices;
    }
    
    public function calculatePriceForFlight($flight_id, $class_type) {
        $stmt = $this->pdo->prepare("SELECT price FROM route_prices WHERE flight_id = :flight_id AND class_type = :class_type");
        $stmt->bindParam(':flight_id', $flight_id);
        $stmt->bindParam(':class_type', $class_type);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['price'] ?? 0; // Return 0 if no price is found
    }
    
       public function getCityNames() {
        $query = "
            SELECT DISTINCT departure_city, destination_city
            FROM route_prices
        ";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>
