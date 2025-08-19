<?php
include 'header.php';
include 'functions.php';
session_start();

// Add product to cart
if(isset($_GET['add'])){
    $product_id = $_GET['add'];
    if(!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
    if(isset($_SESSION['cart'][$product_id])){
        $_SESSION['cart'][$product_id]++;
    } else {
        $_SESSION['cart'][$product_id] = 1;
    }
}

// Remove product
if(isset($_GET['remove'])){
    $product_id = $_GET['remove'];
    if(isset($_SESSION['cart'][$product_id])){
        unset($_SESSION['cart'][$product_id]);
    }
}

// Display cart
$product = new Product();
$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
?>
<h2>Shopping Cart</h2>
<?php if(empty($cart_items)): ?>
<p>Your cart is empty.</p>
<?php else: ?>
<table border="1" cellpadding="10">
    <tr>
        <th>Product</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Action</th>
    </tr>
    <?php 
    $total = 0;
    foreach($cart_items as $id => $qty):
        $p = $product->getAllProducts();
        foreach($p as $item){
            if($item['id']==$id){
                $price = $item['price'] * $qty;
                $total += $price;
    ?>
    <tr>
        <td><?php echo $item['name']; ?></td>
        <td><?php echo $qty; ?></td>
        <td>$<?php echo $price; ?></td>
        <td><a href="cart.php?remove=<?php echo $id; ?>">Remove</a></td>
    </tr>
    <?php } } endforeach; ?>
</table>
<p>Total: $<?php echo $total; ?></p>
<a href="checkout.php">Proceed to Checkout</a>
<?php endif; ?>
<?php include 'footer.php'; ?>
