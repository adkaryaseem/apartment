<?php
// Start the session
session_start();

include_once ('../config.php');

$conn = connect();

$errorMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT employee_id, password FROM employee WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            // Set session
            $_SESSION['employee_id'] = $row['employee_id'];
            header("Location: ./");
            exit();
        } else {
            $errorMessage = "Invalid username or password";
        }
    }
    else {
        $errorMessage = "Invalid username or password";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css" integrity="sha512-kJlvECunwXftkPwyvHbclArO8wszgBGisiLeuDFwNM8ws+wKIw0sv1os3ClWZOcrEB2eRXULYUsm8OVRGJKwGA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style/style-employee-login.css">
    <link rel="shortcut icon" href="../images/logo-no-bg.png" type="image/x-icon">
    <title>Employee Login</title>
</head>
<body>
    <div class="container">
        <div class="login">
            <div class="login__content">
                <img class="login__img" src="../images/logo-no-bg.png" alt="Login image" />

                <form id="loginForm" method="POST" class="login__form">
                    <div>
                        <h1 class="login__title">
                            <span>Welcome</span> Back Employee
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
       <script src="../script/password-show-script.js"></script>

</body>
</html>
