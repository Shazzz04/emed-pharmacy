<?php
session_start();
require_once "db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$db = new Database();
$conn = $db->connect();

$stmt = $conn->query("SELECT o.OrderID, u.Name AS Customer, o.TotalAmount, o.Status, o.OrderDate
                      FROM Orders o
                      JOIN Users u ON o.UserID = u.UserID
                      ORDER BY o.OrderID DESC");
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Manage Orders</h2>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th><th>Customer</th><th>Total Amount</th><th>Status</th><th>Date</th>
    </tr>
    <?php foreach ($orders as $o): ?>
    <tr>
        <td><?= $o['OrderID'] ?></td>
        <td><?= $o['Customer'] ?></td>
        <td><?= $o['TotalAmount'] ?></td>
        <td><?= $o['Status'] ?></td>
        <td><?= $o['OrderDate'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>
