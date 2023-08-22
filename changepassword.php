<?php

@include "db.php";
@include "errors.php";

session_start();

$db = new Database();
$username = $db->logged_in_user();

if ($username == null) {
    http_response_code(403);
    exit();
}

$new_password = $_POST["new_password"];

if (strlen($new_password) < 8) {
    send_error("settings.html", "Invalid password. Password must be at least 8 characters");
    return;
}

$hash = password_hash($new_password, PASSWORD_DEFAULT);

$stmt = $db->conn->prepare('UPDATE accounts SET password = ? WHERE username = ?');
$stmt->bind_param('ss', $hash, $username);

if (!$stmt->execute()) {
    send_error("settings.html", "unknown error");
} else {
    header("location:settings.html");
}

?>