<?php
$conn = mysqli_connect("localhost", "root", "", "dms");
//Check connection
if(!$conn) 
{
  die("ERROR: Could not connect.".mysqli_connect_error());
}
?>