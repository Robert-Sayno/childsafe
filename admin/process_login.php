<?php
session_start();
include_once('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];

    // Validate username
    if (empty($_POST['username'])) {
        $errors[] = "Username is required.";
    } else {
        $username = $_POST['username'];
        if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            $errors[] = "Invalid username format.";
        }
    }

    // Validate password
    if (empty($_POST['password'])) {
        $errors[] = "Password is required.";
    } else {
        $password = $_POST['password'];
    }

    if (empty($errors)) {
        // Prepare and bind the statement
        $stmt = $conn->prepare("SELECT id, username FROM admins WHERE username = ? AND password = ?");
        if (!$stmt) {
            $errors[] = "Database error: " . $conn->error;
        } else {
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $admin = $result->fetch_assoc();
                $_SESSION['id'] = $admin['id'];
                $_SESSION['username'] = $admin['username'];
                header('Location: index.php');
                exit();
            } else {
                $errors[] = "Invalid username or password.";
            }
            $stmt->close();
        }
    }

    if (!empty($errors)) {
        $_SESSION['login_errors'] = $errors;
        header('Location: login.php');
        exit();
    }
} else {
    header('Location: login.php');
    exit();
}
?>
