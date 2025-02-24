<?php
require_once '../Model/FlightBookingModel.php';
require_once '../../vendor/autoload.php';

class FlightBookingController
{
    private $model;
     

    public function __construct($pdo)
    {
        \Stripe\Stripe::setApiKey('sk_test_51PwmqnP4DVoNTVwgMwL8VHAgUBEYVQ7K8dgka4DqNaNyJRYraoC4S7weaW6FGA4DWtHuANUS4XjVPXKL3o8ePPls002n2kNzX5');
        $this->model = new FlightBookingModel($pdo);
    }

    
    
    public function getCustomers()
    
    {
        $stripeApiUrl = 'https://api.stripe.com/v1/customers';
        $url = $this->stripeApiUrl; // Use the class property for the URL

        // Make the API request
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $this->stripeApiKey . ":");
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Request Error: ' . curl_error($ch);
        }

        curl_close($ch);

        // Return or display the response
        $decodedResponse = json_decode($response, true);
        print_r($decodedResponse);
    }
     public function showCheckout($flight_id, $class_type)
    {
        session_start();

        // Debugging: Show what was passed
        echo "Flight ID: " . $flight_id . "<br>";
        echo "Class Type: " . $class_type . "<br>";

        if (!$flight_id || !$class_type) {
            echo "<p>Error: Missing flight details. Please go back and select a flight.</p>";
            exit;
        }

        try {
            // Fetch flight details using the flight ID
            $flight = $this->model->getFlightDetails($flight_id);

            // Debugging: Check if the flight data is fetched
            if (!$flight) {
                echo "<p>Error: Flight not found. Please try again.</p>";
                exit;
            }
            echo "Flight details fetched successfully.<br>";

            // Fetch the price based on class type
            $price = $this->model->calculatePrice($flight, $class_type);
            if (!$price) {
                echo "<p>Error: Price not available.</p>";
                exit;
            }

            // Store flight details and price in session
            $_SESSION['flight'] = $flight;
            $_SESSION['class_type'] = $class_type;
            $_SESSION['price'] = $price;

            // Debugging: Check the session data
            echo "Flight details and price stored in session.<br>";

            // Render the FlightCheckout view
            include '../View/FlightCheckout.php';
        } catch (Exception $e) {
            error_log($e->getMessage());
            header('Location: 500.html');
            exit;
        }
    }

    public function handlePayment($flight_id, $formData, $class_type, $price)
    {
        try {
            $YOUR_DOMAIN = 'http://localhost/Air_Flight_System/Booking_App/View';

            // Create Stripe checkout session
            $checkout_session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'myr',
                        'product_data' => [
                            'name' => 'Flight Booking',
                            
                        ],
                        'unit_amount' => $price * 100,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => $YOUR_DOMAIN . '/payment_successful.php',
                'cancel_url' => $YOUR_DOMAIN . '/payment_unsuccessful.php',
            ]);

            // Book flight in the database
            $this->model->bookFlight($flight_id, $formData, $class_type, $price);
           

            // Redirect to Stripe
            header('Location: ' . $checkout_session->url);
            exit;
        } catch (\Stripe\Exception\ApiErrorException $e) {
            error_log($e->getMessage());
            $_SESSION['error_message'] = 'An error occurred while processing your payment. Please try again.';
            header('Location: ../View/FlightCheckout.php');
        }
    }
}
?>
