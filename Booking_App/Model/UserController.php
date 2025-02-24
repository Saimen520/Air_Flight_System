<?php

require_once dirname(__FILE__) . '/../../config/Database.php';
require_once dirname(__FILE__) . '/../Controller/EmailValidation.php';
require_once dirname(__FILE__) . '/../../FactoryClass/FactoryClass.php';
require_once dirname(__FILE__) . '/../../helper/SessionClass.php';



class UserController extends Database{
    
    public function __construct() {
        parent::__construct();
        SessionClass::start();
        date_default_timezone_set('Asia/Kuala_Lumpur');
    }
    public function register($name,$pas,$ID,$add,$birth,$age,$role){
       
       $email = SessionClass::get('User_Email');
       
       $stmt = $this->pdo->prepare("INSERT INTO users(Name,Password,IDNumber,Address,BirthdayDate,Age,Email,Role)VALUES(:name,:pass,:ID,:add,:Birth,:Age,:email,:role)");     
       
       $stmt->bindParam(':name',$name, PDO::PARAM_STR);
       $stmt->bindParam(':pass',$pas, PDO::PARAM_STR);
       $stmt->bindParam(':ID',$ID, PDO::PARAM_STR);
       $stmt->bindParam(':add',$add, PDO::PARAM_STR);
       $stmt->bindParam(':Birth',$birth, PDO::PARAM_STR);
       $stmt->bindParam(':Age',$age, PDO::PARAM_STR);
       $stmt->bindParam(':email',$email, PDO::PARAM_STR);
       $stmt->bindParam(':role',$role, PDO::PARAM_STR);
       
       if($stmt->execute()){
           return  $this->pdo->lastInsertId();
       }
       return false;
       
       
       
    }
    
 
    public function LogOut(){
        SessionClass::destroy();
        SessionClass::set('Logged', false);
        echo "<script>alert('Log Out Successful'); window.location.href = '../View/Home.php';</script>";
        exit();
    }
    
