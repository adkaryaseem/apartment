<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/logo-no-bg.png" type="image/x-icon">
    <title>Owner Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #1b0a3aff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .top{
            display:flex;
            flex-direction:row;
        }
        .heading{
            /* display:flex; */
            flex-direction:column;
            margin: 2px 50px 5px 10px;
        }
        .logo{
            /* display:flex; */
            flex-direction:column;
            align-items:center;
            justify-content:center;
        }
        .logo img{
            margin:2px 50px 5px 15px;
            height:7rem;
        }
        h2, h3 {
            margin:none;
            text-align: center;
            color: #868686ff;
        }
        ul {
            list-style-type: none;
            padding: 0;
            margin: 20px 0;
        }
        li {
            margin-bottom: 10px;
        }
        a {
            display: block;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        a:hover {
            background-color: #0056b3;
        }
        .logout{
            display: flex;
            flex-direction: column;
        }
        .logout-btn {
            /* position: relative; */
            /* top: 70px;*/
            /* right: 290px;  */
            background-color: #f00a21ff;
            color: #fff;
            padding: 10px 25px;
            border: none;
            border-radius: 15px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .logout-btn:hover {
            background-color: #470f15ff;
        }
        .export-btn {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #04310fff;
            color: #fff;
            border: none;
            font-size:15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.5s ease-in-out 0.5s;
        }
        .export-btn:hover {
            background-color: #0ee23cff;
            color:black;
            transform:scale(1.1,1.1)
        }
    </style>
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
