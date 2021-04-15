
<?php include('extra/top.php');?>

<?php include('extra/sidemenu.php');?>

<div class="main">
    <div class="page_details" style="font-family: 'Roboto', sans-serif;">
    	<div class="col-sm-2"></div>
        <div class="col-sm-8 pad15">
        	<div class="col-sm-4 pro">
        		<img src="img/<?php echo $pic;?>">
        	</div>
        	<div class="col-sm-6 myprofile"><br><br>
        		<span class="pro-name"><?php echo $data['name'];?></span>
        		<span><i class="fa fa-phone"></i> <?php echo $data['mobile'];?></span>
        		<span><i class="fa fa-envelope-o"></i> <?php echo $data['userid'];?></span>
        		<span style="color: green; font-weight: bold;"><i class="fa fa-lock"></i> <?php echo $data['status'];?></span>
        	</div>
        	<div class="col-sm-2">
        		<!-- <a href="profile_update" class="batt btn"><i class="fa fa-pencil"></i> Edit</a> -->
        	</div>
        </div>
        <div class="clear"></div>
    </div>
</div>

<style type="text/css">
	table{
		font-family: 'Roboto', sans-serif;
		width: 100%;
	}
</style>

<?php include('extra/footer.php');?>