    public function DeleteAcc() {
        $email = SessionClass::get('User_Email');
        $role = SessionClass::get('role');
        $UserID = SessionClass::get('UserID');
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE Email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        
        $pilotStmt = $this->pdo->prepare("DELETE FROM pilot WHERE UserID = :userId");
        $pilotStmt->bindParam(':userId', $UserID, PDO::PARAM_INT);
        
        $adminStmt = $this->pdo->prepare("DELETE FROM admin WHERE UserID = :userId");
        $adminStmt->bindParam(':userId', $UserID, PDO::PARAM_INT);
        

        if ($role == "User" && ($stmt->execute())) {
            
            SessionClass::destroy();
            echo "<script>alert('Delete User Account Successful'); window.location.href = '../View/Home.php';</script>";
            exit();
        } else if ($role === "Pilot" && ($pilotStmt->execute())&&($stmt->execute())) {
            
            SessionClass::destroy();
            echo "<script>alert('Delete Pilot Account Successful'); window.location.href = '../View/Home.php';</script>";
            exit();
        }else if ($role === "Admin" && ($adminStmt->execute())&&($stmt->execute())) {
            
            SessionClass::destroy();
            echo "<script>alert('Delete Admin Account Successful'); window.location.href = '../View/Home.php';</script>";
            exit();
        }else {
            echo "<script>alert('Error: Unable to delete the account.'); window.location.href = '../View/Home.php';</script>";
            exit();
           
        }
    }
    public function UserLogin($pass) {
    $email = SessionClass::get('User_Email');
    $lockoutDuration = 86400; 

    try {
        // Check if user is currently locked out
        $attemptStmt = $this->pdo->prepare("SELECT failed_attempts, lockout_time FROM users WHERE Email = :email");
        $attemptStmt->bindParam(':email', $email, PDO::PARAM_STR);
        $attemptStmt->execute();
        $attempt = $attemptStmt->fetch(PDO::FETCH_ASSOC);

        if ($attempt) {
            $currentTime = time();
            if ($attempt['failed_attempts'] >= 5) {
                // Check if lockout period has passed
                $lockoutTime = strtotime($attempt['lockout_time']);
                $locktime = $lockoutTime + $lockoutDuration;
                if ($currentTime < $locktime) {
                    // Users is still locked out
                    
                    echo "<script>alert('Too many failed login attempts. Please try again after ".$lockoutDateTime = date('Y-m-d H:i:s', $locktime).".'); window.location.href = '../View/Home.php';</script>";
                    exit();
                } else {
                    // Lockout period has passed, reset failed attempts
                    $resetStmt = $this->pdo->prepare("UPDATE users SET failed_attempts = 0, lockout_time = NULL WHERE Email = :email");
                    $resetStmt->bindParam(':email', $email, PDO::PARAM_STR);
                    $resetStmt->execute();
                }
            }
        }

        $stmt = $this->pdo->prepare("SELECT UserID, Name, Email, Password, Role FROM users WHERE Email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $log = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($log && password_verify($pass, $log['Password'])) {
           
            SessionClass::set('user_name', $log['Name']);
            SessionClass::set('Logged', true);
            SessionClass::set('UserID', $log['UserID']);
            SessionClass::set('role', $log['Role']);

            // Reset failed login attempts on success
            $resetStmt = $this->pdo->prepare("UPDATE users SET failed_attempts = 0, lockout_time = NULL WHERE Email = :email");
            $resetStmt->bindParam(':email', $email, PDO::PARAM_STR);
            $resetStmt->execute();

            return true;
        } else {
            
            if ($attempt) {
                    // Update existing record: increment failed attempts
                    $incrementStmt = $this->pdo->prepare("UPDATE users SET failed_attempts = failed_attempts + 1, last_attempt_time = NOW() WHERE Email = :email");
                    $incrementStmt->bindParam(':email', $email, PDO::PARAM_STR);
                    $incrementStmt->execute();

                    // Fetch the updated failed attempts from the database
                    $attemptsStmt = $this->pdo->prepare("SELECT failed_attempts FROM users WHERE Email = :email");
                    $attemptsStmt->bindParam(':email', $email, PDO::PARAM_STR);
                    $attemptsStmt->execute();
                    $attemptData = $attemptsStmt->fetch(PDO::FETCH_ASSOC);

                    // Calculate the number of attempts left
                    $failedAttempts = $attemptData['failed_attempts'];
                    $loginNum = 5 - $failedAttempts;

                    // If this is the 5th failed attempt, set lockout time
                    if ($failedAttempts >= 5) {
                        $lockoutStmt = $this->pdo->prepare("UPDATE users SET lockout_time = NOW() WHERE Email = :email");
                        $lockoutStmt->bindParam(':email', $email, PDO::PARAM_STR);
                        $lockoutStmt->execute();
                        $loginNum = 0; // No attempts left when locked out
                    }

                    return $loginNum;
                }
            }
    } catch (PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
        return "An error occurred. Please try again.";
    }
}

    public function adminRegister($referenceCode,$userID) {
        $stmt = $this->pdo->prepare("INSERT INTO admin(referenceCode,UserID)VALUES(:code,:userID)");     
      
       $stmt->bindParam(':code',$referenceCode, PDO::PARAM_STR);
       
       $stmt->bindParam(':userID',$userID, PDO::PARAM_STR);
       
       
       if($stmt->execute()){
           return true;
       }
       return false;
    }
    public function registerPilot($ex,$salary,$license,$user){
       
       
       $stmt = $this->pdo->prepare("INSERT INTO pilot(Experience,Salary,License,UserID)VALUES(:Ex,:salary,:license,:userID)");     
      
       $stmt->bindParam(':Ex',$ex, PDO::PARAM_STR);
       $stmt->bindParam(':salary',$salary, PDO::PARAM_STR);
       $stmt->bindParam(':license',$license, PDO::PARAM_STR);
       $stmt->bindParam(':userID',$user, PDO::PARAM_STR);
       
       
       if($stmt->execute()){
           return true;
       }
       return false;
       
       
       
    }
}




        
    
    
   
    
     

