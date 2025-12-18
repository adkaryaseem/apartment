<?php
// Database connection parameters
include ('../config.php');

$conn = connect();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $tenant_id = $_POST['tenant'];
    $service_id = $_POST['service'];
    $time = $_POST['time'];

    // Prepare and execute SQL statement to insert service request
    $insert_query = "INSERT INTO service_requests (tenant_id, service_id, requested_time) VALUES ('$tenant_id', '$service_id', '$time')";

    if ($conn->query($insert_query) === TRUE) {
        // Redirect back to the service request page
        header("Location: requestservice.php");
        exit();
    } else {
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }
}

// Close database connection
$conn->close();
?>
