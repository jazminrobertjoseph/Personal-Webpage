<?php
	//1. Create a database connection
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "robert";
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	//Test if connection occured
	if(mysqli_connect_errno()){
		die("Database connection failed: " . 
			mysqli_connect_error() . 
			"(" . 
			mysqli_connect_errno() . 
			")"
		);
	}

	//1. Perform database query

	//Form Post Values
	$name = mysqli_real_escape_string($connection, $_POST['contactName']);
	$email = mysqli_real_escape_string($connection, $_POST['contactEmail']);
	$message = mysqli_real_escape_string($connection, $_POST['contactMessage']);

	//Creating time history

	date_default_timezone_set('America/Los_Angeles');

	$hour=date('H');
	$minute=date('i');
	$time="{$hour}:{$minute}";
	$month=date('m');
	$day=date('d');
	$year=date('o');
	$date="{$month}/{$day}/{$year}";
	$history="{$date} {$time}";

	//Database Query
	$query = "INSERT INTO contact (name, email, message, history)
				VALUES ('$name','$email','$message','$history')";

	$result = mysqli_query($connection, $query);

	//Test if there was a query error
	if ($result) {
		//Success
		echo 
		"<script>
		alert('Message Succesfully Sent');
		window.location.href='index.html';
		</script>";
	}
	else {
		//Failure
		die("Database Query Failed." . mysqli_error($connection));
	}

	//5. Close database connection
	mysqli_close($connection);
	
?>