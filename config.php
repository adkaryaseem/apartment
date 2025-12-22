<?php
function connect() {
    // Database configuration
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "apartment_management";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check connection
    if (!$conn) {
        // Log error and exit gracefully
        error_log("Database connection failed: " . mysqli_connect_error());
        die("Database connection error. Please try again later.");
    }

    // Set charset
    mysqli_set_charset($conn, "utf8");

    return $conn;
}
?>
