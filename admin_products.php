<?php
session_start();
require_once "db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$db = new Database();
$conn = $db->connect();

$stmt = $conn->query("SELECT p.ProductID, p.Name, p.Price, p.Stock, c.CategoryName 
                      FROM Products p 
                      LEFT JOIN Categories c ON p.CategoryID = c.CategoryID");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Manage Products</h2>
<a href="admin_add_product.php">+ Add Product</a>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th><th>Name</th><th>Category</th><th>Price</th><th>Stock</th><th>Action</th>
    </tr>
    <?php foreach ($products as $p): ?>
    <tr>
        <td><?= $p['ProductID'] ?></td>
        <td><?= $p['Name'] ?></td>
        <td><?= $p['CategoryName'] ?></td>
        <td><?= $p['Price'] ?></td>
        <td><?= $p['Stock'] ?></td>
        <td>
            <a href="admin_edit_product.php?id=<?= $p['ProductID'] ?>">Edit</a> | 
            <a href="delete_product.php?id=<?= $p['ProductID'] ?>">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
