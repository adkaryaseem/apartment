<!-- phpo code starts here -->
<?php
session_start();
include ('../config.php');

$conn = connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $errorMessage = "Invalid username or password"; // Set error message if login fails
    }
}

$conn->close();
?>
<!-- php code ends here -->
<!-- Html Code start here -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="shortcut icon" href="../images/logo-no-bg.png" type="image/x-icon">
    <link rel="stylesheet" href="../style/style-admin-login.css">
</head>
<body>
    <div class="container">
        <div class="login">
            <div class="login__content">
                <img class="login__img" src="../images/logo-no-bg.png" alt="Login image" />

                <form id="loginForm" method="POST" class="login__form">
                    <div>
                        <h1 class="login__title">
                            <span>Welcome</span> Back Admin
                        </h1>

                        <p class="login__description">
                            Welcome! Please login to continue.
                        </p>
                    </div>

                    <div class="login__inputs">
                        <div>
                            <label for="username" class="login__label">Username:</label>
                            <input class="login__input" type="text" id="username" name="username" required>
                        </div>

                        <div>
                            <label for="password" class="login__label">Password:</label>
                            <div class="login__box">
                                <input class="login__input" type="password" id="password" name="password" required>
                                <i class="ri-eye-off-line login__eye" id="input-icon"></i>
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="login__button">Login</button>
                    </div>

                    <div id="errorContainer" class="login__error"><?php echo isset($errorMessage) ? $errorMessage : ''; ?></div>
                </form>
            </div>
        </div>
    </div>
    <script src="../script/admin-login-script.js"></script>
</body>
</html>
