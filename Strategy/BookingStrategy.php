<?php

interface BookingStrategy {
    public function getFlightDetails($flightId);
    public function calculatePrice($flight, $classType);
    public function bookFlight($bookingData);
}

?>
