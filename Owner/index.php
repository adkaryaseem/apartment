<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/logo-no-bg.png" type="image/x-icon">
    <link rel="stylesheet" href="../style/style-owner-dashboard.css">
    <title>Owner Dashboard</title>
    
</head>
<body>
    <div class="container">
        <div class="top">
            <div class="logo">
                <img src="../images/logo-no-bg.png" alt="logo">
            </div>
            <div class="heading">
                <h2>Welcome, Owner!</h2>
                <h3>Please select an option:</h3>
            </div>
            <div class="logout">
                <a href="../index.php" class="logout-btn">Logout</a>
            </div>
        </div>
        <ul>
            <li><a href="viewempl.php">View Employees</a></li>
            <li><a href="complaintcount.php">Count Total Complaints</a></li>
            <li><a href="createemployee.php">Create Employee</a></li>
            <li><a href="roomdetails.php">Display Details of Rooms</a></li>
            <li><a href="feesrecieved.php">Display Details of Fee Payment's</a></li>
        </ul>
        <button class="export-btn" onclick="exportToCSV()">Export to CSV</button>
    </div>

    <script>
        function downloadCSV(csv, filename) {
            var csvFile;
            var downloadLink;

            // CSV file
            csvFile = new Blob([csv], { type: "text/csv" });

            // Download link
            downloadLink = document.createElement("a");

            // File name
            downloadLink.download = filename;

            // Create a link to the file
            downloadLink.href = window.URL.createObjectURL(csvFile);

            // Hide download link
            downloadLink.style.display = "none";

            // Add the link to DOM
            document.body.appendChild(downloadLink);

            // Click download link
            downloadLink.click();
        }

        function exportToCSV() {
            var csv = 'Dashboard Content, Goes, Here'; // Example content

            // File name
            var filename = 'dashboard.csv';

            downloadCSV(csv, filename);
        }
    </script>
</body>
</html>
