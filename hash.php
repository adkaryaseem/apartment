<?php
$password = "12345"; // your admin password
$hash = password_hash($password, PASSWORD_DEFAULT);
echo $hash;
?>