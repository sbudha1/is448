<!DOCTYPE html>
<!--
    Author: Zeeshan Hussain
    Use case: Submit Application Form
-->
<html lang="en">

<head>
    <title>All Animals Adoption Service - Application Submitted</title>
    <link href="aaas.css" type="text/css" rel="stylesheet">
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
        <?php
        session_start(); // Start the session
        
        $servername = "studentdb-maria.gl.umbc.edu";
        $username = "zhussai1";
        $password = "zhussai1";
        $dbname = "zhussai1";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($_POST['name']) && !empty($_POST['date']) && !empty($_POST['address']) && isset($_POST['age']) && isset($_POST['student']) && isset($_POST['pet-type']) && isset($_POST['color']) && isset($_POST['size']) && isset($_POST['responsible']) && isset($_POST['other-pets']) && isset($_POST['rent-own']) && isset($_POST['pets-allowed']) && isset($_POST['outdoors']) && isset($_POST['home-day'])) {
                $email = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true ? $_SESSION['username'] : $_POST['name'];
                $name = $_POST['name'];
                $date = $_POST['date'];
                $address = $_POST['address'];
                $age = $_POST['age'];
                $student = $_POST['student'];
                $petType = $_POST['pet-type'];
                $color = $_POST['color'];
                $size = $_POST['size'];
                $responsible = $_POST['responsible'];
                $otherPets = $_POST['other-pets'];
                $rentOwn = $_POST['rent-own'];
                $petsAllowed = $_POST['pets-allowed'];
                $outdoors = $_POST['outdoors'];
                $homeDay = $_POST['home-day'];

                if ($homeDay === 'yes') {
                    $unattendedHours = 'NULL';
                } else {
                    $unattendedHours = isset($_POST['unattended-hours']) ? $_POST['unattended-hours'] : 'NULL';
                }

                $sql = "INSERT INTO applications (name, date, address, age, student, pet_type, color, size, responsible, other_pets, rent_own, pets_allowed, outdoors, home_day, unattended_hours) VALUES ('$name', '$date', '$address', '$age', '$student', '$petType', '$color', '$size', '$responsible', '$otherPets', '$rentOwn', '$petsAllowed', '$outdoors', '$homeDay', $unattendedHours)";

                if ($conn->query($sql) === TRUE) {
                    echo "<h1>Application Submitted Successfully</h1>";
                    echo "<p>Thank you, $name ($email), for submitting your application!</p>";
                    echo "<p>We will review your application and get back to you soon.</p>";
                } else {
                    echo "<h2>Error</h2>";
                    echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
                }
            } else {
                header("Location: aaas_application.html");
                exit;
            }
        }

        $conn->close();
        ?>

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