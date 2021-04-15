
<?php include('extra/top.php');?>

<?php include('extra/sidemenu.php');?>

<div class="main">
    <div class="page_details pad15" style="background: none; border: none;">
        <div class="col-sm-12 profile">
            <div class="col-sm-12 pro">
				<div class="col-sm-2 pad">
					<img src="img/<?echo $pic;?>">
				</div>
				<div class="col-sm-10">
					<div class="pro-name"><?echo $data['user_name'];?></div>
				</div>
			</div>
        </div>
        <div class="clear"></div>
    </div><br>

	<div class="col-sm-6">
		<div class="notbox">
			<div class="col-sm-12 pad15_line">
	            <div class="col-sm-6 pad0">
	                <div class="headding"><i class="fa fa-info-circle"></i> Profile Information</div>
	            </div>  
	        </div>
	        <div class="notbox2">
		        <table class="table2">
					<tr>
						<td width="200">Name</td>
						<td><?echo $data['user_name'];?></td>
					</tr>
					<tr>
						<td>Father's Name</td>
						<td><?echo $data['f_name'];?></td>
					</tr>
					<tr>
						<td>Gender</td>
						<td><?echo $data['gender'];?></td>
					</tr>
					<tr>
						<td>DOB</td>
						<td><?echo date("d-m-Y", strtotime($data['dob']));?></td>
					</tr>
					<tr>
						<td>Address</td>
						<td><?echo $data['address'];?></td>
					</tr>
				</table>
			</div>
	        <div class="clear"></div>
		</div>
	</div>

	<div class="col-sm-6">
		<div class="notbox">
			<div class="col-sm-12 pad15_line">
	            <div class="col-sm-6 pad0">
	                <div class="headding"><i class="fa fa-pencil-square-o"></i> Profile Update</div>
	            </div>  
	        </div>
	       	<div class="notbox2">
	       		<form role="form" action="#" method="post" class="form" enctype="multipart/form-data">
					<div class="form-group">
						<label for="name">User Name</label>
						<input type="text" class="form-control" name="name" value="<?echo $data['user_name'];?>">
					</div>
					<div class="form-group">
						<label for="name">Father's Name</label>
						<input type="text" class="form-control" name="fname" value="<?echo $data['f_name'];?>">
					</div>
					<div class="form-group">
						<label for="name">Gender</label>
						<select class="form-control" name="gender">
							<option value="M" <?if($data['gender']=='M') echo "Selected";?>>Male</option>
							<option value="F" <?if($data['gender']=='F') echo "Selected";?>>Female</option>
						</select>
					</div>
					<div class="form-group">
						<label for="name">DOB (dd-mm-yyyy)</label>
						<input type="date" class="form-control" name="dob" value="<?echo $data['dob'];?>">
					</div>
					<div class="form-group">
						<label for="name">Address</label>
						<textarea name="address" class="form-control"><?echo $data['address'];?></textarea>
					</div>
					<div class="form-group">
						<label for="name">Profile Image</label>
						<input type="file" name="file" class="form-control">
					</div>
					<div class="form-group">
						<label for="name"></label>
						<input type="submit" class="btn btn-primary" name="update" value="UPDATE PROFILE">
					</div>
				</form>
				<?php
					if(isset($_POST['update']))
					{
						extract($_POST);
						if(!$_FILES['file']['name'])
							$img=$pic=$data['image'];
						else
						{
							$img=rand().$_FILES['file']['name'];
							unlink("img/$pic");
						}

						$sql="update user1 set user_name='$name', f_name='$fname', gender='$gender', dob='$dob', address='$address', image='$img' where userid='$sesuser'";
						$con->query($sql);
						move_uploaded_file($_FILES['file']['tmp_name'], "img/".$img);
						echo "<script>window.location.href='profile.php';</script>";
					}
				?>
	       	</div>
	    </div>
	    <br><br>
	</div>
</div>





<?include('extra/footer.php');?>