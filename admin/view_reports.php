<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include your database connection file
include_once('connection.php');

// Fetch all unique user reports from the database along with user phone numbers and report IDs
$sql = "SELECT r.id, r.user_id, u.phone, r.message, r.admin_reply 
        FROM reports r 
        INNER JOIN users u ON r.user_id = u.id
        GROUP BY r.user_id";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo "Error preparing statement: " . $conn->error;
    exit;
}
$stmt->execute();
$reports = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Handle reply submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reply'])) {
    $report_id = $_POST['report_id'];
    $reply = $_POST['reply'];

    // Update the report with the admin's reply
    $stmt = $conn->prepare("UPDATE reports SET admin_reply = ? WHERE id = ?");
    if (!$stmt) {
        echo "Error preparing statement: " . $conn->error;
        exit;
    }
    $stmt->bind_param("si", $reply, $report_id);

    if ($stmt->execute()) {
        // Redirect to prevent form resubmission on page refresh
        header('Location: view_reports.php');
        exit();
    } else {
        echo "<script>alert('Failed to update report.');</script>";
    }

    $stmt->close();
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
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 15px;
            text-align: center;
            margin-bottom: 20px;
            position: relative;
        }

        nav {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 10px;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            background-color: #555;
            transition: background-color 0.3s ease;
        }

        nav a:hover {
            background-color: #777;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        button, .actions a {
            padding: 8px 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        button:hover, .actions a:hover {
            background-color: #0056b3;
        }

        .notification {
            background-color: #ff0000;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            display: inline-block;
        }
    </style>
</head>
<body>
     <!-- Admin header/navigation -->
     <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <a href="view_reports.pp">View Reports</a>
            <a href="#">Create Report</a>
            <a href="view_users.php">Manage Users</a>
            <a href="#">Settings</a>
        </nav>
    </header>
  
    <!-- Admin dashboard content -->
    <div class="container">
        <h2>Reports</h2>
        <table>
            <tr>
                <th>Report ID</th>
                <th>User ID</th>
                <th>Phone Number</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($reports as $report): ?>
<tr>
    <td><?php echo $report['id']; ?></td>
    <td><?php echo $report['user_id']; ?></td>
    <td><?php echo $report['phone']; ?></td>
    <td>
        <a href="view_message.php?user_id=<?php echo $report['user_id']; ?>">Open Message</a>
    </td>
</tr>
<?php endforeach; ?>

        </table>
    </div>
</body>
</html>
