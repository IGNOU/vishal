
<?php include('extra/top.php');?>

<?php include('extra/sidemenu.php');?>

<div class="main">
    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="headding">Change Pasword</div>
        </div>
        <div class="col-sm-12 pad15">
			<form class="form" role="form" method="post">
				<div class="col-sm-5">
	                <div class="form-group">
	                    <input type="password" name="oldpassword" class="form-control" placeholder="Old Password"/>
	                </div>
	                <div class="form-group">
	                    <input type="password" name="new_password" class="form-control" placeholder="New Password"/>
	                </div>
	                <input type="submit" class="btn btn-primary" name="submit" value="Submit">
	            </div>

            </form>
            <div class="col-sm-5" id="error"></div>
			<?php  
			if(isset($_POST['submit']))	
				{
					$old = $_POST['oldpassword'];
					$new = $_POST['new_password'];
					$result = $con->query("SELECT * FROM user1 WHERE userid='$sesuser'");
					$row=mysqli_fetch_array($result);
					$oldpassword = $row['password'];

					if(!empty($old) && !empty($new))
					{
						if($old == $oldpassword){
							$query = $con->query("UPDATE user1 SET password = '$new' WHERE userid = '$sesuser'");
							if($query){ ?>
								<script type="text/javascript">
									document.getElementById('error').innerHTML="Password has been updated";
									error.style.padding = "20px";
									error.style.background = "orange";
									error.style.color = "white";
								</script>
							<?php }
							
						}
						else{?>
							<script type="text/javascript">
								document.getElementById('error').innerHTML="Your old password is not matching";
								error.style.padding = "20px";
								error.style.background = "red";
								error.style.color = "white";
								error.style.border = "1px solid red";
							</script>
						<?php }
						
					}
					else{?>
						<script type="text/javascript">
							document.getElementById('error').innerHTML="Please fill the password field";
							error.style.padding = "20px";
							error.style.background = "red";
							error.style.color = "white";
							error.style.border = "1px solid red";
						</script>
					<?php }
					
					
				}
			 ?>
		</div>
        <div class="clear"></div>
    </div><br>

    
</div>

	



<?php include('extra/footer.php');?>



