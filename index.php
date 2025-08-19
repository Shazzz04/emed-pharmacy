<?php
include 'header.php';
require_once 'functions.php';

$productClass = new Product();
$products = $productClass->getAllProducts();
?>

<h2>Products</h2>
<div class="products-container">
<?php foreach($products as $product): ?>
    <div class="product-card">
        <h3><?php echo $product['Name']; ?></h3>
        <p><?php echo $product['Description']; ?></p>
        <p>Price: $<?php echo number_format($product['Price'], 2); ?></p>
        <p>Stock: <?php echo $product['Stock']; ?></p>
        <p>Category: <?php echo $product['CategoryName']; ?></p>
        <a href="cart.php?add=<?php echo $product['ProductID']; ?>">Add to Cart</a>
    </div>
<?php endforeach; ?>
</div>

<?php include 'footer.php'; ?>
