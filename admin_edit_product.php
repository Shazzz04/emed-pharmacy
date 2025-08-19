<?php
include 'header.php';
require_once 'functions.php';

$db = new Database();
$conn = $db->connect();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $category = $_POST['category'];

        $query = "UPDATE products SET name=:name, price=:price, category=:category WHERE id=:id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            echo "<p>✅ Product updated successfully!</p>";
        } else {
            echo "<p>❌ Failed to update product.</p>";
        }
    }

    $stmt = $conn->prepare("SELECT * FROM products WHERE id=:id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<h2>Edit Product</h2>
<?php if (!empty($product)): ?>
<form method="POST">
    <label>Product Name:</label><br>
    <input type="text" name="name" value="<?php echo $product['name']; ?>" required><br><br>

    <label>Price:</label><br>
    <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>" required><br><br>

    <label>Category:</label><br>
    <input type="text" name="category" value="<?php echo $product['category']; ?>" required><br><br>

    <button type="submit">Update Product</button>
</form>
<?php else: ?>
<p>Product not found!</p>
<?php endif; ?>

<?php include 'footer.php'; ?>
