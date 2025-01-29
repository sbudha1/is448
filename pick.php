<?php
//Author: Katelyn Atkinson
//Use case: 2 animal search/filter
	header("Cache-Control: no-cache, must-revalidate");
	// Date in the past
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	
	$number = floor(rand(1,5));
	
	switch ($number) {
		case "1":
			echo "Dog";
			break;
		case "2":
			echo "Cat";
			break;
		case "3":
			echo "Bird";
			break;
		case "4":
			echo "Fish";
			break;
		case "5":
			echo "Horse";
			break;
		default:
			echo "Dog";
	}
?>