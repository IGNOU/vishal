
<?include('extra/top.php');?>

<?include('extra/sidemenu.php');?>

<div class="main">
    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="col-sm-6 pad0">
                <div class="headding">Create Account</div>
            </div>  
        </div>
        <div class="col-sm-12 pad15">
            <form method="POST" class="form" enctype="multipart/form-data">
                <div class="col-sm-12 pad0">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>User Id (Email Type)</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" name="pass" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Select Branch</label>
                            <select name="branch" required class="form-control">
                                <option value="">--</option>
                                <?
                                    $bres=mysql_query("SELECT * FROM create_branch order by(branch_name) asc");
                                    while($brow=mysql_fetch_array($bres))
                                    { 
                                    ?>
                                        <option value="<?echo $brow['bid'];?>"><?echo $brow['branch_name'];?></option>
                                    <?}
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Father's Name</label>
                            <input type="text" name="fname" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender" required class="form-control">
                                <option value="">--</option>
                                <option value="M">M</option>
                                <option value="F">F</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>User Type</label>
                            <select name="type" required class="form-control">
                                <option value="">--</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                    </div>
                </div>
            </form>
            <?
                if(isset($_POST['submit']))
                {
                    extract($_POST);
                    // INSERT INTO `user1`(`userid`, `user_pass`, `user_name`, `f_name`, `gender`, `dob`, `address`, `image`, `user_type`, `branch`, `status`)

                    $sql="insert into user1 values('$email','$pass','$name','$fname','$gender','','','','$type','$branch','Active')";
                    mysql_query($sql);
                    echo "<script>window.location.href='create_account';</script>";
                }
            ?>
        </div>
        <div class="clear"></div>
    </div><br>

    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="col-sm-8 col-xs-12 pad0">
                <div class="headding">Branch List</div>
            </div>
            
        </div>
        <div class="col-sm-12 pad15">
            <div id="data">
                <table class="table">
                    <tr class="tr">
                        <td width="100">#</td>
                        <td>Branch Name</td>
                        <td>Name</td>
                        <td>Gender</td>
                        <td>User Type</td>
                        <td width="100" align="center">Status</td>
                        <td width="100" align="center">Action</td>
                    </tr>
                    <?
                        $sql="SELECT branch_name,user_name,gender,user_type,user1.status,userid FROM user1,create_branch where bid=branch order by(user_name) asc";
                        $res=mysql_query($sql); $i=0;
                        while($row=mysql_fetch_array($res))
                        {   $id=$row['userid']; ++$i;
                        ?>
                            <tr>
                                <td><?echo $i;?></td>
                                <td><?echo $row['branch_name'];?></td>
                                <td><?echo $row['user_name'];?></td>
                                <td><?echo $row['gender'];?></td>
                                <td><?echo $row['user_type'];?></td>
                                <td align="center">
                                    <?
                                        if($row['status']=='Deactive')
                                        {?>
                                            <a href="create_account_status?tid=<?echo $id;?>&&st=Active" class="batt btn">Deactive</a>
                                        <?}
                                        else
                                        {?>
                                            <a href="create_account_status?tid=<?echo $id;?>&&st=Deactive" class="batt btn">Active</a>
                                        <?}
                                    ?>
                                </td>
                                <td align="center">
                                    <a href="#" onclick='JSconfirm(<?php echo $id;?>)'><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?}
                    ?>
                </table>
            </div>
        </div>
        <div class="clear"></div>
    </div><br>
</div>

	






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
        window.location = "delete.php?id="+delid+"&&tname=create_branch";   
    } 
    else {     
        swal("Record Not Deleted.");   
        } });
}
</script>


<?include('extra/footer.php');?>