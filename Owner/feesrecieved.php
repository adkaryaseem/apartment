<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style-fee-received.css">
    <link rel="shortcut icon" href="../images/logo-no-bg.png" type="image/x-icon">
    <title>View Maintenance Fees</title>
</head>
<body>
    <h2>Select Tenant to View Maintenance Fees</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="tenant_name">Select Tenant:</label>
        <select id="tenant_name" name="tenant_name">
            <?php
            // Database connection parameters
            include ('../config.php');

            $conn = connect();

            // Retrieve tenant names for dropdown
            $tenant_query = "SELECT tenant_id, CONCAT(first_name, ' ', last_name) AS tenant_name FROM tenant";
            $tenant_result = $conn->query($tenant_query);

            if ($tenant_result->num_rows > 0) {
                while ($row = $tenant_result->fetch_assoc()) {
                    echo "<option value='" . $row["tenant_id"] . "'>" . $row["tenant_name"] . "</option>";
                }
            }

            // Close database connection
            $conn->close();
            ?>
        </select>
        <input type="submit" value="View Fees">
        <div class="return">
        <a href="owner_dashboard.php" class="back-button">Return Home</a>
    </div>
    </form>

    <?php
    // Display maintenance fees if form submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["tenant_name"])) {
        $selected_tenant_id = $_POST["tenant_name"];

        // Database connection

            $conn = connect();

        // Query to retrieve maintenance fees paid by the selected tenant
        $fee_query = "SELECT payment_id, amount_paid, payment_date FROM maintenance_payment WHERE tenant_id = $selected_tenant_id";
        $fee_result = $conn->query($fee_query);

        if ($fee_result->num_rows > 0) {
            // Output fee details
            echo "<h3>Maintenance Fees Paid by Selected Tenant:</h3>";
            echo "<table>";
            echo "<tr><th>Payment ID</th><th>Amount Paid</th><th>Payment Date</th></tr>";
            while ($row = $fee_result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["payment_id"] . "</td>";
                echo "<td>" . $row["amount_paid"] . "</td>";
                echo "<td>" . $row["payment_date"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No maintenance fees found for this tenant.";
        }

        // Close database connection
        $conn->close();
    }
    ?>
</body>
</html>
