<?php
session_start();
require_once 'functions.php';

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userClass = new User();
    $user = $userClass->login($email, $password);

    if($user){
        $_SESSION['user_id'] = $user['UserID'];
        $_SESSION['user_name'] = $user['Name'];
        $_SESSION['role'] = $user['Role'];

        if($user['Role'] == "Admin"){
            header("Location: admin_dashboard.php");
        } else {
            header("Location: index.php");
        }
        exit();
    } else {
        $error = "Invalid Email or Password";
    }
}
?>
<!-- HTML Login Form -->
<form method="POST">
    <input type="email" name="email" required placeholder="Email">
    <input type="password" name="password" required placeholder="Password">
    <button type="submit" name="login">Login</button>
    <?php if(isset($error)) echo "<p>$error</p>"; ?>
</form>
