<?php 
include("extra/connect.php");

$id=$_REQUEST['find'];
	if($id!="")
	{
		$pl=$con->query("select * from plan where pid='$id'");
		$row=mysqli_fetch_array($pl);
		$start=date('Y-m-d');
		$vt=$row['validity'];
		$last = date('Y-m-d', mktime(0, 0, 0, date("m")+$vt , date("d"), date("Y")));
		?>
			<div class="col-sm-3">
                <div class="form-group">
                    <label>Plan Start</label>
                    <input type="date" name="plan_start" class="form-control" value="<?php echo $start;?>">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Plan End</label>
                    <input type="date" name="plan_end" class="form-control" value="<?php echo $last;?>">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Deal Amount *</label>
                    <input type="text" name="deal" class="form-control" required value="<?php echo $row['price'];?>">
                </div>
            </div>
		<?php 
	}
	else
	{
		?>
			<div class="col-sm-3">
                <div class="form-group">
                    <label>Plan Start</label>
                    <input readonly type="date" name="plan_start" class="form-control">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Plan End</label>
                    <input readonly type="date" name="plan_end" class="form-control">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Deal Amount *</label>
                    <input type="text" name="deal" class="form-control" required>
                </div>
            </div>
		<?php 
	}

?>