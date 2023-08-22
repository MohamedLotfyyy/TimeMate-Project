<?php

@include 'db.php';
@include "errors.php";

$db = new Database();

session_start();

if ($db->logged_in_user() != null) {
    header("location:index.php");
    exit();
}

if (isset($_POST['submit'])) {
    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";

    if ($username != "" && $password != "" && $db->is_correct_password($username, $password)) {
        $_SESSION['username'] = $username;
        header('location:index.php');
    } else {
        send_error("login.php", "Incorrect username or password");
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <ul>
        <li style="margin-left: 3%; font-size: 30px; font-family: 'Yeseva One'"><a href="homepage.html">TimeMate</a>
        </li>
        <li style="margin-top: 8px; font-size: 14px; font-family: 'TT Octosquares Trl', sans-serif;font-weight: 300;"><a
                href="homepage.html">HOME</a></li>
        <li style="margin-top: 8px; font-size: 14px; font-family: 'TT Octosquares Trl', sans-serif;font-weight: 300;"><a
                href="about.html">ABOUT</a></li>
        <li style="margin-top: 8px; font-size: 14px; font-family: 'TT Octosquares Trl', sans-serif;font-weight: 300;"><a
                href="faqs.html">FAQs</a></li>
        <li
            style="margin-top: 8px; float:right ; margin-right: 3%; font-size: 14px; font-family: 'TT Octosquares Trl', sans-serif;font-weight: 300;">
            <a class="active" href="login.php">LOGIN</a>
        </li>
    </ul>
    <div class="login_container">
        <div class="login_timetable">
            <h2>TimeMate</h2></br>
            <p class="moto">Never show up unprepared again!</p>
            <img src="ttimg.png" alt="Italian Trulli" style="width:300px;height:250px;margin-left:50px;margin-top:15px;">
        </div>
        <div class="login_form">
            <form action="login.php" class="login_forum" method="POST">
                <h1 class="login_header">Login</h1>
                <label id="error"></label>
                <input type="text" class="login_username" name="username" placeholder="username"></br>
                <input type="password" class="login_password" name="password" placeholder="password"></br>
                <input type="submit" class="login_submit" name="submit" value="login"></br>
                <p class="register_login">New to TimeMate? <a href="register.php">sign up</a></p>
            </form>
        </div>

    </div>

    <script>
        const params = new URLSearchParams(location.search);
        const error = params.get("error");

        if (error && error.length > 0) {
            document.getElementById("error").innerText = error;
        }
    </script>
</body>

</html>