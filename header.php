<?php
session_start();

// Detect admin pages
$isAdminPage = strpos($_SERVER['PHP_SELF'], 'admin') !== false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>e-Med Pharmacy</title>
    <!-- Load CSS based on page type -->
    <?php 
        if ($isAdminPage) {
            echo '<link rel="stylesheet" href="style_admin.css">';
        } else {
            echo '<link rel="stylesheet" href="style.css">';
        }
    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #2c2c2c;
        }
        .navbar-nav {
            margin: 0 auto;
        }
        .nav-link {
            color: white !important;
            margin: 0 10px;
            font-weight: 500;
        }
        .nav-link:hover {
            color: #ffc107 !important;
        }
        /* Common button style for Login & Register */
        .btn-auth {
            background-color: #28a745; /* Green theme */
            color: white;
            border: none;
            padding: 6px 14px;
            border-radius: 5px;
            font-weight: bold;
            text-decoration: none;
        }
        .btn-auth:hover {
            background-color: #218838;
            color: #fff;
        }
        .btn-logout {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 6px 14px;
            border-radius: 5px;
            font-weight: bold;
            text-decoration: none;
        }
        .btn-logout:hover {
            background-color: #bb2d3b;
        }
    </style>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold text-white" href="<?php echo $isAdminPage ? 'admin_dashboard.php' : 'index.php'; ?>">e-Med Pharmacy</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <?php if ($isAdminPage): ?>
                        <li class="nav-item"><a class="nav-link" href="admin_dashboard.php">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="admin_orders.php">Orders</a></li>
                        <li class="nav-item"><a class="nav-link" href="admin_products.php">Products</a></li>
                        <li class="nav-item"><a class="nav-link" href="admin_prescriptions.php">Prescriptions</a></li>
                        <li class="nav-item"><a class="nav-link" href="admin_users.php">Users</a></li>
                        <li class="nav-item"><a class="nav-link" href="admin_reports.php">Reports</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="product.php">Products</a></li>
                        <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
                        <li class="nav-item"><a class="nav-link" href="orders.php">Orders</a></li>
                        <li class="nav-item"><a class="nav-link" href="upload_prescription.php">Upload Prescription</a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Right Side Buttons -->
            <div class="d-flex align-items-center gap-2">
                <?php if (isset($_SESSION['user'])): ?>
                    <?php if (!$isAdminPage): ?>
                        <a href="profile.php" class="btn btn-light">My Account</a>
                    <?php endif; ?>
                    <a href="logout.php" class="btn btn-logout">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="btn-auth">Login</a>
                    <a href="register.php" class="btn-auth">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>
<main>
