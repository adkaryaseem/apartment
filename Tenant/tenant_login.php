<?php
// Start the session
session_start();

include ('../config.php');

$conn = connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT owner_id FROM owner WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION["owner_id"] = $row["owner_id"]; // Set owner_id in session
        header("Location: tenant_dashboard.php");
        exit();
    } else {
        $errorMessage = "Invalid username or password";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css" integrity="sha512-kJlvECunwXftkPwyvHbclArO8wszgBGisiLeuDFwNM8ws+wKIw0sv1os3ClWZOcrEB2eRXULYUsm8OVRGJKwGA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="../images/logo-no-bg.png" type="image/x-icon">
    <link rel="stylesheet" href="../style/style-tenant-login.css">
    <title>Tenant Login</title>
    
</head>
<body>
    <div class="container">
        <div class="login">
            <div class="login__content">
                <img class="login__img" src="../images/logo-no-bg.png" alt="Login image" />

                <form id="loginForm" method="POST" class="login__form">
                    <div>
                        <h1 class="login__title">
                            <span>Welcome</span> Back Tanent
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

    <!--=============== MAIN JS ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css" integrity="sha512-kJlvECunwXftkPwyvHbclArO8wszgBGisiLeuDFwNM8ws+wKIw0sv1os3ClWZOcrEB2eRXULYUsm8OVRGJKwGA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</body>
</html>
