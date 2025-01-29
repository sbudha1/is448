<?php
session_start();
?>
<!DOCTYPE html>
<!-- 
	Author: Mandy Chen
	Use case: Login Use Case
-->
<html lang="EN">
<head> 
	<title>All Animals Adoption Service</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link href="aaas.css" type="text/css" rel="stylesheet">
	<style>

		.content {
			text-align: center;
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
	<?php
	$db = mysqli_connect("studentdb-maria.gl.umbc.edu", "mchen4", "mchen4", "mchen4"); 
	
	if ((isset($_POST['firstname'])) && (isset($_POST['lastname'])) && (isset($_POST['email'])) && (isset($_POST['phone'])) && (isset($_POST['password'])) 
	&& (!empty($_POST['firstname'])) && (!empty($_POST['lastname'])) && (!empty($_POST['email'])) && (!empty($_POST['phone'])) && (!empty($_POST['password']))) 
{
      //html injections
	  $firstname = htmlspecialchars($_POST['firstname']);
	  $lastname = htmlspecialchars($_POST['lastname']);
	  $email = htmlspecialchars($_POST['email']);
	  $phone = htmlspecialchars($_POST['phone']);
	  $password = htmlspecialchars($_POST['password']);
      //sql injections
      $firstname = mysqli_real_escape_string($db,$firstname);
	  $lastname = mysqli_real_escape_string($db,$lastname);
	  $email = mysqli_real_escape_string($db,$email);
	  $phone = mysqli_real_escape_string($db,$phone);
	  $password = mysqli_real_escape_string($db,$password);


		$sql = "INSERT INTO user_info (email,first_name,last_name,phone,pass_word) VALUES ('$email','$firstname','$lastname','$phone','$password');";
	
		// Execute SQL query
		if (mysqli_query($db, $sql)) {
			echo "You have successfully registered your account!<br>";
            echo "Click ";
            echo '<a href="login1.html">here</a>';
            echo " to login.";
		} else {
			echo "Your information did not register.";
            echo "Error: " . $sql . "<br>" . mysqli_error($db);
		}
	  
	} 
	?>
</div>
<div class="foot">
	<br>
	<p>
		<a href="index.html">About us</a>&emsp;
		<a href="index.html">Home</a>&emsp;
		<a href="index.html">Contact Us</a>&emsp;
	</p>
</div>

</body>
</html>