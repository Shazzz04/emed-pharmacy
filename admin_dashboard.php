<?php
session_start();

// Ensure only Admin can access
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

// Database connection (Microsoft SQL Server)
$serverName = "localhost"; // or your SQL Server name
$connectionOptions = [
    "Database" => "emed_pharmacy",
    "Uid" => "your_sql_username",
    "PWD" => "your_sql_password"
];
$conn = sqlsrv_connect($serverName, $connectionOptions);

if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}

include 'header.php';
?>

<div class="container my-5">
    <h1 class="text-center mb-4">Admin Dashboard</h1>
    <p class="text-center text-muted mb-5">
        Welcome back, Admin! Manage your pharmacy system from here.
    </p>

    <div class="row g-4">
        <!-- Orders Card -->
        <div class="col-md-4">
            <div class="card shadow-sm text-center p-4 h-100">
                <h3 class="mb-3 text-success">Orders</h3>
                <p class="text-muted">View and process all customer orders.</p>
                <a href="admin_orders.php" class="btn btn-success">Manage Orders</a>
            </div>
        </div>

        <!-- Products Card -->
        <div class="col-md-4">
            <div class="card shadow-sm text-center p-4 h-100">
                <h3 class="mb-3 text-success">Products</h3>
                <p class="text-muted">Add, update, or remove pharmacy products.</p>
                <a href="admin_products.php" class="btn btn-success">Manage Products</a>
            </div>
        </div>

        <!-- Prescriptions Card -->
        <div class="col-md-4">
            <div class="card shadow-sm text-center p-4 h-100">
                <h3 class="mb-3 text-success">Prescriptions</h3>
                <p class="text-muted">Review and approve customer prescriptions.</p>
                <a href="admin_prescriptions.php" class="btn btn-success">Review Prescriptions</a>
            </div>
        </div>

        <!-- Users Card -->
        <div class="col-md-4">
            <div class="card shadow-sm text-center p-4 h-100">
                <h3 class="mb-3 text-success">Users</h3>
                <p class="text-muted">Manage customer and staff accounts.</p>
                <a href="admin_users.php" class="btn btn-success">Manage Users</a>
            </div>
        </div>

        <!-- Reports Card -->
        <div class="col-md-4">
            <div class="card shadow-sm text-center p-4 h-100">
                <h3 class="mb-3 text-success">Reports</h3>
                <p class="text-muted">Generate system and sales reports.</p>
                <a href="admin_reports.php" class="btn btn-success">View Reports</a>
            </div>
        </div>

        <!-- Settings Card -->
        <div class="col-md-4">
            <div class="card shadow-sm text-center p-4 h-100">
                <h3 class="mb-3 text-success">Settings</h3>
                <p class="text-muted">Configure system and admin preferences.</p>
                <a href="admin_settings.php" class="btn btn-success">System Settings</a>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
