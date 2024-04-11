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
            max-width: 400px;
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
        
        .step {
            display: none;
        }
        
        .active {
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login Form</h2>
        <form id="loginForm" action="verify_otp.php" method="post">
            <div class="form-group step active" id="step1">
                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" placeholder="Enter your phone number" required>
                <button type="button" onclick="nextStep()">Next</button>
            </div>
            <div class="form-group step" id="step2">
                <label for="otp">OTP:</label>
                <input type="text" id="otp" name="otp" placeholder="Enter OTP" required>
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>

    <script>
        let currentStep = 1;
        const form = document.getElementById('loginForm');
        const steps = form.getElementsByClassName('step');

        function nextStep() {
            steps[currentStep - 1].classList.remove('active');
            currentStep++;
            steps[currentStep - 1].classList.add('active');
        }
    </script>
</body>
</html>
