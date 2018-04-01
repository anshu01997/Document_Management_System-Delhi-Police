<?php

include 'conn.php';

	session_start();

	$username = $_POST["username"];
	$pwd = $_POST["pwd"];

	$sql = "SELECT * from login_details where username = '$username' and pwd = '$pwd'";

	if ($result=mysqli_query($conn,$sql))
 	{

  		if(mysqli_num_rows($result) > 0)
		  {
		  	$_SESSION['user'] = $username;
		  	header("location: index.html");
		  }
		else
		  {
		  	Print '<script>alert("Incorrect Username or Password!");</script>'; //Prompts the user
			Print '<script>window.location.assign("login.html");</script>';
		  }

     	mysqli_free_result($result);
  	}

	mysqli_close($conn);
?>
