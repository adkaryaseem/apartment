<?php
include ('../auth.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Complaints</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        include ('../config.php');

        $conn = connect();

        $query = "SELECT COUNT(*) AS total_complaints FROM complaint";

        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $total_complaints = $row["total_complaints"];

            echo "<h2>Total Complaints: $total_complaints</h2>";
        } else {
            echo "No complaints found.";
        }

        // Close database connection
        $conn->close();
        ?>
    </div>
</body>
</html>
