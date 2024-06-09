<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once "auth/connection.php";

// Function to check if phone number already exists
function phoneExists($conn, $phone) {
    $stmt = $conn->prepare("SELECT phone FROM users WHERE phone = ?");
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $stmt->store_result();
    return $stmt->num_rows > 0;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $phone = $_POST['phone'];
    $age = $_POST['age'];
    $district = $_POST['district'];
    $category = $_POST['category'];

    // Check if phone number already exists
    if (phoneExists($conn, $phone)) {
        echo "<script>alert('This phone number is already registered. Please use a different number.');</script>";
    } else {
        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO users (phone, age, district, category) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $phone, $age, $district, $category);

        // Execute SQL statement
        if ($stmt->execute()) {
            echo "<script>alert('Account created successfully, login to report a case and more!'); window.location.href = 'login.php';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
        }

        nav {
            background-color: #007bff;
            padding: 10px 0;
            text-align: center;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li:last-child {
            margin-right: 0;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 15px;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .form-container {
            flex: 1;
            padding-right: 20px;
        }

        .image-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding-left: 20px;
        }

        .image-container img {
            max-width: 100%;
            border-radius: 10px;
        }

        .form-page {
            display: none;
        }

        .form-page.active {
            display: block;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        select {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
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

        .form-page button[type="submit"] {
            background-color: #1abc9c; /* Green for submit button */
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-link a {
            color: #007bff;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>ChildSafe App</h1>
    </header>
    <nav>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </nav>

    <div class="container">
        <div class="form-container">
            <form id="signupForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <!-- Step 1: Phone Number -->
                <div class="form-page active" id="page1">
                    <h2>Signup Form - Step 1</h2>
                    <div class="form-group">
                        <label for="phone">Phone Number:</label>
                        <input type="text" id="phone" name="phone" placeholder="Enter your phone number" required>
                    </div>
                    <button type="button" onclick="nextPage(1)">Next</button>
                </div>

                <!-- Step 2: Age Range -->
                <div class="form-page" id="page2">
                    <h2>Signup Form - Step 2</h2>
                    <div class="form-group">
                        <label for="age">Age Range:</label>
                        <select id="age" name="age" required>
                            <option value="">Select Victim's Age Range</option>
                            <option value="0-5">0-5 years</option>
                            <option value="6-10">6-10 years</option>
                            <option value="11-15">11-15 years</option>
                            <option value="16-18">16-18 years</option>
                        
                            <!-- Add other age options -->
                        </select>
                    </div>
                    <button type="button" onclick="prevPage(2)">Previous</button>
                    <button type="button" onclick="nextPage(2)">Next</button>
                </div>

                <!-- Step 3: District -->
                <div class="form-page" id="page3">
                    <h2>Signup Form - Step 3</h2>
                    <div class="form-group">
                        <label for="district">District:</label>
                        <select id="district" name="district" required>
                            <option value="">Select District</option>
                            <option value="Kamuli">Kamuli</option>
                            <option value="Jinja">Jinja</option>
                            <option value="Buyende">Buyende</option>
                            <option value="Iganga">Iganga</option>
                            <option value="Mbale">Mbale</option>
                            <option value="Namutumba">Namutumba</option>
                            <!-- Add district options -->
                        </select>
                    </div>
                    <button type="button" onclick="prevPage(3)">Previous</button>
                    <button type="button" onclick="nextPage(3)">Next</button>
                </div>

                <!-- Step 4: Reporter Category -->
                <div class="form-page" id="page4">
                    <h2>Signup Form - Step 4</h2>
                    <div class="form-group">
                        <label for="category">Reporter Category:</label>
                        <select id="category" name="category" required>
                            <option value="">Who is reporting</option>
                            <option value="Parent">Parent</option>
                            <option value="Guardian">Guardian</option>
                            <option value="Teacher">Teacher</option>
                            <option value="Community Member">Community Member</option>
                            <!-- Add category options -->
                        </select>
                    </div>
                    <button type="button" onclick="prevPage(4)">Previous</button>
                    <button type="submit">Submit</button>
                </div>
            </form>
            <div class="login-link">
                <p>Already signed up? <a href="login.php">Login here</a></p>
            </div>
        </div>
        <div class="image-container">
            <img src="images/childsafe1.jpeg" alt="Signup Image">
        </div>
    </div>

    <script>
        function nextPage(currentPage) {
            var pages = document.querySelectorAll('.form-page');
            pages[currentPage - 1].classList.remove('active');
            pages[currentPage].classList.add('active');
        }

        function prevPage(currentPage) {
            var pages = document.querySelectorAll('.form-page');
            pages[currentPage - 1].classList.remove('active');
            pages[currentPage - 2].classList.add('active');
        }
    </script>
</body>
</html>
