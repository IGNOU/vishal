
<?php include('extra/top.php');?>

<?php include('extra/sidemenu.php');?>

<div class="main">
    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="headding">Developer Setting</div>
        </div>
        <div class="col-sm-12 pad15">
            <div class="col-sm-12">
				<h4>Licence</h4><br>
				<form role="form" action="#" method="post" class="form">
					<div class="form-group col-sm-4">
						<label for="name">Licence Date (To)</label>
						<input type="text" class="form-control" name="todate" required value="<?php echo $data2[1];?>">
					</div>
					<div class="form-group col-sm-1">
						<label for="name" style="font-size: 2em;">To</label>
					</div>
					<div class="form-group col-sm-4">
						<label for="name">Licence Date (From)</label>
						<input type="text" class="form-control" name="fromdate" required value="<?php echo $data2['licence_from'];?>">
					</div>
					<div class="form-group col-sm-12">
						<label for="name"></label>
						<input type="submit" class="btn btn-primary" name="licence" value="Submit">
					</div>
				</form>
				<?php 
					if(isset($_POST['licence']))
					{
						extract($_POST);
						$sql="update d_setting set licence_to='$todate',licence_from='$fromdate' where user_type='$sesuser'";
						$con->query($sql);
						echo "<script>window.location.href='d_setting.php';</script>";
					}
				?>	
			</div>

			<div class="col-sm-12">
				<h4>Website Name</h4><br>
				<form role="form" action="#" method="post" class="form">
					<div class="form-group col-sm-9">
						<label for="name">Site Name</label>
						<input type="text" class="form-control" name="sitename" required value="<?php echo $data2['site_name'];?>">
					</div>
					<div class="form-group col-sm-12">
						<label for="name"></label>
						<input type="submit" class="btn btn-primary" name="site" value="Submit">
					</div>
				</form>
				<?php
					if(isset($_POST['site']))
					{
						extract($_POST);
						$sql="update d_setting set site_name='$sitename' where user_type='$sesuser'";
						$con->query($sql);
						echo "<script>window.location.href='d_setting.php';</script>";
					}
				?>	
			</div>

			<div class="col-sm-12">
				<h4>Developer</h4><br>
				<form role="form" action="#" method="post" class="form">
					<div class="form-group col-sm-5">
						<label for="name">Develope By</label>
						<input type="text" class="form-control" name="developer" required value="<?php echo $data2['developer'];?>">
					</div>
					<div class="form-group col-sm-5">
						<label for="name">Develope URL</label>
						<input type="text" class="form-control" name="url" required value="<?php echo $data2['url'];?>">
					</div>
					<div class="form-group col-sm-5">
						<label for="name">Contact</label>
						<input type="text" class="form-control" name="contact" required value="<?php echo $data2['contact'];?>">
					</div>
					<div class="form-group col-sm-5">
						<label for="name">Contact 2</label>
						<input type="text" class="form-control" name="contact2" required value="<?php echo $data2['contact2'];?>">
					</div>
					<div class="form-group col-sm-5">
						<label for="name">Email</label>
						<input type="email" class="form-control" name="email" required value="<?php echo $data2['email'];?>">
					</div>
					<div class="form-group col-sm-12">
						<label for="name"></label>
						<input type="submit" class="btn btn-primary" name="design" value="Submit">
					</div>
				</form>
				<?php 
					if(isset($_POST['design']))
					{
						extract($_POST);
						$sql="update d_setting set developer='$developer',url='$url',contact='$contact',contact2='$contact2',email='$email' where user_type='$sesuser'";
						$con->query($sql);
						echo "<script>window.location.href='d_setting.php';</script>";
					}
				?>	
			</div>

        </div>
        <div class="clear"></div>
    </div><br>
</div>


<?php include('extra/footer.php');?>
