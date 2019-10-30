<?php
class DBConnect {
    private static $instance;

    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "crud_example";
    private $charset = "utf8";
    private $options = [  
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false  
    ];
    private $conn;
    
    function __construct() {
        $this->conn = $this->connectDB();
    }   
    
    function connectDB() {
        $dsn = "mysql:host=".$this->host.";dbname=".$this->database.";charset=".$this->charset;
        return new PDO($dsn, $this->user, $this->password, $this->options);
    }

    function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new DBConnect();
        }

        return self::$instance;
    }

    function getConnection() {
        return $this->conn;
    }
}
?>