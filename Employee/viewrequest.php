<?php
include ('../auth.php');

// Database connection parameters
include ('../config.php');

$conn = connect();

$request_query = "SELECT service_requests.request_id, CONCAT(tenant.first_name, ' ', tenant.last_name) AS tenant_name, 
                   tenant.email AS tenant_email, services.service_name, DATE_FORMAT(service_requests.requested_time, '%Y-%m-%d %H:%i:%s') AS requested_time
                   FROM service_requests
                   INNER JOIN tenant ON service_requests.tenant_id = tenant.tenant_id
                   INNER JOIN services ON service_requests.service_id = services.service_id";

$request_result = $conn->query($request_query);

// Function to send email with attachments (optional)
function sendEmailWithAttachment($to, $subject, $message, $file_path) {
    $headers = "From: noreply@yourdomain.com\r\n"; // Replace with your sender email address
    $headers .= "Content-Type: multipart/mixed; boundary=\"unique_boundary\"\r\n";

    // Message part
    $message_part = "--unique_boundary\r\n";
    $message_part .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $message_part .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
    $message_part .= $message . "\r\n";

    // Attachment part
    $attachment_part = "--unique_boundary\r\n";
    $attachment_part .= "Content-Type: application/pdf; name=\"invoice.pdf\"\r\n";
    $attachment_part .= "Content-Transfer-Encoding: base64\r\n";
    $attachment_part .= "Content-Disposition: attachment; filename=\"invoice.pdf\"\r\n\r\n";
    $attachment_part .= base64_encode(file_get_contents($file_path)) . "\r\n";

    $headers .= "--unique_boundary--\r\n";

    return mail($to, $subject, $message_part . $attachment_part, $headers);
}

// Function to generate invoice with additional details and styling (optional)
function generateInvoice($service_name, $amount, $tenant_email, $file_path = null) {
    $invoice_html = "<h2>Invoice</h2>";
    $invoice_html .= "<p><strong>Tenant Name:</strong> " . $tenant_email . "</p>"; // Replace with actual tenant name from database
    $invoice_html .= "<p><strong>Service:</strong> " . $service_name . "</p>";
    $invoice_html .= "<p><strong>Amount:</strong> $" . number_format($amount, 2, '.', ',') . "</p>";

    // Additional invoice details and styling (optional)
    // ...

    if ($file_path) {
        // Save the invoice HTML to PDF using a library like mPDF
        // ...
        // Send email with the generated PDF attachment
        sendEmailWithAttachment($tenant_email, "Invoice for Service Request", $invoice_html, $file_path);
    } else {
        // Send email with the invoice HTML content
        sendEmail($tenant_email, "Invoice for Service Request", $invoice_html);
    }
}

// Function to handle approval of service request
function approveRequest($request_id, $service_name, $tenant_email, $conn) {

    // 🔐 Allow only admins
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        error_log("Unauthorized approval attempt. User ID: " . ($_SESSION['user_id'] ?? 'unknown'));
        exit("Unauthorized access");
    }

    // Validate request ID
    $request_id = filter_var($request_id, FILTER_VALIDATE_INT);
    if (!$request_id) {
        return false;
    }

    /* 1. Get service cost */
    $stmt = $conn->prepare(
        "SELECT cost FROM services WHERE service_name = ?"
    );
    $stmt->bind_param("s", $service_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        error_log("Service cost not found: $service_name");
        return false;
    }

    $row = $result->fetch_assoc();
    $amount = $row['cost'];

    /* 2. Approve request */
    $stmt2 = $conn->prepare(
        "UPDATE service_requests
         SET status = ?, amount = ?
         WHERE id = ?"
    );

    $status = "Approved";
    $stmt2->bind_param("sdi", $status, $amount, $request_id);

    if (!$stmt2->execute()) {
        error_log("Failed to approve request ID: $request_id");
        return false;
    }

    /* 3. Generate invoice */
    generateInvoice($service_name, $amount, $tenant_email);

    return true;
}

    
    // Function to handle denial of service request
    function denyRequest($tenant_email) {
        sendEmail($tenant_email, "Service Request Denied", "Your service request has been denied.");
    }
    
    ?>
    
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/logo-no-bg.png" type="image/x-icon">
    <link rel="stylesheet" href="../style/style-view-request.css">
    <title>View Service Requests</title>
</head>
<body>
    <div class="container">
        <h2>Service Requests</h2>
        <table>
            <table background="/wp-content/uploads/wov.png">
            <tr>
                <th>S.N</th>
                <th>Tenant Name</th>
                <th>Service Name</th>
                <th>Requested Time</th>
                <th>Action</th>
            </tr>
            <?php
            if ($request_result->num_rows > 0) {
                $index=1;
                while ($row = $request_result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $index . "</td>";
                    echo "<td>" . $row["tenant_name"] . "</td>";
                    echo "<td>" . $row["service_name"] . "</td>";
                    echo "<td>" . $row["requested_time"] . "</td>";
                    echo "<td>";
                    // Include request ID, service name, and email as URL parameters
                    echo "<a href='approve_request.php?request_id=" . $row["request_id"] . "&service_name=" . $row["service_name"] . "&tenant_email=" . $row["tenant_email"] . "' class='btn btn-approve'>Approve</a>";
                    echo "<a href='deny_request.php?tenant_email=" . $row["tenant_email"] . "' class='btn btn-deny'>Deny</button>";
                    echo "</td>";
                    echo "</tr>";
                    }
                        $index++;
                } 
                else {
                    echo "<tr><td colspan='5'>No service requests found</td></tr>";
                }
            ?>
        </table>
        
    </div>
</body>
</html>

    
    