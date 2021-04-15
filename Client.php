
<?php include('extra/top.php');?>

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
                        <input type="text" name="name" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Gender *</label>
                        <select class="form-control" name="gender" required>
                            <option value="">--</option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Mobile *</label>
                        <input type="text" name="mobile" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Email (For User ID) *</label>
                        <input type="text" name="email" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Password *</label>
                        <input type="text" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>User Type *</label>
                        <select class="form-control" name="type" required>
                            <option value="">--</option>
                            <option value="Admin">Admin</option>
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
                                    <option value="<?php echo $plr['pid'];?>">
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
                            <input type="date" name="plan_start" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Plan End</label>
                            <input type="date" name="plan_end" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Deal Amount *</label>
                            <input type="text" name="deal" class="form-control" required>
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

                    $sql="insert into client values('','$name','$gender','$phone','$mobile','$email','$password','$plan','$plan_start','$plan_end','$type','$deal','Active')";
                    $con->query($sql);
                    echo "<script>window.location.href='Client';</script>";
                }
            ?>
        </div>
        <div class="clear"></div>
    </div><br>

    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="col-sm-8 col-xs-12 pad0">
                <div class="headding">Client List</div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="col-sm-12 pad15">
            <table id="example" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Client</td>
                        <td>Mobile</td>
                        <td>Email(Userid)</td>
                        <td>Password</td>
                        <td>Plan</td>
                        <td>Plan Start</td>
                        <td>Plan Last</td>
                        <td width="80" align="center">Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $sql="SELECT * FROM client order by(cid) asc";
                        $res=$con->query($sql);
                        while($row=mysqli_fetch_array($res))
                        {   $id=$row['cid']; $pid=$row['plan'];
                        ?>
                            <tr>
                                <td><?php echo $row['cid'];?></td>
                                <td><?php echo $row['name'];?></td>
                                <td><?php echo $row['mobile'];?></td>
                                <td><?php echo $row['email'];?></td>
                                <td><?php echo $row['password'];?></td>
                                <td>
                                    <?php 
                                    $prow=mysqli_fetch_array($con->query("select * from plan where pid='$pid'"));
                                    echo $prow['plan'];
                                    ?>
                                </td>
                                <td><?php echo date("d-m-Y",strtotime($row['plan_start']));?></td>
                                <td><?php echo date("d-m-Y",strtotime($row['plan_end']));?></td>

                                <td align="center">
                                    <a href="Client_edit?id=<?php echo $id;?>"><i class="fa fa-edit"></i></a>
                                    <a href="#" onclick='JSconfirm(<?php php echo $id;?>)'><i class="fa fa-trash"></i></a>
                                    <?php 
                                        if($row['status']=='Deactive')
                                        {?>
                                            <a href="client_status?tid=<?php echo $id;?>&&st=Active" class="batt-s btn">Deactive</a>
                                        <?php }
                                        else
                                        {?>
                                            <a href="client_status?tid=<?php echo $id;?>&&st=Deactive" class="batt-s btn">Active</a>
                                        <?php }
                                    ?>
                                </td>
                            </tr>
                        <?php }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="clear"></div>
    </div><br>
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