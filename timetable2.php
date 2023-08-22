<?php 
@include 'TDL3.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<title>My Timetable</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href = "timetable2.css" rel="stylesheet" type="text/css">
<link rel="preconnect" href="https://fonts.googleapis.com">

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
  <div id="header-container">
    <h1 class="fade-in">My Timetable</h1>
    <div class = "legend" id = "legend">
      <h5 id = "dlegend" style="border-left: 5px solid rgb(198, 0, 66);">Deadlines</h5>
      <h5 id = "clegend" style="border-left: 5px solid rgb(107, 175, 167);">Classes</h5>
      <h5 id = "tlegend" style="border-left: 5px solid rgb(137, 162, 224); float: right; margin-top: -50px; margin-right: 30px;">To-Do Deadlines</h5>
    </div>
  </div>
      <div class="wrapper">
        <div class="c-calendar">
          <div class="c-calendar__style c-aside" id="c-aside">
            <div class="c-aside__day" id="c-aside__day"></div>
            <div class="c-aside__eventList" id="events"></div>
            <div class="c-aside__classList" id="classes"></div>
            <div class="c-aside__taskList" id="tasks"></div>
          </div>
          <div class="c-cal__container c-calendar__style">
            <div id="container">
                <div id="header">
                  <div>
                    <button id="backButton" class="backButton">&#10094;</button>
                    <div id="monthDisplay" class="monthDisplay"></div>
                    <button id="nextButton" class="nextButton">&#10095;</button>
                  </div>
                </div>
          
                <div id="weekdays">
                    <div class="cview__header">SUN</div>
                    <div class="cview__header">MON</div>
                    <div class="cview__header">TUE</div>
                    <div class="cview__header">WED</div>
                    <div class="cview__header">THU</div>
                    <div class="cview__header">FRI</div>
                    <div class="cview__header">SAT</div>
                </div>
          
                <div id="calendar"></div>
              </div>
          </div>
        </div>
      </div>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
      <script src="https://momentjs.com/downloads/moment-timezone-with-data.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
      <script>
        const dayDeadlines = <?php echo $dayDeadlinesJson; ?>;
    </script>
      <script src="timetable2.js"></script>

    </body>
</html>