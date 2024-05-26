<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .header {
            background-color: #3498db;
            color: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 20px;
            width: 100%;
        }

        .nav-header {
            background-color: #2c3e50;
            color: #fff;
            padding: 10px;
            border-radius: 5px 5px 0 0;
            margin-bottom: 20px;
            width: 100%;
        }

        .nav-links {
            display: flex;
            justify-content: center;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            margin: 0 10px;
        }

        .nav-links a:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .section {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            flex-basis: calc(33.33% - 20px);
        }

        .card {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .chart {
            width: 100%;
            height: 300px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Welcome, Admin!</h1>
    </div>

    <div class="nav-header">
        <div class="nav-links">
            <a href="#">Home</a>
            <a href="#">Manage Admins</a>
            <a href="#">Manage Employees</a>
            <a href="#">Assign Tasks</a>
            <a href="#">View Reports</a>
            <a href="#">Settings</a>
        </div>
    </div>

    <div class="container">
        <div class="section">
            <div class="card">
                <div class="card-content">
                    <h2>Total Admins</h2>
                    <p>10</p>
                    <a href="#">View All Admins</a>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="card">
                <div class="card-content">
                    <h2>Total Employees</h2>
                    <p>50</p>
                    <a href="#">View All Employees</a>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="card">
                <div class="card-content">
                    <h2>Tasks Overview</h2>
                    <p>Total Tasks: 20</p>
                    <p>Completed Tasks: 15</p>
                    <p>Pending Tasks: 5</p>
                    <a href="#">Assign New Task</a>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="card">
                <div class="card-content">
                    <h2>Reports</h2>
                    <p>Generate various reports for analysis.</p>
                    <a href="#">View Reports</a>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="card">
                <div class="card-content">
                    <h2>Settings</h2>
                    <p>Customize system settings here.</p>
                    <a href="#">Manage Settings</a>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="card">
                <div class="card-content">
                    <h2>Employee Performance</h2>
                    <p>View employee performance metrics.</p>
                    <a href="#">View Performance</a>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="card">
                <div class="card-content">
                    <h2>Task Completion Statistics</h2>
                    <div class="chart">
                        <!-- Include your chart here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

