<?php
session_start();
require_once 'functions.php';

if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userClass = new User();
    if($userClass->register($name, $email, $password)){
        $_SESSION['success'] = "Registration successful. You can login now.";
        header("Location: login.php");
        exit();
    } else {
        $error = "Registration failed. Email may already exist.";
    }
}
?>
<!-- HTML Registration Form -->
<form method="POST">
    <input type="text" name="name" required placeholder="Full Name">
    <input type="email" name="email" required placeholder="Email">
    <input type="password" name="password" required placeholder="Password">
    <button type="submit" name="register">Register</button>
    <?php if(isset($error)) echo "<p>$error</p>"; ?>
</form>
