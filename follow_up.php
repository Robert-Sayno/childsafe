<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include your database connection file
include_once('auth/connection.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch reported cases
$stmt = $conn->prepare("SELECT id, message, file_path, created_at FROM reports WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$cases = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Follow Up Case</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #007bff;
            color: #fff;
            padding: 15px;
            text-align: center;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .header h1 {
            margin: 0;
        }
        .nav {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }
        .nav a {
            color: #fff;
            text-decoration: none;
            padding: 0 10px;
        }
        .nav a:hover {
            text-decoration: underline;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .case {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }
        .case:last-child {
            border-bottom: none;
        }
        .case h3 {
            margin: 0;
        }
        .case p {
            margin: 5px 0;
        }
        .case a {
            color: #007bff;
            text-decoration: none;
        }
        .case a:hover {
            text-decoration: underline;
        }
        .status {
            font-weight: bold;
        }
        .options {
            margin-top: 20px;
            text-align: center;
        }
        .options a {
            display: inline-block;
            margin: 0 10px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .options a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>ChildSafe Chat</h1>
        <nav class="nav">
            <a href="index.php">Home</a>
            <a href="logout.php">Logout</a>
        </nav>
    </div>

    <div class="container">
        <h2>Your Reported Cases</h2>
        <?php if (!empty($cases)): ?>
            <?php foreach ($cases as $case): ?>
                <div class="case">
                    <h3>Case ID: <?php echo htmlspecialchars($case['id']); ?></h3>
                    <p><?php echo nl2br(htmlspecialchars($case['message'])); ?></p>
                    <?php if ($case['file_path']): ?>
                        <p><a href="<?php echo htmlspecialchars($case['file_path']); ?>" target="_blank">View Attachment</a></p>
                    <?php endif; ?>
                    <p>Reported on: <?php echo htmlspecialchars($case['created_at']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No cases reported yet.</p>
        <?php endif; ?>
        <div class="options">
            <a href="create_case.php">Report New Case</a>
            <a href="index.php">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>