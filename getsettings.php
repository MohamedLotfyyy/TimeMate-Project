<?php

@include "db.php";

session_start();

$db = new Database();
$username = $db->logged_in_user();

if ($username == null) {
    http_response_code(403);
    exit();
}

echo $db->get_settings($username);

?>