<?php 
	include('extra/connect.php');
	$dev=mysql_fetch_array(mysql_query("select * from d_setting"));
	mysql_close($con);
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $dev['site_name'];?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/log_style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
	<link href="https://fonts.googleapis.com/css?family=Niramit:200,300,400,500,600,700" rel="stylesheet">
</head>
<body>
<div class="container padding">
	<div class="col-sm-4"></div>
	<div class="col-sm-4 login">
		<div class="login_name"><?php echo $dev['site_name'];?></div>

		<form role="form" action="#" method="post">
			<div class="form-group">
				<label for="name">User Id</label>
				<input type="email" class="form-control input" name="email" placeholder="Your User Id" required>
			</div>
			<div class="form-group">
				<label for="name">Password</label>
				<input type="password" class="form-control input" name="pass" placeholder="Your Password" required>
			</div>
			<div class="form-group">
				<label for="name">User Key</label>
				<input type="password" class="form-control input" name="upass" placeholder="Your User Key" required>
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
				include('extra/connect.php');
				$sql="select * from user1 where userid='$email' and user_pass='$pass' and user_key='$upass'";
				$res=mysql_query($sql);
				$row=mysql_fetch_array($res);
				if(!$row)
				{ ?>
					<script type="text/javascript">
						document.getElementById('error').innerHTML="Wrong UserId and Password";
						error.style.padding = "20px";
						error.style.background = "red";
						error.style.color = "white";
						error.style.border = "1px solid red";
					</script>
				<?php }
				else
				{
					session_start();
					$_SESSION['user']=$email;
					echo "<script>window.location.href='home.php';</script>";
				}
			}
		?>
	</div>
</div>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

</body>
</html>