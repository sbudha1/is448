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
    $name = $_POST['name'];

    $sql = "SELECT * FROM applications WHERE name='$name'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "taken";
    } else {
        echo "available";
    }
}

$conn->close();
?>