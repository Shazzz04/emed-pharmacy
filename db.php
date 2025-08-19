<?php
class Database {
    private $host = "localhost"; 
    private $db_name = "emed_pharmacy"; 
    private $username = "sa";   // your SQL Server username
    private $password = "your_password"; // your SQL Server password
    public $conn;

    public function connect() {
        $this->conn = null;
        try {
            $connectionString = "sqlsrv:Server=" . $this->host . ";Database=" . $this->db_name;
            $this->conn = new PDO($connectionString, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Connection Error: " . $e->getMessage());
        }
        return $this->conn;
    }
}
?>
