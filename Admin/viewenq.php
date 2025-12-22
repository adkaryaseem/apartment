<?php
// Database connection parameters
include ('../config.php');


// Create connection
$conn = connect();

// Fetch enquiries from the database
$enquiry_query = "SELECT * FROM enquiries";
$enquiry_result = $conn->query($enquiry_query);

// Function to sanitize data for CSV
function sanitizeForCSV($value) {
    // Escape special characters
    $value = htmlspecialchars_decode($value, ENT_QUOTES);
    // Enclose in double quotes and escape double quotes if necessary
    $value = '"' . str_replace('"', '""', $value) . '"';
    return $value;
}

// Function to generate CSV file
function generateCSV($data) {
    $file = fopen('enquiries.csv', 'w');
    // Add headers
    fputcsv($file, array('Name', 'Email', 'Contact'));
    // Add data
    foreach ($data as $row) {
        fputcsv($file, array($row['name'], $row['email'], $row['contact']));
    }
    fclose($file);
}

// // Function to generate Excel file
// function generateExcel($data) {
//     // Load PHPExcel library
//     require_once 'PHPExcel/Classes/PHPExcel.php';

//     // Create new PHPExcel object
//     $objPHPExcel = new PHPExcel();

//     // Set document properties
//     $objPHPExcel->getProperties()->setCreator("Apartment Management")
//                                  ->setLastModifiedBy("Apartment Management")
//                                  ->setTitle("Enquiries")
//                                  ->setSubject("Enquiries")
//                                  ->setDescription("Enquiries Data")
//                                  ->setKeywords("enquiries")
//                                  ->setCategory("Enquiries");

//     // Add headers
//     $objPHPExcel->setActiveSheetIndex(0)
//                 ->setCellValue('A1', 'Name')
//                 ->setCellValue('B1', 'Email')
//                 ->setCellValue('C1', 'Contact');

//     // Add data
//     $rowIndex = 2;
//     foreach ($data as $row) {
//         $objPHPExcel->setActiveSheetIndex(0)
//                     ->setCellValue('A' . $rowIndex, $row['name'])
//                     ->setCellValue('B' . $rowIndex, $row['email'])
//                     ->setCellValue('C' . $rowIndex, $row['contact']);
//         $rowIndex++;
//     }

//     // Set active sheet index to the first sheet
//     $objPHPExcel->setActiveSheetIndex(0);

//     // Redirect output to a client’s web browser (Excel5)
//     header('Content-Type: application/vnd.ms-excel');
//     header('Content-Disposition: attachment;filename="enquiries.xls"');
//     header('Cache-Control: max-age=0');

//     $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
//     $objWriter->save('php://output');
//     exit;
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/logo-no-bg.png" type="image/x-icon">
    <link rel="stylesheet" href="../style/style-enquire-view.css">
    <title>View Enquiries</title>
</head>
<body>
    <h2>Enquiries</h2>
    <table>
        <tr>
            <th>S.N</th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Enquiry Date & Time</th>
        </tr>
        <?php
        if ($enquiry_result->num_rows > 0) {
            $index=1;
            while ($row = $enquiry_result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $index . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["contact"] . "</td>";
                echo "<td>" . $row["enquiry_date"] . "</td>";
                echo "</tr>";
                $index++;
            }
        } else {
            echo "<tr><td colspan='3'>No enquiries found</td></tr>";
        }
        ?>
    </table>
    <div class="button-container">
        <button onclick="location.href='exportenq.php'" class="export-button">Export Data</button>
        <button onclick="location.href='./index.php'" class="return-button">Return to Home</button>
    </div>
</body>
</html>


<?php
// Close database connection
$conn->close();
?>
