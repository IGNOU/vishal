<?php 
    date_default_timezone_set('Asia/Kolkata');
    $dt=date('Y-m-d');
    
    session_start();
    if(!$_SESSION['cu'])
        echo "<script>window.location.href='logout.php';</script>";

    $sesuser=$_SESSION['cu'];

    include('extra/connect.php');
    $data=mysqli_fetch_array($con->query("select * from client where email='$sesuser'"));
    $data2=mysqli_fetch_array($con->query("select * from d_setting"));

    $clientid=$data['cid'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $data2['site_name'];?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />        
    <link href="css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/slidemenu.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">

    <link rel="stylesheet" href="js/sweetalert.css">
    <script src="js/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" />

</head>
<body class="with-side-menu">

<div id="overlay">
    <div class="cv-spinner">
        <span class="spinner"></span>
    </div>
</div>


<div class="top">
    <div class="col-sm-9 col-md-9 col-xs-8 pad0">
        <i class="fa fa-bars hamburger hamburger--htla"></i>
        <?php echo $data2['site_name'];?>
    </div>
    <div class="col-sm-2 col-md-2 col-xs-2 pad0 text-right clients">
        Client ID :- <span><?php echo $clientid;?></span><br>
        Id :- <?php echo $sesuser;?>
    </div>
    <div class="col-sm-1 col-md-1 col-xs-2 pad0 text-right">
        <div class="admin dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user-circle"></i>
        </div>
        <div class="dropdown-menu pull-right">
            <a href="profile"><i class="fa fa-user"></i> Profile</a>
            <a href="password"><i class="fa fa-key"></i> Change PSW.</a>
            <a href="setting"><i class="fa fa-cog"></i> Setting</a>
            <a href="logout"><i class="fa fa-sign-out"></i> Log Out</a>
        </div>
    </div>

</div>