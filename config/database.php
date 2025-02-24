
<?php

$host = 'localhost';
$db = 'flight_booking_system';
$user = 'root'; 
$pass = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log($e->getMessage(), 3, 'errors.log');
    echo "Sorry, something went wrong. Please try again later.";
    exit;
}


class Database {
    //put your code here
    private $host = 'localhost';
    private $dbName = 'flight_booking_system';
    private $username = 'root';
    private $password = '';
    protected $pdo;
    
    private static $instance = null;
    
    protected function __construct() {
        $this->connection();
        
    }
    
    public function connection(){
         try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbName};charset=utf8";
            $this->pdo = new PDO($dsn,$this->username,$this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exc) {
            echo 'Connection failed: ' . $exc->getMessage();
        }
    }
    
    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getConnection(){
        return $this->pdo;
    }
}
?>
