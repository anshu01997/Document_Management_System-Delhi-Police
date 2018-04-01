<?php

include 'conn.php';

session_start();

function insert_info(&$conn,&$id,&$sub,&$from_dept,&$paper) {
	$sql = "INSERT INTO file_master_info(file_ref_id, file_subject, file_origin_dept, attached_paper_id) VALUES ('$id','$sub','$from_dept','$paper')";
	$result = mysqli_query($conn,$sql);
	if (!$result) {
		$info_flag = 0;

	} 	
}

function insert_movement(&$conn,&$id,&$sub,&$from_dept,&$from_emp_id,&$to_dept,&$nop,&$hop,&$rmrk) 
{
	
	$query = "UPDATE file_master_info SET file_hops='$hop' WHERE file_ref_id ='$id'";
	$result = mysqli_query($conn,$query); 

	$sql = "INSERT INTO `file_movement` (`file_ref_id`, `file_subject`, `file_from_dept`, `file_from_emp_id`, `file_to_dept`, `file_nop`, `file_hop_num`, `file_remarks`) VALUES ('$id','$sub','$from_dept','$from_emp_id','$to_dept','$nop','$hop','$rmrk')";
	//$sqli = "INSERT INTO `file_movement` (`file_ref_id`, `file_subject`, `file_from_dt`, `file_from_dept`, `file_from_emp_id`, `file_to_dt`, `file_to_dept`, `file_to_emp_id`, `file_nop`, `file_hop_num`, `file_remarks`) VALUES ('54657', 'hello', CURRENT_TIMESTAMP, 'DCP/T-North', '647', '2017-07-11', 'ACP', 'NULL', '7', '1', 'none')";
	$result = mysqli_query($conn,$sql);
	if (!$result) {
		$mvmt_flag = 0;
	}
}

$doc_id = $_POST['f_id'];
$sub = $_POST['f_sub'];
$from_emp_id = $_POST['f_from_emp_id'];
$to_dept = $_POST['f_to_dept'];
$nop = $_POST['f_nop'];
$rmrk = $_POST['f_remarks'];

$paper =$_POST['paper'];
#hop = 1;

$user = $_SESSION['user'];

$info_flag = 1;
$mvmt_flag = 1;

$flag=0;

$pos=8;
$id = substr($doc_id, $pos);

//From dept
$branch = mysqli_query($conn, "SELECT branch_name FROM login_details WHERE username = '$user'");
while ($row = mysqli_fetch_array($branch)) {
	$from_dept = $row['branch_name'];
}

//Calculation of the number of hops
$hop_row = mysqli_query($conn, "SELECT MAX(file_hop_num) AS 'recent' FROM file_movement WHERE file_ref_id='$id'");

if(mysqli_num_rows($hop_row) > 0) 
{
	$row = mysqli_fetch_array($hop_row);
	$hop_value = $row['recent'];
	$hop_value++;
	$hop = $hop_value;
}
else
{
	$hop = 1;
}


$sql1 = "SELECT emp_pis_no FROM employee_details";
$result=mysqli_query($conn,$sql1);

	while($row = mysqli_fetch_assoc($result)) {

		if($from_emp_id==$row['emp_pis_no'])
		{
			$flag=1;
		}
}


if($flag==1)
{
// Setting the value of the flag denotng existence of the file in the table
	$query = mysqli_query($conn, "SELECT file_ref_id FROM file_master_info WHERE file_ref_id = '$id'");

	if (mysqli_num_rows($query) > 0) {
		$exists = "true";
		insert_movement($conn,$id,$sub,$from_dept,$from_emp_id,$to_dept,$nop,$hop,$rmrk);
	} else
	{
		$exists = "false";
		insert_info($conn,$id,$sub,$from_dept,$paper);
		insert_movement($conn,$id,$sub,$from_dept,$from_emp_id,$to_dept,$nop,$hop,$rmrk);
	}
	//echo($exists);

	if ($info_flag==1 && $mvmt_flag==1) {
		Print '<script>alert("You successfully sent the file.");</script>'; 
		//Print '<script>window.location.assign("index.html");</script>';
	} else {
		Print '<script>alert("File sending failed. Please try again!");</script>'; 
		//Print '<script>window.location.assign("send_file.html");</script>';
	}
}
else
{

	Print '<script>alert("Enter correct PIS number and try again!");</script>'; //Prompts the user
			Print '<script>window.location.assign("send_file.html");</script>';
}



mysqli_close($conn);

?>