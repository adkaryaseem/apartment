<?php
/* Session security settings — BEFORE session_start */
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_httponly', 1);
// ini_set('session.cookie_secure', 1); // enable if HTTPS

session_start();

$timeout = 600; // 10 minutes

$role = null;
$loginPage = '../';

/* Detect role */
if (isset($_SESSION['admin_id'])) {
    $role = 'admin';
    $loginPage = '../admin/admin_login.php';
}
elseif (isset($_SESSION['owner_id'])) {
    $role = 'owner';
    $loginPage = '../owner/owner_login.php';
}
elseif (isset($_SESSION['employee_id'])) {
    $role = 'employee';
    $loginPage = '../employee/employeelogin.php';
}
elseif (isset($_SESSION['tenant_id'])) {
    $role = 'tenant';
    $loginPage = '../tenant/tenant_login.php';
}

/* Not logged in */
if ($role === null) {
    header("Location: ../");
    exit;
}

/* Session timeout */
if (isset($_SESSION['LAST_ACTIVITY']) &&
    (time() - $_SESSION['LAST_ACTIVITY']) > $timeout) {

    session_unset();
    session_destroy();
    header("Location: $loginPage");
    exit;
}

$_SESSION['LAST_ACTIVITY'] = time();

/* Prevent cache */
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
