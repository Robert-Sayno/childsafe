<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .header {
            background-color: #3498db;
            color: #fff;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }

        .nav-header {
            background-color: #2c3e50;
            color: #fff;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .nav-links a:hover {
            background-color: #1a252f;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .section {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            flex-basis: calc(33.33% - 20px);
            text-align: center;
        }

        .section a {
            display: block;
            margin-top: 10px;
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }

        .section a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    </div>

    <div class="nav-header">
        <div class="nav-links">
            <a href="view_reports.php">View Reports</a>
            <a href="view_users.php">Manage Users</a>
            <a href="#">Settings</a>
        </div>
        <div class="nav-links">
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <div class="container">
        <div class="section">
            <h2>Total Users</h2>
            <p>10</p>
            <a href="view_users.php">View All Users</a>
        </div>

        <div class="section">
            <h2>Messages Overview</h2>
            <p>Total Messages: 100</p>
            <p>Unread Messages: 20</p>
            <a href="view_reports.php">View All Messages</a>
        </div>

        <div class="section">
            <h2>Settings</h2>
            <p>Customize system settings here.</p>
            <a href="#">Manage Settings</a>
        </div>
    </div>
</body>

</html>
