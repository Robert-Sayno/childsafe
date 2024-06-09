<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include your database connection file
include_once('connection.php');

// Fetch the specific user details and their messages
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Fetch user details
    $stmt = $conn->prepare("SELECT id, phone FROM users WHERE id = ?");
    if (!$stmt) {
        echo "Error preparing statement: " . $conn->error;
        exit;
    }
    $stmt->bind_param("i", $user_id);
    if (!$stmt->execute()) {
        echo "Error executing statement: " . $stmt->error;
        exit;
    }
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    // Fetch messages for the user
    $stmt = $conn->prepare("SELECT r.id, r.message, r.admin_reply FROM reports r WHERE r.user_id = ? ORDER BY r.id ASC");
    if (!$stmt) {
        echo "Error preparing statement: " . $conn->error;
        exit;
    }
    $stmt->bind_param("i", $user_id);
    if (!$stmt->execute()) {
        echo "Error executing statement: " . $stmt->error;
        exit;
    }
    $messages = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
} else {
    // Redirect if user ID is not provided
    header('Location: view_reports.php');
    exit();
}

// Handle reply submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reply'])) {
    $reply = $_POST['reply'];
    $report_id = $_POST['report_id'];

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
    header("Location: view_message.php?user_id=$user_id");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Messages</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
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
            margin-top: 0;
        }

        .report-details {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
        }

        .message, .reply {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #e9ecef;
        }

        .reply {
            background-color: #d4edda;
        }

        textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            resize: vertical;
            margin-top: 10px;
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
        /* Add this CSS code to your existing styles */
nav {
    background-color: #333;
    padding: 10px 0;
    text-align: center;
}

.nav-link {
    margin-right: 10px;
    padding: 8px 15px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.nav-link:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
<nav>
    <a href="view_reports.php" class="nav-link">View Reports</a>
    <a href="view_users.php" class="nav-link">Manage Users</a>
    <a href="#" class="nav-link">Settings</a>
</nav>

    <div class="container">
        <h2>View Messages</h2>
        <?php if ($user): ?>
            <div class="report-details">
                <p><strong>User ID:</strong> <?php echo $user['id']; ?></p>
                <p><strong>User Phone:</strong> <?php echo $user['phone']; ?></p>
            </div>
            <div class="messages">
                <?php foreach ($messages as $message): ?>
                    <div class="message">
                        <p><strong>Message:</strong> <?php echo $message['message']; ?></p>
                        <?php if (!empty($message['admin_reply'])): ?>
                            <div class="reply">
                                <p><strong>Admin Reply:</strong> <?php echo $message['admin_reply']; ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Reply form -->
            <form action="view_message.php?user_id=<?php echo $user['id']; ?>" method="post">
                <textarea name="reply" placeholder="Enter your reply"></textarea>
                <input type="hidden" name="report_id" value="<?php echo end($messages)['id']; ?>">
                <button type="submit" name="reply">Submit Reply</button>
            </form>
        <?php else: ?>
            <p>User not found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
