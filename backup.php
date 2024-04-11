<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <style>
        body {
            background-color: #e0e0e0; /* Light gray background */
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
        }

        nav ul li {
               
            display: inline;
            margin-right: 20px;
        }

        nav ul li:last-child {
            margin-right: 0;
            
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
            width: 100%;
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
            background-color: #2980b9; /* Darker blue on hover */
        }

.form-page button[type="submit"] {
    background-color: #1abc9c; /* Green for submit button */
}
nav ul li.active a {
font: size 15px;


  color: #007bff; /* Set color for active link */
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
        <div class="form-page active" id="page1">
            <h2>Signup Form - Step 1</h2>
            <form id="formPage1">
                <div class="form-group">
                    <label for="phone">Phone Number:</label>
                    <input type="text" id="phone" name="phone" placeholder="Enter your phone number" required>
                </div>
                <button type="button" onclick="nextPage(1)">Next</button>
            </form>
        </div>
        <div class="form-page" id="page2">
            <form id="formPage2">
                <div class="form-group">
                    <label for="age">Age Range:</label>
                    <select id="age" name="age" required>
                        <option value="">Select Victim's Age Range</option>
                        <option value="0-5">0-5 years</option>
                        <option value="6-10">6-10 years</option>
                        <option value="11-15">11-15 years</option>
                        <option value="16-18">16-18 years</option>
                        <option value="19+">19+ years</option>
                    </select>
                </div>
                <button type="button" onclick="prevPage(2)">Previous</button>
                <button type="button" onclick="nextPage(2)">Next</button>
            </form>
        </div>
        <div class="form-page" id="page3">
            <form id="formPage3">
                <div class="form-group">
                    <label for="district">District:</label>
                    <select id="district" name="district" required>
                        <option value="">Select District</option>
                        <option value="District 1">kamuli</option>
                        <option value="District 2">jinja</option>
                        <option value="District 3">buyende</option>
                        <option value="District 1">buguri</option>
                        <option value="District 2">mbale</option>
                        <option value="District 3">namutumba</option>
                        
                        <!-- Add more districts as needed -->
                    </select>
                </div>
                <button type="button" onclick="prevPage(3)">Previous</button>
                <button type="button" onclick="nextPage(3)">Next</button>
            </form>
        </div>
        <div class="form-page" id="page4">
            <form id="formPage4">
                <div class="form-group">
                    <label for="category">Reporter Category:</label>
                    <select id="category" name="category" required>
                        <option value="">Who is reporting</option>
                        <option value="Parent">Parent</option>
                        <option value="Parent">guadian</option>
                        <option value="Teacher">Teacher</option>
                        <option value="Community Member">Community Member</option>
                        <!-- Add more categories as needed -->
                    </select>
                </div>
                <button type="button" onclick="prevPage(4)">Previous</button>
                <button type="submit">Submit</button>
            </form>
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
