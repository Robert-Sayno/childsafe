<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - users</title>
    <style>
        body {
            background-image: url('lost_property_bg.jpg');
            background-size: cover;
            background-position: center;
            color: #7734eb;
            font-family: Arial, sans-serif;
            margin: 0;
        }

        .dashboard-container {
            width: 80%;
            margin: 0 auto;
            text-align: center;
            padding: 20px;
        }

        .dashboard-header {
            background-color: #2c3e50;
            color: #fff;
            padding: 10px;
            margin-bottom: 20px;
        }

        .dashboard-section {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            overflow: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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

        a {
            color: #3498db;
            text-decoration: none;
            margin-right: 10px;
        }

        a:hover {
            text-decoration: underline;
        }

        .property-image {
            max-width: 100%;
            max-height: 100px;
        }

        .logout-btn {
            color: #fff;
            background-color: #e74c3c;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .logout-btn:hover {
            background-color: #c0392b;
        }

        .search-filter-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .search-input {
            padding: 5px;
        }

        .nav-container {
            background-color: #3498db;
            padding: 10px;
            text-align: center;
            margin-bottom: 20px;
        }

        .nav-link {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            margin: 0 10px;
        }

        .nav-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php
    // Include necessary files and authentication check
    include_once('../auth/connection.php');
    include_once('../auth/auth_functions.php');

    // Fetch employees from the database
    $sql_employees = "SELECT * FROM users";
    $result_employees = mysqli_query($conn, $sql_employees);

    // Check if the query was successful
    if ($result_employees) {
        $employees = mysqli_fetch_all($result_employees, MYSQLI_ASSOC);
    } else {
        // Handle the error, you can customize this part based on your needs
        die('Error fetching employees: ' . mysqli_error($conn));
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

    <div class="dashboard-container">
        <div class="dashboard-header">
            <h2>Welcome - VIEW ALL SYSTEM  USERS</h2>
        </div>

        <!-- Navigation Links -->
        <div class="nav-container">
            <a class="nav-link" href="index.php">Home Dashboard</a>
            <!-- Add more navigation links as needed -->
        </div>

        <!-- Search Input -->
        <div class="search-filter-container">
            <input type="text" id="searchInput" class="search-input" placeholder="Search...">
        </div>

        <!-- Display employees in a table -->
        <div class="dashboard-section">
            <h3>All Users</h3>
            <table id="employeeTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        
                        <th>phone</th>
                       
                        <th>age</th>
                        <th>District</th>
                        <th>Reporters category</th>
                        <th>Actions</th> <!-- New column for actions -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($employees as $employee) : ?>
                        <tr>
                            <td><?php echo $employee['id']; ?></td>
                         
                            <td><?php echo $employee['phone']; ?></td>
                           
                            <td><?php echo $employee['age']; ?></td>
                            <td><?php echo $employee['district']; ?></td>
                            <td><?php echo $employee['category']; ?></td>
                            <td>
                                <a href="edit_user.php?id=<?php echo $employee['id']; ?>">Edit</a>
                                <a href="delete_user.php?id=<?php echo $employee['id']; ?>">Delete</a>
                                <a href="manage_user.php?id=<?php echo $employee['id']; ?>">Manage</a>
                            </td> <!-- Action buttons -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Search Filter Function
        function searchFilter() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("employeeTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2]; // Change index to match the column you want to search (here it's the Name column)
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        // Attach event listener to search input
        document.getElementById("searchInput").addEventListener("keyup", searchFilter);
    </script>
</body>

</html>
