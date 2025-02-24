<?php
require __DIR__ . '/../../vendor/autoload.php'; 
require_once '../../config/database.php';




class Forgot_Password extends Database {
    public function __construct() {
        parent::__construct();
    }

     public function sendPasswordResetLink($email) {
        // Check if user exists
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Generate token and expiration
            date_default_timezone_set('Asia/Kuala_Lumpur');
            $token = bin2hex(random_bytes(25));
            $expires = time() + 300;
            $expiresDateTime = date('Y-m-d H:i:s', $expires);

            // Store the token in the database
            $stmt = $this->pdo->prepare("INSERT INTO password_reset (email, token, expires) VALUES (:email, :token, :expires)");
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':token', $token, PDO::PARAM_STR);
            $stmt->bindValue(':expires', $expiresDateTime, PDO::PARAM_STR);
            $stmt->execute();

            // Prepare the reset link
            $resetLink = "http://localhost/Air_Flight_System/Booking_App/Controller/reset_password.php?token=" . $token;

            // Prepare the email content
            $subject = 'Password Reset Request';
            $bodyHtml = "Click on the following link to reset your password in <b>5 minutes</b>: <a href='$resetLink'>$resetLink</a>";
            $bodyPlain = "Copy and paste the following link to reset your password: $resetLink";

            // Send the email via SendGrid
            return $this->sendEmailViaSendGrid($email, $subject, $bodyHtml, $bodyPlain);
        } else {
            return ['status' => 'error', 'message' => 'No user found with that email address.'];
        }
    }
    private function sendEmailViaSendGrid($recipientEmail, $subject, $bodyHtml, $bodyPlain) {
        $url = 'https://api.sendgrid.com/v3/mail/send';

        // Create the email payload
        $emailData = [
            'personalizations' => [
                [
                    'to' => [
                        ['email' => $recipientEmail]
                    ],
                    'subject' => $subject,
                ],
            ],
            'from' => [
                'email' => 'waikangng12@gmail.com', // Ensure this email is verified in SendGrid
                'name' => 'AirFlyWithUs',
            ],
            'content' => [
                ['type' => 'text/plain', 'value' => $bodyPlain],
                ['type' => 'text/html', 'value' => $bodyHtml],
            ],
        ];

        // Initialize cURL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            //'Authorization: Bearer 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', 
           // 'Content-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($emailData));

       
        $response = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

       
        if ($statusCode == 202) {
            return ['status' => 'success', 'message' => 'Password reset link sent via SendGrid.'];
        } else {
            return ['status' => 'error', 'message' => 'Failed to send email via SendGrid. Error: ' . $response];
        }

        // Close cURL
        curl_close($ch);
    }


}


//
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Content-Type");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents("php://input");
    $data = json_decode($input, true);

   
    error_log("Raw input: " . $input);
    error_log("Decoded data: " . print_r($data, true));

    if (json_last_error() === JSON_ERROR_NONE && isset($data['email'])) {
        $forgotPassword = new Forgot_Password();
        $response = $forgotPassword->sendPasswordResetLink($data['email']);
        echo json_encode($response);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request data or email is required.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
