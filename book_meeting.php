<?php
session_start();
//check for session status. redirect user to login page if they try to book an appointment slot without having logged in.
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login1.html");
    exit();
}

$db = mysqli_connect("studentdb-maria.gl.umbc.edu", "sbudha1", "sbudha1", "sbudha1");
if (mysqli_connect_errno())
		exit("Error - could not connect to MySQL");

$message = "";

if (isset($_POST['timing']) && !empty($_POST['timing'])) {
    $selectedTime = mysqli_real_escape_string($db, $_POST['timing']);
    $userEmail = $_SESSION['username'];
	

    // need to check if the selected slot is free
    $checkAvailabilityQuery = "SELECT * FROM appointment WHERE timing = '$selectedTime'";
    $result = mysqli_query($db, $checkAvailabilityQuery);

    if (mysqli_num_rows($result) == 0) {
        // free slot (not yet added into appointment table)
        $insertAppointmentQuery = "INSERT INTO appointment (timing) VALUES ('$selectedTime')";
        if (mysqli_query($db, $insertAppointmentQuery)) {
            // Retrieve the appointment ID for the newly inserted appointment
            $appointmentId = mysqli_insert_id($db);

            $userIdQuery = "SELECT * FROM user_info WHERE email = '$userEmail'";
            $userIdResult = mysqli_query($db, $userIdQuery);
            $row = mysqli_fetch_array($userIdResult);
            $userId = $row['user_id'];

            // Insert the user's appointment into 'user_appointment' table. this links the appointment timing to the specific user.
			// timings 11.15 and 10.30 have already been booked and inserted into table. appointment_id is 13 & 14 respectively. 

            $insertUserAppointmentQuery = "INSERT INTO user_appointment (user_id, appointment_id) VALUES ('$userId', '$appointmentId')";
            if (mysqli_query($db, $insertUserAppointmentQuery)) {
                $message = "Appointment booked successfully!<br> See you soon, @ $selectedTime, $userEmail";
            } else {
                $message = "Error booking appointment.<br> Try <a href=\"meeting.html\">again</a>";
            }
        } else {
            $message = "Error booking appointment.<br> Try <a href=\"meeting.html\">again</a>";
        }
    } else {
        $message = "The selected time slot has been booked.<br><a href=\"meeting.html\">Back</a> to meetings page."; 
    }
}else {
	$message = "You did not select a time.<br> Please go <a href=\"meeting.html\">back</a> to choose a slot."; 
}

/**
 * refer to database tables:
 * 
 * CREATE TABLE user_info (user_id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT, email VARCHAR (50) NOT NULL,
 *  first_name VARCHAR(30) NOT NULL, last_name VARCHAR (30) NOT NULL, phone VARCHAR(20) NOT NULL, password VARCHAR(30) NOT NULL);
 * 
 * CREATE TABLE appointment(appointment_id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT, timing TIMESTAMP NOT NULL);
 * 
 * *CREATE TABLE user_appointment(user_appt_id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT, user_id INT NOT NULL, 
*appointment_id INT NOT NULL, FOREIGN KEY(user_id) REFERENCES user_info(user_id), FOREIGN KEY(appointment_id) REFERENCES appointment(appointment_id));
**/
?>

<!DOCTYPE html>
<html lang = "EN">
<!-- 
	Author: Shanti Budha
	Booking of virtual appointment
-->
<head> 
	<title>All Animals Adoption Service </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link href="aaas.css" type="text/css" rel="stylesheet">
	
	<style>
		.boxleft{
			float: left;
			text-align: center;
			border: 2px black solid;
			padding:5px;
			margin-top: 90px;
			margin-left:150px;
		}
		
		.boxright{
			float:right;
			text-align: center;
			border: 2px black solid;
			padding:5px;
			margin-right:150px;
			margin-bottom:20px;
		}
		
		table{
			border-collapse: collapse;
			margin: 0 auto;
		}
		th,td{
			border: 1px black solid;
			text-align: center;
		}
		h2{
			text-align:center;
		
		}
	</style>
	
</head>
<body>
<div class="nav">

	<h3>
		<a href="index.html"><img src="aaas.png" alt="AAAS logo" /></a>&emsp;&emsp;
		<a href="login1.html">Login</a>&emsp;
		<a href="search.html">Search</a>&emsp;
		<a href="aaas_application.html">Apply</a>&emsp;
		<a href="meeting.html">Meet Us</a>&emsp;
		<a href="feedback.html">Feedback</a>
	</h3>
</div>

<div class="content">


<?php echo "$message"; ?>
	
	</div>
<div class="foot">

	<p>
		<a href="index.html">About us</a>&emsp;
		<a href="index.html">Home</a>&emsp;
		<a href="index.html">Contact Us</a>&emsp;
	</p>

</div>

</body>
</html>