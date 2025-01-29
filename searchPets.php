<!DOCTYPE html>
<!-- 
	Author: Katelyn Atkinson
	Use case: 2 animal search/filter
-->
<html lang="EN">
<head> 
	<title>All Animals Adoption Service</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link href="aaas.css" type="text/css" rel="stylesheet">
	<style>
		hr{
			height: 2px;
			color: #ad3c17;
			background-color: #ad3c17;
		}
		img.ani{
			width: 95%;
			height 95%;
		}
		td.ani{
			width: 26%;
			text-align: center;
			border: 2px solid;
			border-radius: 25px;
		}
		h2, h4{
			text-align: center;
		}
		h4{
			margin: 5px;
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
	session_start();
	if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true)
	{
		header("Location: login1.html");
		exit();
	}
	
	$db = mysqli_connect("studentdb-maria.gl.umbc.edu","atk1","atk1","atk1");

	if (mysqli_connect_errno())	exit("Error - could not connect to MySQL");

	
	if ((isset($_POST["animalType"]) && (!empty($_POST["animalType"]))) &&
		(isset($_POST["hairType"]) && (!empty($_POST["hairType"]))) &&
		(isset($_POST["size"]) && (!empty($_POST["size"]))) &&
		(isset($_POST["age"]) && (!empty($_POST["age"])))
		){
		$animalType = $_POST["animalType"];
		$hairType = $_POST["hairType"];
		$age = $_POST["age"];
		$size = $_POST["size"];
		
		if($hairType == 'any' && !($age == 'any') && !($size == 'any')){
			$query = "SELECT * FROM animal WHERE animal_type = '$animalType' AND age = '$age' AND animal_size = '$size'";
		}
		elseif($hairType == 'any' && $age == 'any' && !($size == 'any')){
			$query = "SELECT * FROM animal WHERE animal_type = '$animalType' AND animal_size = '$size'";
		}
		elseif($hairType == 'any' && !($age == 'any') && $size == 'any'){
			$query = "SELECT * FROM animal WHERE animal_type = '$animalType' 
			AND age = '$age'";
		}
		elseif($hairType == 'any' && $age == 'any' && $size == 'any'){
			$query = "SELECT * FROM animal WHERE animal_type = '$animalType'";
		}
		elseif(!($hairType == 'any') && $age == 'any' && !($size == 'any')){
			$query = "SELECT * FROM animal WHERE animal_type = '$animalType' 
			AND hair = '$hairType' AND animal_size = '$size'";
		}
		elseif(!($hairType == 'any') && $age == 'any' && $size == 'any'){
			$query = "SELECT * FROM animal WHERE animal_type = '$animalType' 
			AND hair = '$hairType'";
		}
		elseif(!($hairType == 'any') && !($age == 'any') && $size == 'any'){
			$query = "SELECT * FROM animal WHERE animal_type = '$animalType' 
			AND hair = '$hairType' AND age = '$age'";
		}
		elseif(!($hairType == 'any') && !($age == 'any') && !($size == 'any')){
			$query = "SELECT * FROM animal WHERE animal_type = '$animalType' 
			AND hair = '$hairType' AND age = '$age' AND animal_size = '$size'";
		}
		else{
			print("<h1>Error: Search not completed</h1>");
			print("<p>No pets available of that type, please <a href='search.html'>search</a> again with different options. Thank you.</p>");
		}
		$result = mysqli_query($db, $query);
		
		if(! $result){
			print("Error - query could not be executed");
			$error = mysqli_error($db);
			print "<p> . $error . </p>";
			exit;
		}
		
		$num_rows = mysqli_num_rows($result);
		
		if($num_rows != 0)
		{
			$count = 0;
?>
	
	<h2>Your dream pet search!</h2>
	<p>Animal type: <?php echo $animalType ?></p>
	<p>Age: <?php echo $age ?></p>
	<p>Hair Type: <?php echo $hairType ?></p>
	<p>Size: <?php echo $size ?></p>
	<p><a href="search.html">Click here</a> to start another search.</p>
	
	<hr>

	<h2>Your available pets</h2>
	
	<table>
		<tr>
<?php
		while($row_array = mysqli_fetch_array($result))
		{
			if($count == 3){
				print("<tr>");
			}
				print("<td class='ani'>");
					print("<h4>$row_array[name]</h4>");
					print("<img class='ani' src='animals/$row_array[image_link]' alt='$row_array[breed]' /><br>$row_array[age] ~ $row_array[breed]");
				print("</td>");
				
			if($count == 3){
				print("</tr>");
			}
			$count = $count + 1;
			
		}
		if(!($count % 3 == 0)){
			print("</tr>");
		}
		print("</table>");
		}
		else{
			print("<h1>No pets available</h1>");
			print("<p>We're sorry, we have no pets available with your search options. Please <a href='search.html'>search</a> again with different options. Thank you.</p>");
		}
	}
	else{
		print("<h1>Error: Search not completed</h1>");
		echo "<p>You must select a choice for each option. Please go back and complete your pet <a href=\"search.html\">search</a>.</p>";
	}
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