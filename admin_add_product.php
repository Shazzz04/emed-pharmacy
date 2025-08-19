<?php
include 'header.php';
require_once 'functions.php';

$product = new Product();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    $db = new Database();
    $conn = $db->connect();

    $query = "INSERT INTO products (name, price, category) VALUES (:name, :price, :category)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':category', $category);

    if ($stmt->execute()) {
        echo "<p>✅ Product added successfully!</p>";
    } else {
        echo "<p>❌ Failed to add product.</p>";
    }
}
?>

<h2>Add New Product</h2>
<form method="POST">
    <label>Product Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Price:</label><br>
    <input type="number" step="0.01" name="price" required><br><br>

    <label>Category:</label><br>
    <input type="text" name="category" required><br><br>

    <button type="submit">Add Product</button>
</form>

<?php include 'footer.php'; ?>
