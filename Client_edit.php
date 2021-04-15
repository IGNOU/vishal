
<?php 
    include('extra/top.php');

    $id=$_REQUEST['id'];
    $sql="SELECT * FROM client where cid='$id'";
    $res=$con->query($sql);
    $row=mysqli_fetch_array($res);
?>

<?php include('extra/sidemenu.php');?>

<div class="main">
    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="col-sm-6 pad0">
                <div class="headding">Add Client</div>
            </div>  
        </div>
        <div class="col-sm-12 pad15">
            <form method="POST" class="form" enctype="multipart/form-data">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Client Name *</label>
                        <input type="text" name="name" class="form-control" required value="<?php echo $row['name'];?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Gender *</label>
                        <select class="form-control" name="gender" required>
                            <option value="">--</option>
                            <option value="M" <?php if($row['gender']=="M") echo "Selected";?>>Male</option>
                            <option value="F" <?php if($row['gender']=="F") echo "Selected";?>>Female</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" value="<?php echo $row['phone'];?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Mobile *</label>
                        <input type="text" name="mobile" class="form-control" required value="<?php echo $row['mobile'];?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Email (For User ID) *</label>
                        <input type="text" name="email" class="form-control" required value="<?php echo $row['email'];?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Password *</label>
                        <input type="text" name="password" class="form-control" required value="<?php echo $row['password'];?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>User Type *</label>
                        <select class="form-control" name="type" required>
                            <option value="">--</option>
                            <option value="Admin" <?php if($row['usertype']=="Admin") echo "Selected";?>>Admin</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Plan *</label>
                        <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="plan" required onchange="plan_list(this.value)">
                            <option value="">--</option>
                            <?php 
                                $pl=$con->query("select * from plan order by validity asc");
                                while($plr=mysqli_fetch_array($pl))
                                {?>
                                    <option value="<?php echo $plr['pid'];?>" <?php if($plr['pid']==$row['plan']) echo "Selected";?>>
                                        <?php echo $plr['plan'];?> - 
                                        <?php echo $plr['validity'];?>-months - 
                                        <?php echo $plr['emp_limit'];?>-Limit
                                    </option>
                                <?php }
                            ?>
                        </select>
                    </div>
                </div>
                <div id="plan_data">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Plan Start</label>
                            <input type="date" name="plan_start" class="form-control" value="<?php echo $row['plan_start'];?>">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Plan End</label>
                            <input type="date" name="plan_end" class="form-control" value="<?php echo $row['plan_end'];?>">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Deal Amount *</label>
                            <input type="text" name="deal" class="form-control" required value="<?php echo $row['deal'];?>">
                        </div>
                    </div>
                </div>
            
                <div class="col-sm-12">
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                    </div>
                </div>
            </form>
            <?php 
                if(isset($_POST['submit']))
                {
                    extract($_POST);

                    $sql="update client set name='$name',gender='$gender',phone='$phone',mobile='$mobile',email='$email',password='$password',plan='$plan',plan_start='$plan_start',plan_end='$plan_end',usertype='$type',deal='$deal' where cid='$id'";
                    $con->query($sql);
                    echo "<script>window.location.href='Client';</script>";
                }
            ?>
        </div>
        <div class="clear"></div>
    </div>
</div>

	



<script type="text/javascript">
    function plan_list(val)
    {
        xmlhttp=new XMLHttpRequest();
        xmlhttp.open("GET","plan_list.php?find="+val,false);
        xmlhttp.send(null);
        document.getElementById('plan_data').innerHTML=xmlhttp.responseText;
    }
</script>

<script type="text/javascript">
function JSconfirm(delid){
    swal({ 
    title: "Do you want to delete it ?",   
    // text: "Redirect me to home page?",   
    type: "warning",   
    showCancelButton: true,   
    confirmButtonColor: "#DD6B55",   
    confirmButtonText: "Yes",   
    cancelButtonText: "No",   
    closeOnConfirm: false,   
    closeOnCancel: false }, 
    
    function(isConfirm){   
    if (isConfirm) 
    {   
        window.location = "delete.php?id="+delid+"&&tname=client";   
    } 
    else {     
        swal("Record Not Deleted.");   
        } });
}
</script>


<?php include('extra/footer.php');?>