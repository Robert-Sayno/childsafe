<?php
// Establish a database connection (replace these values with your actual database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "childsafe";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the message and file data from the request
    $message = $_POST['message'] ?? '';
    $file = $_FILES['file'] ?? null;

    // Handle file upload (if applicable)
    $file_path = '';
    if ($file && $file['error'] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/"; // Directory where uploaded files will be stored
        $target_file = $target_dir . basename($file["name"]);
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            $file_path = $target_file;
        }
    }
    // Insert the message data into the database
    $sql = "INSERT INTO reports (message, file_path) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $message, $file_path);
    if ($stmt->execute()) {
        // Message inserted successfully
        echo "Your message has been sent";
    } else {
        // Error inserting message
        echo "Error sending message message";
    }
}

// Close the database connection
$conn->close();
?>
