<?php
require_once '../../vendor/autoload.php';
require_once '../../config/database.php';

class BookingModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function createBooking($flight_id, $formData, $class_type, $price) {
        // Insert booking into the database
        $stmt = $this->pdo->prepare("INSERT INTO bookings (flight_id, customer_name, identification_card, phone_number, email, class_type, price, booking_date, status) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), 'Pending')");
        $stmt->execute([
            $flight_id,
            $formData['customer_name'],
            $formData['identification_card'],
            $formData['phone_number'],
            $formData['email'],
            $class_type,
            $price
        ]);
        return $this->pdo->lastInsertId();
    }

        public function addBookingHistory($flight_id, $formData, $class_type, $price) {
        $stmt = $this->pdo->prepare("INSERT INTO booking_history (flight_id, customer_name, identification_card, class_type, price, payment_amount, booking_date, status) VALUES (?, ?, ?, ?, ?, ?, NOW(), 'Pending')");
        $stmt->execute([
            $flight_id,
            $formData['customer_name'],
            $formData['identification_card'],
            $class_type,
            $price,
            $price
        ]);
    }

    public function createStripeSession($flight, $class_type, $price, $success_url, $cancel_url) {
        \Stripe\Stripe::setApiKey("sk_test_51PwmqnP4DVoNTVwgMwL8VHAgUBEYVQ7K8dgka4DqNaNyJRYraoC4S7weaW6FGA4DWtHuANUS4XjVPXKL3o8ePPls002n2kNzX5");

        $flightDetails = "Flight Name: " . $flight['flight_name'] . "\n" .
                         "From: " . $flight['departure_city'] . "\n" .
                         "To: " . $flight['destination_city'] . "\n" .
                         "Class: " . $class_type . "\n" .
                         "Date: " . $flight['flight_date'] . "\n" .
                         "Price: RM " . number_format($price, 2);

        $checkout_session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'myr',
                    'product_data' => [
                        'name' => 'Flight Booking',
                        'description' => $flightDetails,
                    ],
                    'unit_amount' => $price * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $success_url,
            'cancel_url' => $cancel_url,
        ]);

        return $checkout_session->url; // Return Stripe checkout session URL
    }
}
?>
