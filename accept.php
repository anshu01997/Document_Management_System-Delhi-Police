<?php

include 'conn.php';

session_start();

$id = $_GET['id'];
$hop = $_GET['hop'];


$emp_id = $_POST["emp_pis_no"];

date_default_timezone_set('Asia/Kolkata');

$timestamp = date("Y-m-d H:i:s",time());

$sql1 = "SELECT emp_pis_no FROM employee_details";
$result=mysqli_query($conn,$sql1);

if($result)
{
	while($row = mysqli_fetch_assoc($result)) {

		if($emp_id==$row['emp_pis_no'])
		{
$sql2 = "UPDATE file_movement SET file_to_dt='$timestamp', file_to_emp_id='$emp_id', file_received='1' WHERE file_ref_id ='$id'AND file_hop_num = '$hop' ";

	if ($result=mysqli_query($conn,$sql2))
 	{
Print '<script>alert("Successfully Received the file!");</script>'; //Prompts the user
			Print '<script>window.location.assign("index.html");</script>';

  	}
  	else
  	{
  		Print '<script>alert("Receiving the file failed.Please try again!");</script>'; //Prompts the user
			Print '<script>window.location.assign("receive_file.php");</script>';
  	}
		}

}
Print '<script>alert("Enter correct PIS number and try again!");</script>'; //Prompts the user
			Print '<script>window.location.assign("receive_file.php");</script>';

}
else
{
	Print '<script>alert("Error! Please try again!");</script>'; //Prompts the user

}



?>