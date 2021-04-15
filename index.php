<?php  
	include('extra/connect.php');
	$dev=mysqli_fetch_array($con->query("select * from d_setting"));
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $dev['developer'];?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/log_style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
</head>
<body>
<?php 
$date=date('Y-m-d');
if($dev['licence_from']>=$date){ ?>
<div class="container padding">
	<div class="col-sm-6">
		<img src="img/product.jpg" class="img-responsive">
	</div>
	<div class="col-sm-2"></div>
	<div class="col-sm-4 login">
		<h3 align="center">Account Login</h3><br>
		<form role="form" action="#" method="post">
			<div class="form-group">
				<label for="name">User Id</label>
				<input type="text" class="form-control" name="email" placeholder="Your User Id" required>
			</div>
			<div class="form-group">
				<label for="name">Password</label>
				<input type="password" class="form-control" name="pass" placeholder="Your Password" required>
			</div>
			<div class="form-group">
				<label for="name"></label>
				<input type="submit" class="form-control input_batt" name="login" value="LOGIN">
			</div>
		</form>
		<div id="error"></div>
		<?php 
			if(isset($_POST['login']))
			{
				extract($_POST);
				$sql="select * from user1 where userid='$email' and password='$pass' and status='Active'";
				$res=$con->query($sql);
				$row=mysqli_fetch_array($res);

				$sql2="select * from client where email='$email' and password='$pass' and status='Active'";
				$res2=$con->query($sql2);
				$row2=mysqli_fetch_array($res2);

				$sql3="select * from employee where mobile='$email' and password='$pass'";
				$res3=$con->query($sql3);
				$row3=mysqli_fetch_array($res3);


				if($row!="")
				{ 	
					session_start();
					$_SESSION['super']=$email;
					echo "<script>window.location.href='home.php';</script>";
				}
				elseif($row2!="")
				{
					session_start();
					$_SESSION['cu']=$email;
					echo "<script>window.location.href='clients/home.php';</script>";
				}
				elseif($row3!="")
				{
					session_start();
					$_SESSION['emp']=$email;
					echo "<script>window.location.href='employee/home.php';</script>";
				}
				else
				{
					?>
						<script type="text/javascript">
							document.getElementById('error').innerHTML="Wrong UserId and Password";
							error.style.padding = "20px";
							error.style.background = "red";
							error.style.color = "white";
							error.style.border = "1px solid red";
						</script>
					<?php 
				}
			}
		?>
	</div>
</div>
<?php  } // if cloging

else{ ?>

	<div class="container padding">
		<div class="col-sm-12 login">
			<div class="login_name">Your licence are expired.</div>
			<h4 align="center">Please Renew your site. Contact Us <b><a href="<?php echo $dev['url'];?>"><?php echo $dev['developer'];?></a></b></h4>
		</div>
	</div>

<?php }
?>






<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

</body>
</html>
<?php  
	mysqli_close($con);
?>