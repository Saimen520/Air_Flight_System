<?php

require_once '../../Strategy/BookingStrategy.php';

class BookingContext {
    private $strategy;

    public function __construct(BookingStrategy $strategy) {
        $this->strategy = $strategy;
    }

    public function setStrategy(BookingStrategy $strategy) {
        $this->strategy = $strategy;
    }

    public function getFlightDetails($flightId) {
        return $this->strategy->getFlightDetails($flightId);
    }

    public function calculatePrice($flight, $classType) {
        return $this->strategy->calculatePrice($flight, $classType);
    }

    public function bookFlight($bookingData) {
        return $this->strategy->bookFlight($bookingData);
    }
}
?>
