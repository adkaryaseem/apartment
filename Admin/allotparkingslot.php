<?php
include('../auth.php');
include_once ('../config.php');

// Check if slotNumber and employeeId are set in the POST request
if (isset($_POST['slotNumber'], $_POST['employeeId'])) {
    // Get slot number and employee ID from POST data
    $slotNumber = $_POST['slotNumber'];
    $employeeId = $_POST['employeeId'];
    
    // Create database connection
    $conn = connect();
    
    // Insert parking slot allotment into the database
    $sql = "INSERT INTO parking (employee_id, parking_slot) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $employeeId, $slotNumber);

    // Execute prepared statement
    if ($stmt->execute() === TRUE) {
        echo "Parking slot allotted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // If slotNumber or employeeId is not set, display an error message
    echo "Error: slotNumber or employeeId is not set";
}
?>
