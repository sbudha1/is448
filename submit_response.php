<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
   echo "You must be logged in to submit feedback.";
    exit();
}

$db = mysqli_connect("studentdb-maria.gl.umbc.edu", "danielb8", "danielb8", "danielb8");
if (!$db) {
    echo "Error - could not connect to MySQL";
    exit();
}

if (!empty($_POST['age_group']) && !empty($_POST['gender']) && !empty($_POST['satisfactory']) && !empty($_POST['recommendation']) && !empty($_POST['recommendation_comment'])) {
    
    $ageGroup = htmlspecialchars(mysqli_real_escape_string($db, $_POST['age_group']));
    $gender = htmlspecialchars(mysqli_real_escape_string($db, $_POST['gender']));
    $satisfactory = htmlspecialchars(mysqli_real_escape_string($db, $_POST['satisfactory']));
    $recommendation = htmlspecialchars(mysqli_real_escape_string($db, $_POST['recommendation']));
    $experience = htmlspecialchars(mysqli_real_escape_string($db, $_POST['recommendation_comment']));

    $constructed_query = "INSERT INTO userFeedback (ageGroup, Gender, Satisfaction, Recommendation, Experience) 
                          VALUES ('$ageGroup', '$gender', '$satisfactory', '$recommendation', '$experience')";

    $result = mysqli_query($db, $constructed_query);
    if ($result) {
        echo "Thank you for your feedback, we will get back to you as soon as possible!";
    } else {
        echo "Error - query could not be executed: " . mysqli_error($db);
        error_log("MySQL error: " . mysqli_error($db)); // Log the error to a file for further analysis
    }

    mysqli_close($db);
} else {
    echo "Please fill out the form correctly.";
}
?>
