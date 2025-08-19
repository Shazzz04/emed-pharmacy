<?php
session_start();
require_once "db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$db = new Database();
$conn = $db->connect();

$stmt = $conn->query("SELECT p.PrescriptionID, u.Name AS Customer, p.FilePath, p.Status, p.UploadDate
                      FROM Prescriptions p
                      JOIN Users u ON p.UserID = u.UserID
                      ORDER BY p.UploadDate DESC");
$prescriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Manage Prescriptions</h2>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th><th>Customer</th><th>File</th><th>Status</th><th>Upload Date</th><th>Action</th>
    </tr>
    <?php foreach ($prescriptions as $p): ?>
    <tr>
        <td><?= $p['PrescriptionID'] ?></td>
        <td><?= $p['Customer'] ?></td>
        <td><a href="<?= $p['FilePath'] ?>" target="_blank">View</a></td>
        <td><?= $p['Status'] ?></td>
        <td><?= $p['UploadDate'] ?></td>
        <td>
            <a href="approve_prescription.php?id=<?= $p['PrescriptionID'] ?>">Approve</a> | 
            <a href="reject_prescription.php?id=<?= $p['PrescriptionID'] ?>">Reject</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
