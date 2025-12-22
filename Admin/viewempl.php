<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style-view-empl.css">
    <link rel="shortcut icon" href="../images/logo-no-bg.png" type="image/x-icon">
    <title>View Employees</title>    
</head>
<body>
    <div class="container">
        <?php
        // Start session
        session_start();

        // Database connection parameters
        include_once ('../config.php');

        $conn = connect();

        // Check if a deletion request is made
        if (isset($_GET['delete_id'])) {
            $delete_id = $_GET['delete_id'];
            // Delete the employee with the given ID
            $sql = "DELETE FROM employee WHERE employee_id = $delete_id";
            if ($conn->query($sql) === TRUE) {
                echo "Employee deleted successfully.";
            } else {
                echo "Error deleting employee: " . $conn->error;
            }
        }

        // Query to retrieve all employees
        $query = "SELECT * FROM employee";

        // Execute query
        $result = $conn->query($query);

        // Check if any employees found
        if ($result->num_rows > 0) {
            $index=1;
            // Output employee details
            echo "<h2>All Employees</h2>";
            echo "<table>";
            echo "
            <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Action</th>
            </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $index . "</td>";
                echo "<td>" . $row["first_name"] . "</td>";
                echo "<td>" . $row["last_name"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["phone_number"] . "</td>";
                echo "<td><a href='?delete_id=" . $row["employee_id"] . "' class='delete-button'>Delete</a></td>";
                echo "</tr>";
                $index++;
            }
            echo "</table>";
        } else {
            echo "No employees found.";
        }

        // Close database connection
        $conn->close();
        ?>
        <br>
        <a href="./index.php" class="back-button">Return Home</a>
        <a href="createemployee.php" class="create-employee-button">Create Employee</a>
    </div>
</body>
</html>
