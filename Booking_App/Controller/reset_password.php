<?php

require_once '../../config/database.php';
require_once'../../helper/SessionClass.php';
class ResetPassword extends Database {
    
    public function __construct() {
        parent::__construct();
   
        date_default_timezone_set('Asia/Kuala_Lumpur');
        SessionClass::start();
    }

    public function handleRequest() {
        if (isset($_GET['token'])) {
            $token = $_GET['token'];
            $this->validateToken($token);
        } elseif (isset($_POST['new_password'])) {
            $this->resetPassword($_POST['new_password']);
        }
    }

    private function validateToken($token) {
        $currentDateTime = date('Y-m-d H:i:s');
      
        $stmt = $this->pdo->prepare("SELECT * FROM password_reset WHERE token = :token AND expires > :currentDateTime");
        $stmt->bindValue(':token', $token, PDO::PARAM_STR);
        $stmt->bindValue(':currentDateTime', $currentDateTime, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
           
            $stmt = $this->pdo->prepare("SELECT email FROM password_reset WHERE token = :token");
            $stmt->bindValue(':token', $token, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $email = $result['email'];
            SessionClass::set('ResetEmail', $email);
            header("Location:../view/ResetPass.html");
            $stmt = $this->pdo->prepare("DELETE FROM password_reset WHERE token = :token");
            $stmt->bindValue(':token', $token, PDO::PARAM_STR);
            $stmt->execute();

        } else {
            echo 'Invalid or expired token.';
        }
    }

    private function resetPassword($new_password) {
    $email = SessionClass::get('ResetEmail');

    if ($email) {
       
        $stmt = $this->pdo->prepare("SELECT password FROM users WHERE email = :email");
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $current_password_hash = $result['password'];

           
            if (password_verify($new_password, $current_password_hash)) {
                echo "<script>alert('New password cannot be the same as the old password.'); window.location.href = '../View/ResetPass.html';</script>";
            exit;
            }
           
            $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);

         
            $stmt = $this->pdo->prepare("UPDATE users SET password = :password WHERE email = :email");
            $stmt->bindValue(':password', $new_password_hash, PDO::PARAM_STR);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            
            SessionClass::set('User_Email', $email);
            echo "<script>alert('Reset Password Successful'); window.location.href = '../View/Login.html';</script>";
        } else {
            echo "<script>alert('User not found.'); window.location.href = '../View/ResetPass.html';</script>";
        }
    } else {
        echo 'Invalid token.';
    }
}
   
}

$resetPassword = new ResetPassword();
$resetPassword->handleRequest();
