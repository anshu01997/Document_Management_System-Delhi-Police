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
	<title>Receive</title>
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
                    <h1 class="page-header">Receive Notifications</h1>
                </div>
                <!-- /.col-lg-12 -->
           </div>
			<div class="row">  
				<div class="col-sm-12">
	<div class="col-sm-12">
						<div class="panel panel-default">
	  
		<div class="panel-heading">
		<h3 class="panel-title">Documents waiting to be received			</h3>
	
	</div>
		
	<div class="panel-body">
				<table class="table table-hover">
                    
	<thead>
		<tr>
			<th>S.No.</th>
			<th>Reference ID</th>
			<th>Subject</th>
			<th>From</th>
            <th>Diary Number</th>
            <th>PIS Number</th>
			<th>Accept</th>
		</tr>
	</thead>
	<tbody>
        
<?php 

$user = $_SESSION['user'];
$s_no = 1;

$branch = mysqli_query($conn, "SELECT branch_name FROM login_details WHERE username = '$user'");
while ($row = mysqli_fetch_array($branch)) {
    $branch_name = $row['branch_name'];
}

$sql = "SELECT * from paper_movement where paper_to_dept = '$branch_name' and paper_received = '0'";
$result=mysqli_query($conn,$sql);

if (mysqli_num_rows($result) > 0) 
{
       while($row = mysqli_fetch_assoc($result)) {

      $id = $row['paper_ref_id'];
      $hop = $row['paper_hop_num'];

        ?>
		
        <form role="form" action="accept_paper.php?id=<?php echo $id ?>&hop=<?php echo $hop ?>" method="POST">
        <tr>
			<td><?php echo $s_no; ?></td>
			<td><?php echo $row['paper_ref_id']; ?></td>
			<td><?php echo $row['paper_subject']; ?></td>
			<td><?php echo $row['paper_from_dept']; ?></td>
            <td class="form-group">
                <input type="text" name="diary_no" placeholder="Enter your diary number" required>
            </td>
            <td class="form-group">
                <input type="text" name="emp_pis_no" placeholder="Enter your PIS number" required>
            </td>
			<td><input type="submit" name="submit" class="btn btn-primary    btn-xs   " value="Accept"> 

	 </td>
		</tr>
		</form>
        <?php 
$s_no++;
    }
} else {

        echo "
        <tr>
        <td>No papers to be received</td>
    </tr>";
  }
 ?>
	</tbody>

</table>			</div>
	</div>

	</div>
</div>
<div>

</div>
            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>
	<script src="http://localhost:8000/assets/scripts/frontend.js" type="text/javascript"></script>
</body>
</html>