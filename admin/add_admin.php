<?php
session_start();

$servername = "localhost";
$username = "root";  // Change this to your database username
$password = "";      // Change this to your database password
$dbname = "childsafe"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_user = $_POST['new_username'];
    $new_pass = $_POST['new_password'];

    // Basic sanitization
    $new_user = stripslashes($new_user);
    $new_pass = stripslashes($new_pass);
    $new_user = mysqli_real_escape_string($conn, $new_user);
    $new_pass = mysqli_real_escape_string($conn, $new_pass);

    // Password hashing for security
    $hashed_pass = password_hash($new_pass, PASSWORD_DEFAULT);

    $sql = "INSERT INTO admins (username, password) VALUES ('$new_user', '$hashed_pass')";

    if ($conn->query($sql) === TRUE) {
        $success = "New admin added successfully";
        header("Location: dashboard.php?success=" . urlencode($success));
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        header("Location: dashboard.php?error=" . urlencode($error));
    }
}

$conn->close();
?>
