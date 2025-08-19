<?php
session_start();
require_once 'functions.php';

if(isset($_FILES['prescription']) && isset($_SESSION['user_id'])){
    $userID = $_SESSION['user_id'];
    $fileName = $_FILES['prescription']['name'];
    $fileTmp = $_FILES['prescription']['tmp_name'];

    $uploadPath = "uploads/" . $fileName;
    if(move_uploaded_file($fileTmp, $uploadPath)){
        $prescriptionClass = new Prescription();
        $prescriptionClass->uploadPrescription($userID, $uploadPath);
        echo "Prescription uploaded successfully.";
    } else {
        echo "Upload failed.";
    }
}
?>
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="prescription" required>
    <button type="submit">Upload Prescription</button>
</form>
