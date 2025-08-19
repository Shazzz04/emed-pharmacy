<?php
require_once 'db.php';

class User {
    private $conn;
    private $table = "Users";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function register($name, $email, $password, $role = "Customer") {
        $hashed = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO $this->table (Name, Email, Password, Role) 
                  VALUES (:name, :email, :password, :role)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed);
        $stmt->bindParam(':role', $role);
        return $stmt->execute();
    }

    public function login($email, $password) {
        $query = "SELECT * FROM $this->table WHERE Email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['Password'])) return $user;
        return false;
    }

    public function getAllUsers() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

class Product {
    private $conn;
    private $table = "Products";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getAllProducts() {
        $query = "SELECT p.ProductID, p.Name, p.Description, p.Price, p.Stock, c.CategoryName
                  FROM $this->table p
                  LEFT JOIN Categories c ON p.CategoryID = c.CategoryID";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($productID) {
        $query = "SELECT * FROM $this->table WHERE ProductID = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $productID);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

class Order {
    private $conn;
    private $table = "Orders";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getAllOrders() {
        $query = "SELECT o.OrderID, u.Name AS Customer, o.TotalAmount, o.Status, o.OrderDate
                  FROM $this->table o
                  JOIN Users u ON o.UserID = u.UserID
                  ORDER BY o.OrderID DESC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderItems($orderID) {
        $query = "SELECT oi.ProductID, p.Name, oi.Quantity, oi.Price
                  FROM OrderItems oi
                  JOIN Products p ON oi.ProductID = p.ProductID
                  WHERE oi.OrderID = :orderID";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':orderID', $orderID);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

class Prescription {
    private $conn;
    private $table = "Prescriptions";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function uploadPrescription($userID, $filePath) {
        $query = "INSERT INTO $this->table (UserID, FilePath, Status, UploadDate) 
                  VALUES (:userID, :filePath, 'Pending', NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':filePath', $filePath);
        return $stmt->execute();
    }

    public function getUserPrescriptions($userID) {
        $query = "SELECT * FROM $this->table WHERE UserID = :userID";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':userID', $userID);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
