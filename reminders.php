// Define the sendEmailReminders function to retrieve data from the database and send email reminders
<?php function sendEmailReminders() {
    // connect to the database
    $DATABASE_HOST = 'dbhost.cs.man.ac.uk';
    $DATABASE_USER = 'v74779hb';
    $DATABASE_PASS = 'GloriousCh33se';
    $DATABASE_NAME = '2022_comp10120_y4';


    // Connect to the group database
    $conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // retrieve data
    $sql = "SELECT * FROM tasks WHERE deadline < DATE_ADD(NOW(), INTERVAL 1 DAY)";
    $result = $conn->query($sql);

    // check if reminder is required and send email
    while ($row = $result->fetch_assoc()) {
        $deadline = new DateTime($row['deadline']);
        $now = new DateTime();
        $diff = $deadline->diff($now);
        if ($diff->h <= 24) { // reminder needed
            $to = $row['email'];
            $subject = "Reminder: Task due soon";
            $message = "Dear " . $row['name'] . ",\n\nThis is a reminder that your task \"" . $row['task'] . "\" is due in " . $diff->h . " hours.\n\nBest regards,\nYour Task Manager";
            $headers = "From: Your Task Manager <taskmanager@example.com>\r\n";
            mail($to, $subject, $message, $headers);
        }
    }

    // close the database connection
    $conn->close();
}
?>

<script>
// Add an event listener to the toggle checkbox element so that when it is checked, the sendEmailReminders function is called
const toggleCheckbox = document.getElementById('c:checkinreminders');

toggleCheckbox.addEventListener('change', function() {
  if (this.checked) {
    sendEmailReminders();
  }
});

// Call the sendEmailReminders function on a schedule (e.g., every day at a certain time)
setInterval(sendEmailReminders, 24 * 60 * 60 * 1000); // This will call the function once per day

