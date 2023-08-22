<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    session_start();

    $username = $_SESSION['username'];

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
        // Prepare the SQL statement
        $stmt = $conn->prepare("SELECT task, deadline FROM TDL WHERE username = ?");

        // Bind the username parameter
        $stmt->bind_param("s", $username);

        // Execute the query
        $stmt->execute();

        // Retrieve the result set
        $result = $stmt->get_result();

        // Iterate through the result set and extract the deadlines
        $deadlines = [];
        while ($row = $result->fetch_assoc()) {
            $task = $row['task'];
            $deadline = $row['deadline'];
            $day = date('j', strtotime($deadline));
            $month = date('n', strtotime($deadline));
            $year = date('Y', strtotime($deadline));
            $deadlines["$year-$month-$day"][] = $task;
        }
        $dayDeadlines = [];
        foreach ($deadlines as $date => $tasks) {
            foreach ($tasks as $task) {
                $dayDeadlines[] = [
                    'Task' => $task,
                    'Deadline' => $date,
                ];
            }
        }
        $dayDeadlinesJson = json_encode($dayDeadlines);
        
        // header("location:TDL.html");
        $stmt->close();
    
    }

    $conn->close();


?>