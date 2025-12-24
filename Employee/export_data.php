<?php
include ('../auth.php');

include ('../config.php');

$conn = connect();

$query = "SELECT employee_id, first_name, last_name, email, phone_number, admin_id, owner_id, name FROM employee";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    $filename = "employee_data.csv";

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    $output = fopen('php://output', 'w');

    fputcsv($output, array('Employee ID', 'First Name', 'Last Name', 'Email', 'Phone Number', 'Admin ID', 'Owner ID', 'Name'));

    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }

    fclose($output);
} else {
    echo "No data found";
}

$conn->close();
?>
