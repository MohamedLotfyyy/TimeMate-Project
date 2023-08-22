<?php

@include "db.php";

session_start();

$db = new Database();
$username = $db->logged_in_user();

if ($username == null) {
    http_response_code(403);
    exit();
}

$settings = file_get_contents("php://input");

// TODO: validation

$db->save_settings($username, $settings);

?>