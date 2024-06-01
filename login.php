<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    include_once('auth/connection.php');

    // Retrieve phone number from form
    $phone = trim($_POST["phone"]);

    // Check if the phone number contains only digits
    if (!is_numeric($phone)) {
        echo "<script>alert('Please enter a valid phone number.'); window.location.href = 'login.php';</script>";
        exit();
    }
    // Prepare and bind SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id FROM users WHERE phone = ?");
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $stmt->bind_result($user_id);
    
    // Fetch the first row
    if ($stmt->fetch()) {
        // Phone number exists, store user ID in session
        $_SESSION['user_id'] = $user_id;
        
        // Close the statement
        $stmt->close();

        // Redirect to index.php after successful login
        header("Location: index.php");
        exit();
    } else {
        // Phone number doesn't exist, show error message
        echo "<script>alert('Phone number not found. Please try again.'); window.location.href = 'login.php';</script>";
        exit();
    }
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: calc(100% - 120px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .nav {
            background-color: #007bff;
            padding: 10px;
            text-align: center;
            border-radius: 0 0 10px 10px;
        }

        .nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
        }

        .nav a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Login Form</h1>
    </div>
    <div class="nav">
        <a href="#">Home</a>
        <a href="#">About</a>
        <a href="#">Contact</a>
    </div>

    <div class="container">
        <form id="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" placeholder="Enter your phone number starting with 07.." required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>

    <script>
        // JavaScript for displaying success alert after successful login
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['phone'])): ?>
        alert("Login successful. Redirecting to redirecing you soon.");
        <?php endif; ?>
    </script>
</body>

</html>
