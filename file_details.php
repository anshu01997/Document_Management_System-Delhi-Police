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
   <title>Tracking</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
<link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,600,700' rel='stylesheet' type='text/css'>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/stylesheets/styles.css" />
   <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,600,700' rel='stylesheet' type='text/css'>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="timeline.sass" />
 <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,600,700' rel='stylesheet' type='text/css'>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
.timeline {
    list-style-type: none;
    display: flex;
    align-items: center;
    justify-content: center;
}

.li {
    transition: all 200ms ease-in;
}

.timestamp {
    margin-bottom: 20px;
    padding: 0px 40px;
    display: flex;
    flex-direction: column;
    align-items: center;
    font-weight: 100;
    font-color: black;
}

.status {
    padding: 0px 40px;
    display: flex;
    justify-content: center;
    border-top: 2px solid #D6DCE0;
    position: relative;
    transition: all 200ms ease-in;
}

.status h4 {
    font-weight: 600;
}

.status:before {
    content: '';
    width: 25px;
    height: 25px;
    background-color: white;
    border-radius: 25px;
    border: 1px solid #ddd;
    position: absolute;
    top: -15px;
    left: 42%;
    transition: all 200ms ease-in;
    font-color: red;
}

.li.complete .status {
    border-top: 2px solid #66DC71;
}

.li.complete .status:before {
    background-color: #66DC71;
    border: none;
    transition: all 200ms ease-in;
}

.li.complete .status h4 {
    color:black;
}

@media (min-device-width: 320px) and (max-device-width: 700px) {
    .timeline {
        list-style-type: none;
        display: block;
    }
    .li {
        transition: all 200ms ease-in;
        display: flex;
        width: inherit;
    }
    .timestamp {
        width: 100px;
    }
    .status:before {
        left: -8%;
        top: 30%;
        transition: all 200ms ease-in;
    }
}

html, body {
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    font-family: 'Titillium Web', sans serif;
}

    </style>
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
               <!--  <a class="navbar-brand" href="http://localhost:8000">DELHI TRAFFIC POLICE - Document Management System</a> -->
            </div>
            <!-- /.navbar-header -->
 <div class="nav navbar-top-links navbar-right">
                
             
                <div class="dropdown">
                    <form action="logout.php" method="POST">
                    <button class="dropdown-toggle" data-toggle="dropdown" style="margin-top:0.5em">
                        <i class="fa fa-user fa-fw"></i>  <i >Logout</i>
                    </button>
                </form>
                    
                </div>
                
            </div>
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
                    <h3 class="page-header">
                      <?php 
                        #Code to print the File ID and Subject on top as header
                        $id = $_GET['id'];

                         
                        echo $id." "; 
                        $sql = "SELECT file_subject FROM file_master_info WHERE file_ref_id='$id'"; 
                        $result = mysqli_query($conn,$sql);
                        $row = mysqli_fetch_assoc($result);
                        echo "|| ".$row['file_subject'];
                      ?>
                    </h3>
                </div>
                <!-- /.col-lg-12 -->
           </div>
      <div class="row">  
        <div class="col-sm-12">

            <div class="panel panel-default">
    
    <div class="panel-heading">
    <h3 class="panel-title">File Movement Details      </h3>
  
  </div>
    
  <div class="panel-body">
        <table class="table table-hover">
                    
  <thead>
    <tr>
      <th>S.No.</th>
      <th>From Dept.</th>
      <th>Sent on Date/Time</th>
      <th>By Emp. ID</th>
      <th>To Dept.</th>
      <th>Received on Date/Time</th>
      <th>By Emp. ID</th>
      <th>No. of Papers</th>
      <th>Remarks</th>
      <th>Days</th>
    </tr>
  </thead>
  <tbody>
        
<?php 

$s_no = 1;

$sql = "SELECT * from file_movement where file_ref_id = '$id'";
$result=mysqli_query($conn,$sql);

if (mysqli_num_rows($result) > 0) 
{
      while($row = mysqli_fetch_assoc($result)) {
    
        $from_dt = $row['file_from_dt'];
        if($s_no == 1)
        {
            $days = 0;
        }
        else
        {
          $diff = abs(strtotime($to_dt) - strtotime($from_dt));
          $years = floor($diff / (365*60*60*24)); 
          $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
          $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        }
        $to_dt = $row['file_to_dt'];           
        ?>

        <tr>
      <td><?php echo $s_no; ?></td>
      <td><?php echo $row['file_from_dept']; ?></td>
      <td><?php echo $row['file_from_dt']; ?></td>
      <td><?php echo $row['file_from_emp_id']; ?></td>
      <td><?php echo $row['file_to_dept']; ?></td>
      <td><?php echo $row['file_to_dt']; ?></td>
      <td><?php echo $row['file_to_emp_id']; ?></td>
      <td><?php echo $row['file_nop']; ?></td>
      <td><?php echo $row['file_remarks']; ?></td>
      <td><?php echo $days; ?></td>
    </tr>
    </form>
        <?php 
$s_no++;
    }
} else {

        echo "
        <tr>
        <td>No file movement to show.</td>
    </tr>";
  }
 ?>
</div>
</tbody>
</table>
</div>
</div>
<ul class="timeline" id="timeline">
<?php 



$s_no = 1;

$sql = "SELECT * from file_movement where file_ref_id = '$id'";
$result=mysqli_query($conn,$sql);

if (mysqli_num_rows($result) > 0) 
{

      while($row = mysqli_fetch_assoc($result)) { 

        $from_dt = $row['file_from_dt'];
        if($s_no == 1)
        {
            $days = 0;
        }
        else
        {
          $diff = abs(strtotime($to_dt) - strtotime($from_dt));
          $years = floor($diff / (365*60*60*24)); 
          $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
          $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        }
        $to_dt = $row['file_to_dt'];

?>


  <li class="li complete">
    <div class="timestamp" style="font-weight:600;">
      <span class="author" >
        <?php $date = date('d-m-Y',strtotime($row['file_to_dt'])); echo $date; ?>
      </span>
      <span class="date">
        <?php $date = date('d-m-Y',strtotime($row['file_from_dt'])); echo $date; ?>
      </span>
    </div>
    <div class="status">
      <h4><?php echo $row['file_from_dept']; ?></h4>
    </div>
    <div>
      <h5 align="center" style="margin-top:0px;font-weight:600;"><?php echo $days." days"; ?></h5>    
    </div>
  </li>
<?php

$s_no++;
}
} ?> 
<ul class="timeline" id="timeline">
  <script src="http://localhost:8000/assets/scripts/frontend.js" type="text/javascript"></script>
</body>
</html>