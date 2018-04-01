<?php

include 'conn.php';

session_start();


function insert_info(&$conn,&$id,&$sub,&$from_dept) {
	$sql = "INSERT INTO file_master_info(file_ref_id, file_subject, file_origin_dept) VALUES ('$id','$sub','$from_dept')";
	$result = mysqli_query($conn,$sql);
	if (!$result) {
		$info_flag = 0;

	} 	
}

function insert_movement(&$conn,&$id,&$sub,&$from_dept,&$from_emp_id,&$to_dept,&$nop,&$hop,&$rmrk) {
	$sql = "INSERT INTO 
			file_movement(file_ref_id, file_subject, file_from_dept, file_from_emp_id, file_to_dept, file_nop, file_hop_num, file_remarks)VALUES ('$id','$sub','$from_dept','$from_emp_id','$to_dept','$nop','$hop','$rmrk')";
	$result = mysqli_query($conn,$sql);
	if ($result) {
		$mvmt_flag = 0;
	} 
}

$diary_num = $_POST['p_diary'];
$despatch_dept_type = $_POST['p_despatch_dept_type'];
$sub = $_POST['p_sub'];
$to_dept = $_POST['p_to_dept'];
$despatch_num = $_POST['p_despatch_num'];
$despatch_dept_name = $_POST['p_despatch_dept_name'];
$despatch_dt = $_POST['p_despatch_dt'];
$nop = $_POST['p_nop'];
$registry_num = $_POST['p_registry_num'];
$rmrk = $_POST['f_remarks'];


#$id = $_POST['f_id'];
#$from_emp_id = $_POST['f_from_emp_id'];




#hop = 1;

$user = $_SESSION['user'];

$info_flag = 1;
$mvmt_flag = 1;

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


// Setting the value of the flag denotng existence of the file in the table
$query = mysqli_query($conn, "SELECT file_ref_id FROM file_master_info WHERE file_ref_id = '$id'");

if (mysqli_num_rows($query) > 0) {
	$exists = "true";
	insert_movement($conn,$id,$sub,$from_dept,$from_emp_id,$to_dept,$nop,$hop,$rmrk);
} else
{
	$exists = "false";
	insert_info($conn,$id,$sub,$from_dept);
	insert_movement($conn,$id,$sub,$from_dept,$from_emp_id,$to_dept,$nop,$hop,$rmrk);
}
//echo($exists);

if ($info_flag==1 && $mvmt_flag==1) {
	Print '<script>alert("You successfully sent the file titled: ".$sub." with reference number ".$id." to ".$to_dept.".");</script>'; 
	//Print '<script>window.location.assign("index.html");</script>';
} else {
	Print '<script>alert("File sending failed. Please try again!");</script>'; 
	//Print '<script>window.location.assign("send_file.html");</script>';
}


mysqli_close($conn);

?>