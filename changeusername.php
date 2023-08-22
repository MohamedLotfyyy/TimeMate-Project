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

$new_username = $_POST["new_username"];

if (strlen($new_username) < 3 || !ctype_alnum($new_username)) {
    send_error("settings.html", "Invalid username. Username must be alphanumeric and at least 3 characters");
    return;
}

$stmt = $db->conn->prepare('SELECT 1 FROM accounts WHERE username=?');
$stmt->bind_param('s', $new_username);
$stmt->execute();

if ($stmt->get_result()->fetch_row()) {
    send_error("settings.html", "Username already in use");
    return;
}

$stmt = $db->conn->prepare('UPDATE accounts SET username = ? WHERE username = ?');
$stmt->bind_param('ss', $new_username, $username);

if ($stmt->execute()) {
    $_SESSION["username"] = $new_username;
    header("location:settings.html");
} else {
    send_error("settings.html", "unknown error");
}

?>