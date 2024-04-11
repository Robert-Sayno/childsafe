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
    </style>
</head>

<body>
    <div class="header">
        <h1>Welcome, <?php echo $admin_name; ?>!</h1>
    </div>

    <div class="nav-header">
        <div class="nav-links">
            <a href="#">Home</a>
            <a href="#">Admins</a>
            <a href="#">Employees</a>
            <a href="tasks.php">Assign tasks</a>
            <a href="#">Reports</a>
            <!-- Add more links as needed -->
        </div>
    </div>

    <div class="container">
        <div class="section">
            <div class="card">
                <div class="card-content">
                    <h2>Total Admins</h2>
                    <p>
                        <?php
                        // SQL query to count the number of admins
                        $sql = "SELECT COUNT(*) AS total_admins FROM admins";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            echo $row["total_admins"];
                        } else {
                            echo "0";
                        }
                        ?>
                    </p>
                    <a href="manage-admin.php">View All Admins</a>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="card">
                <div class="card-content">
                    <h2>Total Employees</h2>
                    <p>
                        <?php
                        // SQL query to count the number of employees
                        $sql = "SELECT COUNT(*) AS total_employees FROM employees";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            echo $row["total_employees"];
                        } else {
                            echo "0";
                        }
                        ?>
                    </p>
                    <a href="view_employees.php">View All Employees</a>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="card">
                <div class="card-content">
                    <h2>Employees on Leave (Daywise)</h2>
                    <p>Today: 5</p>
                    <p>Tomorrow: 7</p>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="card">
                <div class="card-content">
                    <h2>Employee Leadership Board</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Employee's Id</th>
                                <th>Employee's Name</th>
                                <th>Employee's Email</th>
                                <th>Salary in Rs.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch employees sorted by salary in descending order
                            $sql = "SELECT * FROM employees ORDER BY salary DESC";
                            $result = mysqli_query($conn, $sql);

                            if ($result && mysqli_num_rows($result) > 0) {
                                $serial_number = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $serial_number++ . "</td>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['fullname'] . "</td>";
                                    echo "<td>" . $row['email'] . "</td>";
                                    echo "<td>" . $row['salary'] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No employees found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
