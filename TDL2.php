<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    session_start();

    $username = $_SESSION['username'];
    $deadline = $_POST['deadline'];
    $nameOfTask = $_POST['nameOfTask'];

    // Load the configuration file containing your database credentials
    //require_once('config.inc.php'); 
    $DATABASE_HOST = 'dbhost.cs.man.ac.uk';
    $DATABASE_USER = 'v74779hb';
    $DATABASE_PASS = 'GloriousCh33se';
    $DATABASE_NAME = '2022_comp10120_y4';


    // Connect to the group database
    $conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

    // $conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $group_dbnames[0]);

    // Check for errors before doing anything else
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else{
        // $stmt  = $conn->prepare("INSERT INTO TDL(username, task, deadline) VALUES (username, task, do-by-date)");
        $stmt  = $conn->prepare("INSERT INTO TDL(username, task, deadline) VALUES (?,?, STR_TO_DATE(?, '%Y-%m-%d'))");
        $stmt -> bind_param("sss", $username, $nameOfTask, $deadline);
        $stmt -> execute();
        // $stmt->execute(['username' => $username, 'task' => $nameOfTask, deadline => $deadline]);
        header("location:TDL.html");
        
        echo "sucessfully added task and deadline";
        $stmt->close();
    
    }

    $conn->close();


?>


