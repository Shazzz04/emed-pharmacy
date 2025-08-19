<?php
include 'header.php';
require_once 'functions.php';

$productClass = new Product();
$products = $productClass->getAllProducts();
?>

<h2>All Products</h2>
<table border="1" cellpadding="10">
<tr>
    <th>Name</th>
    <th>Description</th>
    <th>Price</th>
    <th>Stock</th>
    <th>Category</th>
</tr>
<?php foreach($products as $p): ?>
<tr>
    <td><?php echo $p['Name']; ?></td>
    <td><?php echo $p['Description']; ?></td>
    <td><?php echo number_format($p['Price'],2); ?></td>
    <td><?php echo $p['Stock']; ?></td>
    <td><?php echo $p['CategoryName']; ?></td>
</tr>
<?php endforeach; ?>
</table>

<?php include 'footer.php'; ?>
