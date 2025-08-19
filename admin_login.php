<?php
session_start();
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new Database();
    $conn = $db->connect();

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM Users WHERE Email = :email AND Role = 'Admin'");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($password, $admin['Password'])) {
        $_SESSION['admin'] = $admin['UserID'];
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "<p style='color:red;'>Invalid email or password</p>";
    }
}
?>

<h2>Admin Login</h2>
<form method="POST">
    <label>Email:</label><br>
    <input type="text" name="email" required><br>
    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>
    <input type="submit" value="Login">
</form>
