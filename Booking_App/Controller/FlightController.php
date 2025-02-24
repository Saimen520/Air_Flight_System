<?php
require_once '../../config/database.php'; 
require_once '../Model/FlightModel.php'; 
require_once '../Model/PriceModel.php'; 

class FlightController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Fetch flight details based on departure and destination city
    public function getFlightDetails() {
        $departure_city = isset($_GET['departure_city']) ? $_GET['departure_city'] : '';
        $destination_city = isset($_GET['destination_city']) ? $_GET['destination_city'] : '';

        $flightModel = new FlightModel($this->pdo);
        $flights = $flightModel->getFlights($departure_city, $destination_city);

        // Fetch route prices
        $priceModel = new PriceModel($this->pdo);
        $prices = $priceModel->getPrices($departure_city, $destination_city);
        $cityNames = $priceModel->getCityNames();
       
        return [
            'flights' => $flights,
            'prices' => $prices,
            'departure_city' => $departure_city,
            'destination_city' => $destination_city,
            'city_names' => $cityNames
        ];
    }

    // Fetch details for a specific flight by flight_id (used in flight checkout)
    public function getFlightById($flight_id) {
        $flightModel = new FlightModel($this->pdo);
        $flight = $flightModel->getFlightById($flight_id);

        if (!$flight) {
            throw new Exception("No flight found with ID: $flight_id");
        }

        return $flight;
    }
    
    // Render flight checkout page (with flight details)
    public function showFlightCheckout() {
        session_start();

        $flight_id = isset($_GET['flight_id']) ? $_GET['flight_id'] : '';
        $class_type = isset($_GET['class_type']) ? $_GET['class_type'] : '';

        if (!$flight_id || !$class_type) {
            header('Location: 404.html');
            exit;
        }

        // Fetch flight details for the selected flight
        try {
            $flight = $this->getFlightById($flight_id);
        } catch (Exception $e) {
            // Handle flight not found error
            echo $e->getMessage();
            exit;
        }

        // Calculate the price based on class type
        $priceModel = new PriceModel($this->pdo);
        $price = $priceModel->calculatePriceForFlight($flight_id, $class_type); // Assume PriceModel has this method

        // Render the checkout view
        include '../views/flight_checkout.php';
    }
}
?>
