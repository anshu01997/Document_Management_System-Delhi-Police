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
	<title>Documentwise Search</title>
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
                            <a href="#"><i class="fa fa-file-word-o fa-fw"></i> View Reports<span class="fa arrow"></span></a> </li>
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
			 <div class="row">
			 	
                <div class="col-lg-12">
                    <h3 class="page-header">Files</h3>
                </div>
                <!-- /.col-lg-12 -->
           </div>
			<div class="row">  
				<div class="col-sm-12">

						<div class="panel panel-default">
	  
		<div class="panel-heading">
		<h3 class="panel-title">Files			</h3>
	
	</div>
		
	<div class="panel-body">
				<table class="table table-hover">
                    
	<thead>
		<tr>
			<th>S.No.</th>
			<th>Reference ID</th>
			<th>Subject</th>
            <th>View</th>
		</tr>
	</thead>
	<tbody>
        
<?php 

$s_no = 1;
$pos=8;

$doc_id = $_POST["doc_id"];
$sub = $_POST["doc_sub"];

if($doc_id!=="" || $sub!=="")
{
$sql = "SELECT * from file_master_info ";
$result=mysqli_query($conn,$sql);

if (mysqli_num_rows($result) > 0) 
{
      while($row = mysqli_fetch_assoc($result)) {


      $f_id= $row['file_ref_id'];
      $str = substr($doc_id, $pos);

      $f_sub= $row['file_subject'];

if($sub=="")
{
$sub ="xyz";
}
      if(($f_id==$str) || (strpos($f_sub, $sub) !== false))
      {
        $id= $row['file_ref_id'];
      

        ?>
		
        <form role="form" action="file_details.php?id=<?php echo $id ?>" method="POST">
        <tr>
			<td><?php echo $s_no; ?></td>
			<td><?php echo $row['file_ref_id']; ?></td>
			<td><?php echo $row['file_subject']; ?></td>
			<td><input type="submit" name="submit" class="btn btn-primary    btn-xs   " value="View"> 

	 </td>
		</tr>
		</form>
        <?php 
    }
$s_no++;
    }
} 
}else {

        echo "
        <tr>
        <td>No files to show.</td>
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