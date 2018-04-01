<?php

include 'conn.php';

session_start();

?>
 <!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<head>
	<meta charset="utf-8"/>
    <link rel="shortcut icon" href="images/favicon.ico" /> 
	<title>Paper Movement Details</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<meta content="" name="description"/>
	<meta content="" name="author"/>

	<link rel="stylesheet" href="assets/stylesheets/styles.css" />
</head>
<body>
	 <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <img src="images/dtp_logo.png" height="50px" width="180px" style="margin-left:10px;" align="center"> 

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
              <!--   <a class="navbar-brand" href="http://localhost:8000">DELHI TRAFFIC POLICE - Document Management System</a> -->
            </div>
            <!-- /.navbar-header -->

           <ul class="nav navbar-top-links navbar-right">
                
                <!-- /.dropdown -->
                <li class="dropdown">
                   <form action="logout.php" method="POST">
                    <button class="dropdown-toggle" data-toggle="dropdown" style="margin-top:0.5em">
                        <i class="fa fa-user fa-fw"></i> <i>Logout</i>
                    </button>
                </form>

                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <br>
                       <br>
                       <li></li>
                         <li>
                            <a href="index.html"><i class="fa fa-edit fa-fw"></i> Home</a>
                        </li>
                        <li>
                            <a href="send.html"><i class="fa fa-dashboard fa-fw"></i> Send </a>
                        </li>
                        <li>
                            <a href="receive.html"><i class="fa fa-bar-chart-o fa-fw"></i> Receive </a>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="search.html"><i class="fa fa-table fa-fw"></i> Search</a>
                        </li>
                       
                        <li>
                            <a href="#"><i class="fa fa-paper-word-o fa-fw"></i> View Reports<span class="fa arrow"></span></a> </li>
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
			 <div class="row">
			 	
                <div class="col-lg-12">
                    <h3 class="page-header">Paper Movement Details</h3>
                </div>
                <!-- /.col-lg-12 -->
           </div>
			<div class="row">  
				<div class="col-sm-12">

						<div class="panel panel-default">
	  
		<div class="panel-heading">

		<h3 class="panel-title" >Document Details</h3>
	
	</div>
		
	<div class="panel-body">
				<table class="table table-hover">
                    
	<thead>
		<tr>
			<th>Reference Number</th>
			<th>Subject</th>
			<th>Despatch Date</th>
            <th>Despatch Department</th>
            <th>Despatch Department Name</th>
            <th>Diary number</th>
            <th>Date of receiving</th>
            <th>Registry Number</th>
            <th>Attached File</th>
		</tr>
	</thead>
	<tbody>
        
<?php 

$id = $_GET['id'];

$sql1 = "SELECT * from paper_master_info where paper_ref_id = '$id'";
$result1=mysqli_query($conn,$sql1);

if (mysqli_num_rows($result1) > 0) 
{
      while($row = mysqli_fetch_assoc($result1)) {

        //$from_dt = $row['paper_from_dt'];
        //$to_dt = $row['paper_to_dt'];

//$diff = abs(strtotime($to_dt) - strtotime($from_dt));

//$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));


        ?>
		
        <form role="form" >
        <tr>
			<td><?php echo $row['paper_ref_id']; ?></td>
			<td><?php echo $row['paper_sub']; ?></td>
			<td><?php echo $row['paper_despatch_dt']; ?></td>
			<td><?php echo $row['paper_despatch_dept_type']; ?></td>
            <td><?php echo $row['paper_despatch_dept_name']; ?></td>
            <td><?php echo $row['paper_diary_num']; ?></td>
            <td><?php echo $row['paper_receiving_date']; ?></td>
            <td><?php echo $row['paper_registry_num']; ?></td>
            <td><?php echo $row['paper_file_id']; ?></td>
            

	 </td>
		</tr>
		</form>
        <?php 
    }

} else {

        echo "
        <tr>
        <td>No paper details to show.</td>
    </tr>";
  }
 ?>
	</tbody>

</table>			</div>
	</div>

	</div>
</div>

<div class="row">  
                <div class="col-sm-12">

                        <div class="panel panel-default">
      
        <div class="panel-heading">

        <h3 class="panel-title" >Document Movement Details</h3>
    
    </div>
        
    <div class="panel-body">
                <table class="table table-hover">
                    
    <thead>
        <tr>
            <th>S.No.</th>
            <th>From Office</th>
            <th>From Date</th>
            <th>From Employee PIS No</th>
            <th>To Office</th>
            <th>To Date</th>
            <th>Diary number</th>
            <th>To Employee PIS No</th>
            <th>No. of Papers</th>
            <th>Remarks</th>
        </tr>
    </thead>
    <tbody>
        
<?php 

$s_no = 1;

$sql2 = "SELECT * from paper_movement where paper_ref_id = '$id'";
$result2=mysqli_query($conn,$sql2);

if (mysqli_num_rows($result2) > 0) 
{
      while($row = mysqli_fetch_assoc($result2)) {

        //$from_dt = $row['paper_from_dt'];
        //$to_dt = $row['paper_to_dt'];

//$diff = abs(strtotime($to_dt) - strtotime($from_dt));

//$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));


        ?>
        
        <form role="form" >
        <tr>
            <td><?php echo $s_no; ?></td>
            <td><?php echo $row['paper_from_dept']; ?></td>
            <td><?php echo $row['paper_from_dt']; ?></td>
            <td><?php echo $row['paper_from_emp_id']; ?></td>
            <td><?php echo $row['paper_to_dept']; ?></td>
            <td><?php echo $row['paper_to_dt']; ?></td>
            <td><?php echo $row['paper_dept_diary_num']; ?></td>
            <td><?php echo $row['paper_to_emp_id']; ?></td>
            <td><?php echo $row['paper_nop']; ?></td>
            <td><?php echo $row['paper_remarks']; ?></td>
            

     </td>
        </tr>
        </form>
        <?php 
$s_no++;
    }
} else {

        echo "
        <tr>
        <td>No paper movement to show.</td>
    </tr>";
  }
 ?>
    </tbody>

</table>            </div>
    </div>

    </div>
</div>

            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>
	<script src="http://localhost:8000/assets/scripts/frontend.js" type="text/javascript"></script>
</body>
</html>