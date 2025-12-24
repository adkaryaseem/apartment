<?php
// Start session and clear any previous login
session_start();
session_unset();
session_destroy();
session_start();

// Handle POST form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userType = $_POST['userType'] ?? '';

    $routes = [
        'admin' => 'admin/admin_login.php',
        'owner' => 'owner/owner_login.php',
        'employee' => 'employee/employeelogin.php',
        'tenant' => 'tenant/tenant_login.php'
    ];

    if (isset($routes[$userType])) {
        header("Location: " . $routes[$userType]);
        exit;
    } else {
        header("Location: login.php");
        $error = "Please select a user type";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--=============== REMIXICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="./style/style-login.css" />
    <!-- ============BROWSE ICON -->
        <link rel="shortcut icon" href="./images/logo-no-bg.png" type="image/x-icon">
    <title>Login</title>
  </head>
<body>
<div class="login">
    <div class="login__content">
        <img class="login__img" src="./images/logo-no-bg.png" alt="Login image">
        <form class="login__form" method="POST">
                <div>
                    <h1 class="login__title"><span>Welcome</span> Back User</h1>
                    <p class="login__description">Welcome! Please select user type to continue.</p>
                </div>
            <div>
                    <div class="login__inputs">
                        <div>
                            <label for="userType" class="login__label">Select User Type</label>
                            <select id="userType" name="userType" class="login__input" required>
                                <option value="">Select User Type</option>
                                <option value="admin">Admin</option>
                                <option value="owner">Owner</option>
                                <option value="employee">Employee</option>
                                <option value="tenant">Tenant</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="login__buttons">
                        <button type="submit" class="login__button" id="continueBtn" disabled>Continue</button>
                    </div>
                </div>

            <div class="login__error"><?php echo $error ?? ''; ?></div>
        </form>
    </div>
</div>
<script src="./script/login-script.js"></script>
</body>
</html>