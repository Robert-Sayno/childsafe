<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start the session at the beginning of the script
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChildSafe Reporting System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #3498db;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        main {
            padding: 20px;
        }

        .hero {
            text-align: center;
        }

        .features {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .feature {
            position: relative;
            width: 30%;
            overflow: hidden;
            cursor: pointer;
        }

        .feature img {
            width: 100%;
            height: auto;
            transition: opacity 0.3s ease;
        }

        .feature:hover img {
            opacity: 0.7;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .feature:hover .overlay {
            opacity: 1;
        }

        .overlay h3,
        .overlay p {
            margin: 0;
            padding: 5px;
            text-align: center;
        }

        .overlay a {
            color: #fff;
            text-decoration: none;
            margin-top: 10px;
            border: 1px solid #fff;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .overlay a:hover {
            background-color: #fff;
            color: #3498db;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .user-info {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border-radius: 10px;
        }

        .user-info a {
            color: #fff;
            text-decoration: none;
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <header>
        <h1>ChildSafe Reporting System</h1>
    </header>

    <main>
        <section class="hero">
            <h2>Welcome to ChildSafe</h2>
            <p>Report child abuse and protect children's rights</p>
            <a href="report.html" class="btn">Report Abuse</a>
        </section>

        <section class="features">
            <div class="feature">
                <a href="seek_guidance.html">
                    <img src="images/me.jpeg" alt="Feature 1">
                    <div class="overlay">
                        <h3>24/7 Reporting</h3>
                        <p>Report child abuse anytime, anywhere.</p>
                        <a href="guidance_and_couselling.php">Seek Guidance and Counseling</a>
                    </div>
                </a>
            </div>
            <div class="feature">
                <a href="report_case.html">
                    <img src="images/me.jpeg" alt="Feature 2">
                    <div class="overlay">
                        <h3>Anonymous Reporting</h3>
                        <p>Ensure confidentiality with our anonymous reporting system.</p>
                        <a href="report_case.php">Report a Case</a>
                    </div>
                </a>
            </div>
            <div class="feature">
                <a href="follow_up.html">
                    <img src="images/me.jpeg" alt="Feature 3">
                    <div class="overlay">
                        <h3>Track Progress</h3>
                        <p>Stay informed about the progress of reported cases.</p>
                        <a href="follow_up.php">Follow Up on Cases</a>
                    </div>
                </a>
            </div>
        </section>
    </main>
   <!-- User info section -->
   <div class="user-info">
        <?php
        // Display welcome message and logout link if user is logged in
        $phone = $_SESSION['phone'];
        echo "Welcome, $phone!";
        echo '<a href="logout.php">Logout</a>';
        ?>
    </div>
    </div>
</body>

</html>
