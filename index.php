<?php

@include "db.php";

session_start();

$db = new Database();
$username = $db->logged_in_user();

if ($username == null) {
    header("location:homepage.html");
    exit();
}


?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Register</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <ul>
        <li style="margin-left: 3%; font-size: 30px; font-family: 'Yeseva One';float: left;"><a href="index.php">TimeMate</a></li>
        <li style="margin-top: 8px; font-size: 14px; font-family: 'TT Octosquares Trl', sans-serif;font-weight: 300;float: left;"><a href="index.php">HOME</a></li>
        <li style="margin-top: 8px; font-size: 14px; font-family: 'TT Octosquares Trl', sans-serif;font-weight: 300;float: left;"><a href="timetable2.php">TIMETABLE</a></li>
        <li style="margin-top: 8px; font-size: 14px; font-family: 'TT Octosquares Trl', sans-serif;font-weight: 300;float: left;"><a href="TDL.html">TO-DO'S</a></li>
        <li style="margin-top: 8px; font-size: 14px; font-family: 'TT Octosquares Trl', sans-serif;font-weight: 300;float: left;"><a href="settings.html">SETTINGS</a></li>
        <li style="margin-top: 8px; float:right ; margin-right: 3%; font-size: 14px; font-family: 'TT Octosquares Trl', sans-serif;font-weight: 300;"><a class="active" href="logout.php">LOG OUT</a></li>
    </ul>  
    <h1>Hello, <?php echo $username; ?>!</h1>

    <h4>TIMETABLE</h4>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean suscipit magna et consequat tempor. Nunc ac augue et risus suscipit laoreet. </p>
    <h4>TO-DO'S</h4>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean suscipit magna et consequat tempor. </p> 
    <h4>SETTINGS</h4>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean suscipit magna et consequat tempor. Nunc ac augue et risus suscipit laoreet. </p>

</body>

</html>