</script>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link href="settings.css" rel="stylesheet">
    <script src="countries.json"></script>
    <title>Settings</title>
  </head>
  <body>
    <ul>
      <li style="margin-left: 3%; font-size: 30px; font-family: 'Yeseva One'"><a href="index.php">TimeMate</a></li>
      <li style="margin-top: 8px; font-size: 14px; font-family: 'TT Octosquares Trl', sans-serif;font-weight: 300;"><a href="index.php">HOME</a></li>
      <li style="margin-top: 8px; font-size: 14px; font-family: 'TT Octosquares Trl', sans-serif;font-weight: 300;"><a href="timetable2.php">TIMETABLE</a></li>
      <li style="margin-top: 8px; font-size: 14px; font-family: 'TT Octosquares Trl', sans-serif;font-weight: 300;"><a href="TDL.html">TO-DO'S</a></li>
      <li style="margin-top: 8px; font-size: 14px; font-family: 'TT Octosquares Trl', sans-serif;font-weight: 300;"><a href="settings.html">SETTINGS</a></li>
      <li style="margin-top: 8px; float:right ; margin-right: 3%; font-size: 14px; font-family: 'TT Octosquares Trl', sans-serif;font-weight: 300;"><a class="active" href="logout.php">LOG OUT</a></li>
    </ul>
    <h1>Settings</h1>
    <button style="position: absolute; top: 95px; right:50px;" id="saveButton">Save Changes</button>
    <div class = "joint">
      <div class="account">
        <h2>Personal Information</h2>
        <input type="text" name="username" placeholder="new username" id="username" required>
        <br>
        <br>
        <button>Change Username</button>
        <br>
        <br>
        <div class="timezones">
          <select id="timezone">
            <option data-time-zone-id="1" data-gmt-adjustment="GMT-12:00" data-use-daylight="0" value="-12">(GMT-12:00) International Date Line West</option>
            <option data-time-zone-id="2" data-gmt-adjustment="GMT-11:00" data-use-daylight="0" value="-11">(GMT-11:00) Midway Island, Samoa</option>
            <option data-time-zone-id="3" data-gmt-adjustment="GMT-10:00" data-use-daylight="0" value="-10">(GMT-10:00) Hawaii</option>
            <option data-time-zone-id="4" data-gmt-adjustment="GMT-09:00" data-use-daylight="1" value="-9">(GMT-09:00) Alaska</option>
            <option data-time-zone-id="5" data-gmt-adjustment="GMT-08:00" data-use-daylight="1" value="-8">(GMT-08:00) Pacific Time (US & Canada)</option>
            <option data-time-zone-id="6" data-gmt-adjustment="GMT-08:00" data-use-daylight="1" value="-8">(GMT-08:00) Tijuana, Baja California</option>
            <option data-time-zone-id="7" data-gmt-adjustment="GMT-07:00" data-use-daylight="0" value="-7">(GMT-07:00) Arizona</option>
            <option data-time-zone-id="8" data-gmt-adjustment="GMT-07:00" data-use-daylight="1" value="-7">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
            <option data-time-zone-id="9" data-gmt-adjustment="GMT-07:00" data-use-daylight="1" value="-7">(GMT-07:00) Mountain Time (US & Canada)</option>
            <option data-time-zone-id="10" data-gmt-adjustment="GMT-06:00" data-use-daylight="0" value="-6">(GMT-06:00) Central America</option>
            <option data-time-zone-id="11" data-gmt-adjustment="GMT-06:00" data-use-daylight="1" value="-6">(GMT-06:00) Central Time (US & Canada)</option>
            <option data-time-zone-id="12" data-gmt-adjustment="GMT-06:00" data-use-daylight="1" value="-6">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
            <option data-time-zone-id="13" data-gmt-adjustment="GMT-06:00" data-use-daylight="0" value="-6">(GMT-06:00) Saskatchewan</option>
            <option data-time-zone-id="14" data-gmt-adjustment="GMT-05:00" data-use-daylight="0" value="-5">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
            <option data-time-zone-id="15" data-gmt-adjustment="GMT-05:00" data-use-daylight="1" value="-5">(GMT-05:00) Eastern Time (US & Canada)</option>
            <option data-time-zone-id="16" data-gmt-adjustment="GMT-05:00" data-use-daylight="1" value="-5">(GMT-05:00) Indiana (East)</option>
            <option data-time-zone-id="17" data-gmt-adjustment="GMT-04:00" data-use-daylight="1" value="-4">(GMT-04:00) Atlantic Time (Canada)</option>
            <option data-time-zone-id="18" data-gmt-adjustment="GMT-04:00" data-use-daylight="0" value="-4">(GMT-04:00) Caracas, La Paz</option>
            <option data-time-zone-id="19" data-gmt-adjustment="GMT-04:00" data-use-daylight="0" value="-4">(GMT-04:00) Manaus</option>
            <option data-time-zone-id="20" data-gmt-adjustment="GMT-04:00" data-use-daylight="1" value="-4">(GMT-04:00) Santiago</option>
            <option data-time-zone-id="21" data-gmt-adjustment="GMT-03:30" data-use-daylight="1" value="-3.5">(GMT-03:30) Newfoundland</option>
            <option data-time-zone-id="22" data-gmt-adjustment="GMT-03:00" data-use-daylight="1" value="-3">(GMT-03:00) Brasilia</option>
            <option data-time-zone-id="23" data-gmt-adjustment="GMT-03:00" data-use-daylight="0" value="-3">(GMT-03:00) Buenos Aires, Georgetown</option>
            <option data-time-zone-id="24" data-gmt-adjustment="GMT-03:00" data-use-daylight="1" value="-3">(GMT-03:00) Greenland</option>
            <option data-time-zone-id="25" data-gmt-adjustment="GMT-03:00" data-use-daylight="1" value="-3">(GMT-03:00) Montevideo</option>
            <option data-time-zone-id="26" data-gmt-adjustment="GMT-02:00" data-use-daylight="1" value="-2">(GMT-02:00) Mid-Atlantic</option>
            <option data-time-zone-id="27" data-gmt-adjustment="GMT-01:00" data-use-daylight="0" value="-1">(GMT-01:00) Cape Verde Is.</option>
            <option data-time-zone-id="28" data-gmt-adjustment="GMT-01:00" data-use-daylight="1" value="-1">(GMT-01:00) Azores</option>
            <option data-time-zone-id="29" data-gmt-adjustment="GMT+00:00" data-use-daylight="0" value="0">(GMT+00:00) Casablanca, Monrovia, Reykjavik</option>
            <option data-time-zone-id="30" data-gmt-adjustment="GMT+00:00" data-use-daylight="1" value="0">(GMT+00:00) Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London</option>
            <option data-time-zone-id="31" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
            <option data-time-zone-id="32" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
            <option data-time-zone-id="33" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
            <option data-time-zone-id="34" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb</option>
            <option data-time-zone-id="35" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) West Central Africa</option>
            <option data-time-zone-id="36" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Amman</option>
            <option data-time-zone-id="37" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Athens, Bucharest, Istanbul</option>
            <option data-time-zone-id="38" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Beirut</option>
            <option data-time-zone-id="39" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Cairo</option>
            <option data-time-zone-id="40" data-gmt-adjustment="GMT+02:00" data-use-daylight="0" value="2">(GMT+02:00) Harare, Pretoria</option>
            <option data-time-zone-id="41" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius</option>
            <option data-time-zone-id="42" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Jerusalem</option>
            <option data-time-zone-id="43" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Minsk</option>
            <option data-time-zone-id="44" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Windhoek</option>
            <option data-time-zone-id="45" data-gmt-adjustment="GMT+03:00" data-use-daylight="0" value="3">(GMT+03:00) Kuwait, Riyadh, Baghdad</option>
            <option data-time-zone-id="46" data-gmt-adjustment="GMT+03:00" data-use-daylight="1" value="3">(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
            <option data-time-zone-id="47" data-gmt-adjustment="GMT+03:00" data-use-daylight="0" value="3">(GMT+03:00) Nairobi</option>
            <option data-time-zone-id="48" data-gmt-adjustment="GMT+03:00" data-use-daylight="0" value="3">(GMT+03:00) Tbilisi</option>
            <option data-time-zone-id="49" data-gmt-adjustment="GMT+03:30" data-use-daylight="1" value="3.5">(GMT+03:30) Tehran</option>
            <option data-time-zone-id="50" data-gmt-adjustment="GMT+04:00" data-use-daylight="0" value="4">(GMT+04:00) Abu Dhabi, Muscat</option>
            <option data-time-zone-id="51" data-gmt-adjustment="GMT+04:00" data-use-daylight="1" value="4">(GMT+04:00) Baku</option>
            <option data-time-zone-id="52" data-gmt-adjustment="GMT+04:00" data-use-daylight="1" value="4">(GMT+04:00) Yerevan</option>
            <option data-time-zone-id="53" data-gmt-adjustment="GMT+04:30" data-use-daylight="0" value="4.5">(GMT+04:30) Kabul</option>
            <option data-time-zone-id="54" data-gmt-adjustment="GMT+05:00" data-use-daylight="1" value="5">(GMT+05:00) Yekaterinburg</option>
            <option data-time-zone-id="55" data-gmt-adjustment="GMT+05:00" data-use-daylight="0" value="5">(GMT+05:00) Islamabad, Karachi, Tashkent</option>
            <option data-time-zone-id="56" data-gmt-adjustment="GMT+05:30" data-use-daylight="0" value="5.5">(GMT+05:30) Sri Jayawardenapura</option>
            <option data-time-zone-id="57" data-gmt-adjustment="GMT+05:30" data-use-daylight="0" value="5.5">(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
            <option data-time-zone-id="58" data-gmt-adjustment="GMT+05:45" data-use-daylight="0" value="5.75">(GMT+05:45) Kathmandu</option>
            <option data-time-zone-id="59" data-gmt-adjustment="GMT+06:00" data-use-daylight="1" value="6">(GMT+06:00) Almaty, Novosibirsk</option>
            <option data-time-zone-id="60" data-gmt-adjustment="GMT+06:00" data-use-daylight="0" value="6">(GMT+06:00) Astana, Dhaka</option>
            <option data-time-zone-id="61" data-gmt-adjustment="GMT+06:30" data-use-daylight="0" value="6.5">(GMT+06:30) Yangon (Rangoon)</option>
            <option data-time-zone-id="62" data-gmt-adjustment="GMT+07:00" data-use-daylight="0" value="7">(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
            <option data-time-zone-id="63" data-gmt-adjustment="GMT+07:00" data-use-daylight="1" value="7">(GMT+07:00) Krasnoyarsk</option>
            <option data-time-zone-id="64" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
            <option data-time-zone-id="65" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Kuala Lumpur, Singapore</option>
            <option data-time-zone-id="66" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Irkutsk, Ulaan Bataar</option>
            <option data-time-zone-id="67" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Perth</option>
            <option data-time-zone-id="68" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Taipei</option>
            <option data-time-zone-id="69" data-gmt-adjustment="GMT+09:00" data-use-daylight="0" value="9">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
            <option data-time-zone-id="70" data-gmt-adjustment="GMT+09:00" data-use-daylight="0" value="9">(GMT+09:00) Seoul</option>
            <option data-time-zone-id="71" data-gmt-adjustment="GMT+09:00" data-use-daylight="1" value="9">(GMT+09:00) Yakutsk</option>
            <option data-time-zone-id="72" data-gmt-adjustment="GMT+09:30" data-use-daylight="0" value="9.5">(GMT+09:30) Adelaide</option>
            <option data-time-zone-id="73" data-gmt-adjustment="GMT+09:30" data-use-daylight="0" value="9.5">(GMT+09:30) Darwin</option>
            <option data-time-zone-id="74" data-gmt-adjustment="GMT+10:00" data-use-daylight="0" value="10">(GMT+10:00) Brisbane</option>
            <option data-time-zone-id="75" data-gmt-adjustment="GMT+10:00" data-use-daylight="1" value="10">(GMT+10:00) Canberra, Melbourne, Sydney</option>
            <option data-time-zone-id="76" data-gmt-adjustment="GMT+10:00" data-use-daylight="1" value="10">(GMT+10:00) Hobart</option>
            <option data-time-zone-id="77" data-gmt-adjustment="GMT+10:00" data-use-daylight="0" value="10">(GMT+10:00) Guam, Port Moresby</option>
            <option data-time-zone-id="78" data-gmt-adjustment="GMT+10:00" data-use-daylight="1" value="10">(GMT+10:00) Vladivostok</option>
            <option data-time-zone-id="79" data-gmt-adjustment="GMT+11:00" data-use-daylight="1" value="11">(GMT+11:00) Magadan, Solomon Is., New Caledonia</option>
            <option data-time-zone-id="80" data-gmt-adjustment="GMT+12:00" data-use-daylight="1" value="12">(GMT+12:00) Auckland, Wellington</option>
            <option data-time-zone-id="81" data-gmt-adjustment="GMT+12:00" data-use-daylight="0" value="12">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
            <option data-time-zone-id="82" data-gmt-adjustment="GMT+13:00" data-use-daylight="0" value="13">(GMT+13:00) Nuku'alofa</option>
          </select>
        </div>
        <br>
        <h2>Notifications</h2>
        <p style="float: left;">Check-in Reminders</p>
        <div class="toggleWrapper">
          <input type="checkbox" name="toggle1" class="toggle" id="c:checkinreminders" checked>
          <label for="toggle1"></label>
        </div>
        <p style="float: left;">Deadlines</p>
        <div class="toggleWrapper">
          <input type="checkbox" name="toggle2" class="toggle" id="c:deadlines" checked>
          <label for="toggle2"></label>
        </div>
        <p style="float: left;">Personal Events</p>
        <div class="toggleWrapper">
          <input type="checkbox" name="toggle3" class="toggle" id="c:personalevents" checked>
          <label for="toggle3"></label>
        </div>
        <br>
      </div>
      <div class="security">
        <h2 style="color: rgb(255, 255, 233);">Privacy & Security</h2>
        <label class="container" style="color: rgb(255, 255, 233);"> Run security checks upon login
          <input type="checkbox" checked="checked" style="width: 18px;" id="c:securitychecks">
          <span class="checkmark"></span>
        </label>
        <br>
        <label class="container" style="color: rgb(255, 255, 233);"> Password reset every month
          <input type="checkbox" checked="checked" style="width: 18px;" id="c:resetmonthly">
          <span class="checkmark"></span>
        </label>
        <br>
        <label class="container" style="color: rgb(255, 255, 233)"> Enable location services 
          <input type="checkbox" checked="checked" style="width: 18px;" id="c:locationservices">
          <span class="checkmark"></span>
        </label>
        <br>
        <label class="container" style="color: rgb(255, 255, 233);"> Allow importing timetable
          <input type="checkbox" checked="checked" style="width: 18px;" id="c:allowimporting">
          <span class="checkmark"></span>
        </label>
        <br>
        <h2 style="color: rgb(255, 255, 233);">Password</h2>
        <input type="text" name="password" placeholder="new password" id="password" required>
        <br><br>
        <button>Change Password</button>
      </div>
      <div class="display">
        <h2>Screen Preference</h2>
        <label class="container"> Light Mode
          <input type="radio" checked="checked" name="radio" id="c:lightmode">
          <span class="checkmark"></span>
        </label>
        <br>
        <label class="container"> Dark Mode
          <input type="radio" checked="checked" name="radio" id="c:darkmode">
          <span class="checkmark"></span>
        </label>
        <br>
        <h2>Account Options</h2>
        <a href="deleteaccount.php"><button>Delete Account</button></a>
    </div>
  </div>

  <script src="settings.js"></script>
</body>
</html>