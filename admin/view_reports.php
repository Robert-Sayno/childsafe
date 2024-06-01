<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include your database connection file
include_once('connection.php');

// Fetch all reports from the database along with user phone numbers and report IDs
$stmt = $conn->prepare("SELECT r.id, r.user_id, u.phone FROM reports r INNER JOIN users u ON r.user_id = u.id");
$stmt->execute();
$reports = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Handle reply submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reply'])) {
    $report_id = $_POST['report_id'];
    $reply = $_POST['reply'];

    // Update the report with the admin's reply
    $stmt = $conn->prepare("UPDATE reports SET admin_reply = ? WHERE id = ?");
    $stmt->bind_param("si", $reply, $report_id);

    if ($stmt->execute()) {
        // Redirect to prevent form resubmission on page refresh
        header('Location: admin.php');
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
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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

        button {
            padding: 8px 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
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
                    <!-- View message form -->
                    <form action="view_message.php" method="post">
                        <input type="hidden" name="report_id" value="<?php echo $report['user_id']; ?>">
                        <button type="submit" name="view_message">
                            Open Message 
                            <?php if (empty($report['message'])): ?>
                           <!-- <span class="notification">New</span> - - >
                            <?php endif; ?>
                        </button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    
 

</body>
</html>
