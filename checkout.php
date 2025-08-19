<?php
include 'header.php';
include 'functions.php';
session_start();
$order = new Order();
$product = new Product();

if(isset($_POST['submit'])){
    // Simulate saving order
    echo "<p>Order placed successfully!</p>";
    unset($_SESSION['cart']);
}
?>
<h2>Checkout</h2>
<form method="POST">
    <p>Name: <input type="text" name="name" required></p>
    <p>Email: <input type="email" name="email" required></p>
    <p>Address: <input type="text" name="address" required></p>
    <input type="submit" name="submit" value="Place Order">
</form>
<?php include 'footer.php'; ?>
