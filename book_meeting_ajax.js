<?php
session_start();
//check for session status. redirect user to login page if they try to book an appointment slot without having logged in.
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo "Not logged in";
    exit();
}

$db = mysqli_connect("studentdb-maria.gl.umbc.edu", "sbudha1", "sbudha1", "sbudha1");
if (mysqli_connect_errno())
    echo "Error - could not connect to MySQL";

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

            // Insert the user's appointment into 'user_appointment' table
            $insertUserAppointmentQuery = "INSERT INTO user_appointment (user_id, appointment_id) VALUES ('$userId', '$appointmentId')";
            if (mysqli_query($db, $insertUserAppointmentQuery)) {
                echo "Appointment booked successfully!<br> See you soon, @ $selectedTime, $userEmail";
            } else {
                echo "Error booking appointment.<br> Try again";
            }
        } else {
            echo "Error booking appointment.<br> Try again";
        }
    } else {
        echo "The selected time slot has been booked.<br>Back to meetings page.";
    }
} else {
    echo "You did not select a time.<br> Please go back to choose a slot.";
}
?>