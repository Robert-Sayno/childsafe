<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include your database connection file
include_once('connection.php');

// Fetch the specific report details
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['report_id'])) {
    $report_id = $_POST['report_id'];

    $stmt = $conn->prepare("SELECT r.id, r.user_id, u.phone, r.message, r.file_path, r.admin_reply FROM reports r INNER JOIN users u ON r.user_id = u.id WHERE r.id = ?");
    if (!$stmt) {
        echo "Error preparing statement: " . $conn->error;
        exit;
    }

    $stmt->bind_param("i", $report_id);
    if (!$stmt->execute()) {
        echo "Error executing statement: " . $stmt->error;
        exit;
    }

    $result = $stmt->get_result();
    if (!$result) {
        echo "Error fetching result: " . $stmt->error;
        exit;
    }

    $report = $result->fetch_assoc();
    $stmt->close();
} else {
    // Redirect if report ID is not provided
    header('Location: admin.php');
    exit();
}

// Handle reply submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reply'])) {
    $reply = $_POST['reply'];

    // Update the report with the admin's reply
    $stmt = $conn->prepare("UPDATE reports SET admin_reply = ? WHERE id = ?");
    if (!$stmt) {
        echo "Error preparing statement: " . $conn->error;
        exit;
    }

    $stmt->bind_param("si", $reply, $report_id);
    if (!$stmt->execute()) {
        echo "Error executing statement: " . $stmt->error;
        exit;
    }

    // Redirect to prevent form resubmission on page refresh
    header('Location: admin.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Message</title>
    <!-- Add your CSS styles here -->
    <style>
        /* CSS styles */
    </style>
</head>
<body>
    <!-- Display the specific report details -->
    <div class="container">
        <h2>View Message</h2>
        <p><strong>Report ID:</strong> <?php echo $report['id']; ?></p>
        <p><strong>User ID:</strong> <?php echo $report['user_id']; ?></p>
        <p><strong>User Phone:</strong> <?php echo $report['phone']; ?></p>
        <p><strong>Message:</strong> <?php echo $report['message']; ?></p>
        <p><strong>File Path:</strong> <?php echo $report['file_path']; ?></p>
        <p><strong>Admin Reply:</strong> <?php echo $report['admin_reply']; ?></p>

        <!-- Reply form -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="report_id" value="<?php echo $report_id; ?>">
            <textarea name="reply" placeholder="Enter your reply"></textarea>
            <button type="submit" name="reply">Submit Reply</button>
        </form>
    </div>
    
    <!-- Add your JavaScript code here -->

</body>
</html>
