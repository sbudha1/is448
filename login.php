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
	<h1>Welcome to AAAS!</h1>
	<?php
	$db = mysqli_connect("studentdb-maria.gl.umbc.edu", "mchen4", "mchen4", "mchen4"); 
	
	if ((isset($_POST['email'])) && (isset($_POST['password']))
	&& (!empty($_POST['email'])) && (!empty($_POST['password']))) 
{
      //html injections
	  $email = htmlspecialchars($_POST['email']);
	  $password = htmlspecialchars($_POST['password']);
      //sql injections
	  $email = mysqli_real_escape_string($db,$email);
	  $password = mysqli_real_escape_string($db,$password);


      $sql = "SELECT * FROM user_info WHERE email ='$email' AND pass_word ='$password'";
      $checker = mysqli_query($db, $sql);
		// Execute SQL query
		if (mysqli_num_rows($checker) > 0) {
			$_SESSION['logged_in'] = true;
			$_SESSION['username'] = $email;
			echo "You have successfully logged in!<br>";
		} else {
            echo "No user found for this login information.<br>";
            echo "Click ";
            echo '<a href="login1.html">here</a>';
            echo " to login again.";
		}  
	} 
	else {
	  echo "Please fill out all fields in the form.<br>";
	  echo "Click ";
	  echo '<a href="login1.html">here</a>';
	  echo " to login again.";
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