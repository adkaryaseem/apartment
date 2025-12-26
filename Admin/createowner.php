<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/logo-no-bg.png" type="image/x-icon">
    <link rel="stylesheet" href="../style/style-create-owner.css">
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Create Owner</title>
</head>
<body>
    <?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

include('../auth.php');

include ('../config.php');

$conn = connect();

function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function sweetAlert($type, $title, $message, $redirect = null) {
    $redirectScript = $redirect 
        ? ".then(() => { window.location.href = '$redirect'; })" 
        : "";
    echo "
    <script>
        Swal.fire({
            icon: '$type',
            title: " . json_encode($title) . ",
            text: " . json_encode($message) . ",
            confirmButtonColor: '#2563eb'
        })$redirectScript;
    </script>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = sanitize_input($_POST["first_name"]);
    $last_name = sanitize_input($_POST["last_name"]);
    $email = sanitize_input($_POST["email"]);
    $username = sanitize_input($_POST["username"]);
    $password = $_POST["password"];
    $phone_number = sanitize_input($_POST["phone_number"]);
    $flat_id = sanitize_input($_POST["flat_id"]);
    // $admin_id = sanitize_input($_POST["admin_id"]);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO owner (first_name, last_name, email, username, password, phone_number,flat_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $first_name, $last_name, $email, $username, $hashed_password, $phone_number, $flat_id);


    try {

    /* ========= VALIDATION ERRORS ========= */
    if (empty($username)) {
        sweetAlert('warning', 'Validation Error', 'Username is required');
        exit;
    }

    if (empty($password)) {
        sweetAlert('warning', 'Validation Error', 'Password is required');
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        sweetAlert('warning', 'Invalid Email', 'Please enter a valid email address');
        exit;
    }

    /* ========= DATABASE INSERT ========= */
    $stmt->execute();

    /* ========= SUCCESS ========= */
    sweetAlert(
        'success',
        'Owner Created!',
        'New owner has been added successfully.',
        'createowners.php'   // redirect after success
    );

} catch (mysqli_sql_exception $e) {

    /* ========= DATABASE ERRORS ========= */
    switch ($e->getCode()) {

        case 1062: // Duplicate entry
            sweetAlert(
                'error',
                'Duplicate Entry',
                'Username or email already exists. Please use a different one.'
            );
            break;

        case 1452: // Foreign key constraint
            sweetAlert(
                'error',
                'Invalid Reference',
                'Selected flat does not exist.'
            );
            break;

        case 1048: // Column cannot be null
            sweetAlert(
                'error',
                'Missing Data',
                'Required fields cannot be empty.'
            );
            break;

        default: // Unknown DB error
            sweetAlert(
                'error',
                'Database Error',
                'Something went wrong. Please try again later.'
            );

            // Optional: log real error
            error_log($e->getMessage());
    }
} catch (Throwable $e) {

    /* ========= SYSTEM / PHP ERRORS ========= */
    sweetAlert(
        'error',
        'System Error',
        'Unexpected error occurred. Please contact administrator.'
    );

    error_log($e->getMessage());
}


    $stmt->close();
}

$admin_query = "SELECT admin_id, username FROM admin";
$admin_result = $conn->query($admin_query);

$conn->close();
?>

    <div class="container">
        <h2>Create Owner</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" required>
            <label for="flat_id">Flat Details:</label>
            <input type="text" id="flat_id" name="flat_id" required>
            <label for="admin_id">Admin ID:</label>
            <select id="admin_id" name="admin_id" required>
                <?php while ($row = $admin_result->fetch_assoc()) { ?>
                    <option value="<?= $row['admin_id'] ?>">
                        <?= $row['username'] ?>
                    </option>
                <?php } ?>
            </select>
            <div class="button">
                <input type="submit" value="Create Owner">
                <a href="./" class="back-button">Return Home</a>
            </div>
        </form>
    </div>
</body>
</html>
