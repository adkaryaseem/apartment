<?php
// Database connection details (replace with your actual credentials)
include ('../config.php');


// Create connection
$conn = connect();

// Fetch employee data
$sql = "SELECT * FROM employee";
$result = $conn->query($sql);

$employees = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
}

// Close database connection
$conn->close();

// Output employee data as JSON
header('Content-Type: application/json');
echo json_encode($employees);
?>
