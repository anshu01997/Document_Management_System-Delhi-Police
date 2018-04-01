<?php

include 'conn.php';

session_start();

$doc_id = $_GET['id'];
$hop = $_GET['hop'];

$emp_id = $_POST["emp_pis_no"];
$diary_no = $_POST["diary_no"];


$pos=8;
$id = substr($doc_id, $pos);


$timestamp = date("Y-m-d H:i:s",time());

$sql1 = "SELECT emp_pis_no FROM employee_details";
$result=mysqli_query($conn,$sql1);

if($result)
{
	while($row = mysqli_fetch_assoc($result)) {

		if($emp_id==$row['emp_pis_no'])
		{
$sql2 = "UPDATE paper_movement SET paper_to_dt='$timestamp', paper_to_emp_id='$emp_id', paper_dept_diary_num='$diary_no', paper_received='1' WHERE paper_ref_id ='$id'AND paper_hop_num = '$hop' ";

	if ($result=mysqli_query($conn,$sql2))
 	{
Print '<script>alert("Successfully Received the paper!");</script>'; //Prompts the user
			Print '<script>window.location.assign("index.html");</script>';

  	}
  	else
  	{
  		Print '<script>alert("Receiving the paper failed.Please try again!");</script>'; //Prompts the user
			Print '<script>window.location.assign("receive_paper.php");</script>';
  	}
		}

}
Print '<script>alert("Enter correct PIS number and try again!");</script>'; //Prompts the user
			Print '<script>window.location.assign("receive_paper.php");</script>';

}
else
{
	Print '<script>alert("Error! Please try again!");</script>'; //Prompts the user

}



?>