<?php
include 'header.php';
require_once 'functions.php';
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$orderClass = new Order();
$orders = $orderClass->getAllOrders(); // you may filter by user if needed

?>

<h2>My Orders</h2>
<table border="1" cellpadding="10">
<tr>
    <th>Order ID</th>
    <th>Total Amount</th>
    <th>Status</th>
    <th>Order Date</th>
</tr>
<?php foreach($orders as $order): ?>
<tr>
    <td><?php echo $order['OrderID']; ?></td>
    <td><?php echo number_format($order['TotalAmount'],2); ?></td>
    <td><?php echo $order['Status']; ?></td>
    <td><?php echo $order['OrderDate']; ?></td>
</tr>
<?php endforeach; ?>
</table>

<?php include 'footer.php'; ?>
