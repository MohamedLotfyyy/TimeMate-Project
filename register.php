<?php

@include 'db.php';
@include 'errors.php';

session_start();

$db = new Database();

if (isset($_POST['submit'])) {

    $username = $_POST["username"] ?? "";
    $email = $_POST["email"] ?? "";
    $password = $_POST['password'] ?? "";

    // Validation

    if (strlen($password) < 8) {
        send_error("register.php", "Invalid password. Password must be at least 8 characters");
        return;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        send_error("register.php", "Invalid email");
        return;
    }

    if (strlen($username) < 3 || !ctype_alnum($username)) {
        send_error("register.php", "Invalid username. Username must be alphanumeric and at least 3 characters");
        return;
    }


    if ($db->user_exists($username, $email)) {
        send_error("register.php", "Username/email already in use");
        return;
    }

    $db->create_account($username, $email, $password);

    header('location:login.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Register</title>
    <link rel="stylesheet" href="register.css">
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
                href="#faqs.html">FAQs</a></li>
        <li
            style="margin-top: 8px; float:right ; margin-right: 3%; font-size: 14px; font-family: 'TT Octosquares Trl', sans-serif;font-weight: 300;">
            <a class="active" href="login.php">LOGIN</a>
        </li>
    </ul>
    <h1>Register</h1>
    <div class="joint">
        <div class="timetable">
            <h2>TimeMate</h2>
            <p class="moto">Never show up unprepared again!</p>
            <img src="ttimg.png" alt="Italian Trulli" style="width:300px;height:250px;margin-left:0px;margin-top:15px;">
        </div>
        <div class="register">
            <form action="register.php" method="post" autocomplete="off">
                <label id="error"></label>
                <label for="username">
                    <i class="fas fa-user"></i>
                </label>
                <input type="text" name="username" placeholder="Username" id="username" required>
                <br>
                <br>
                <label for="password">
                    <i class="fas fa-lock"></i>
                </label>
                <input type="password" name="password" placeholder="Password" id="password" required>
                <br>
                <br>
                <label for="email">
                    <i class="fas fa-envelope"></i>
                </label>
                <input type="email" name="email" placeholder="Email" id="email" required>
                <br>
                <br>
                <input type="submit" name="submit" value="Register">
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