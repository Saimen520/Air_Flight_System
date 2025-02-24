    <?php

    /*
     * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
     * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
     */

    /**
     * Description of admin
     *
     * @author SHABI
     */
    require_once 'Pilot.php';
require_once 'People.php';
require_once dirname(__FILE__) . '/../config/database.php';
require_once dirname(__FILE__) . '/../Booking_App/Model/UserController.php';
require_once dirname(__FILE__) . '/../FactoryClass/FactoryClass.php';
require_once dirname(__FILE__) . '/../helper/SessionClass.php';

class admin extends People{
        

        private $referenceCode;
        private $CodeA = "2345-5678";    
        private $CodeB = "2948-5601";
        private $CodeC = "2912-1370";
        private $role;




        public function __construct($Name =null, $Password  =null, $IDNumber  =null, $Address =null, $BirthdayDate =null, $Age =null, $Email =null,$role =null, $referenceCode =null) {

            parent::__construct($Name, $Password, $IDNumber, $Address, $BirthdayDate, $Age, $Email);
            $this->role = $role;
            $this->referenceCode = $referenceCode;
        }

        public function getReferenceCode() {
            return $this->referenceCode;
        }

        public function getCodeA() {
            return $this->CodeA;
        }

        public function getCodeB() {
            return $this->CodeB;
        }

        public function getCodeC() {
            return $this->CodeC;
        }

        public function setReferenceCode($referenceCode) {
            $this->referenceCode = $referenceCode;
        }

        public function setCodeA($CodeA) {
            $this->CodeA = $CodeA;
        }

        public function setCodeB($CodeB) {
            $this->CodeB = $CodeB;
        }

        public function setCodeC($CodeC) {
            $this->CodeC = $CodeC;
        }

        public function CheckReference($referenceCode){
            if ($referenceCode == $this->getCodeA() || $referenceCode == $this->getCodeB() || $referenceCode == $this->getCodeC()) {
                $this->setReferenceCode($referenceCode);
                return true; 
            }else{
                return false;
            }
        }

        public function StoreToDatabase() {
            try {
                $user = new User(
                    $this->Name,
                    $this->Password,
                    $this->IDNumber,
                    $this->Address,
                    $this->BirthdayDate,
                    $this->Age,
                    $this->Email,
                    $this->role
                );

           
                $userId = $user->StoreToDatabase();
                    if ($userId) {
                       
                        $a = new UserController();
                        $a->adminRegister($this->referenceCode, $userId);
                    } else {
                        throw new Exception("Failed to store user data in the database.");
                    }
            } catch (Exception $e) {
        
                error_log("Error in StoreToDatabase: " . $e->getMessage());
                throw $e;
            }

        }

    }
