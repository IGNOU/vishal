<?include('extra/top.php');?>

<?include('extra/sidemenu.php');?>

<?
    $f=$_REQUEST['f'];
    $sallary="";
    $sallary_to="";
    $ee_share="";
    $er_share="";
    $state="";
    if($f!=0)
    {
        $sql="SELECT * FROM com_pt where pt_id='$f'";
        $res=$con->query($sql);
        $row=mysqli_fetch_array($res);

        $pid=$row['pt_id'];
        $sallary=$row['sallery'];
        $sallary_to=$row['sallery_to'];
        $ee_share=$row['ee_share'];
        $er_share=$row['er_share'];
        $state=$row['state'];
    }
?>

<div class="main">
    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="col-sm-6 pad0">
                <div class="headding">PT Setting</div>
            </div>  
            <div class="col-sm-6 text-right pad0">
                <a href="setting_pt?f=0" class="batt btn">Add New</a>
                <a href="create_company" class="batt btn">Back</a>
            </div>
        </div>
        <div class="col-sm-12 pad15">
            <form class="form" role="form" method="post">
                <table class="table table-bordered">
                    <tr>
                        <th>Select Allowance</th>
                        <th>Salary From</th>
                        <th>To</th>
                        <th>EE Share</th>
                        <th>ER Share</th>
                        <th>State</th>
                    </tr>
                    <tr>
                        <td>
                            <select name="allowance[]" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" multiple="true">
                                <?
                                    $sql="select * from allowance where client_id='$clientid' order by allowance asc";
                                    $res=$con->query($sql);
                                    while($al=mysqli_fetch_array($res))
                                    {
                                        $alw=$al['allowance'];
                                        $alt=0;
                                        if($f!=0)
                                        {
                                            $s="select * from com_pt_allowance where pt_allowance='$alw' and pt_id='$pid'";
                                            $alt=mysqli_fetch_array($con->query($s));
                                        }
                                        if(!$alt)
                                        {?>
                                            <option><?echo $alw;?></option>
                                        <?}
                                        else
                                        {?>
                                            <option selected><?echo $alw;?></option>
                                        <?}
                                    }
                                ?>
                            </select>
                        </td>
                        <td><input type="text" name="pt_salleryfrom" class="form-control" value="<?echo $sallary;?>"></td>
                        <td><input type="text" name="pt_salleryto" class="form-control" value="<?echo $sallary_to;?>"></td>
                        <td><input type="text" name="ee_share" class="form-control" value="<?echo $ee_share;?>"></td>
                        <td><input type="text" name="er_share" class="form-control" value="<?echo $er_share;?>"></td>
                        <td>
                            <select name="state" class="form-control">
                                <option value="">--</option>
                                <?
                                    $sql="select distinct state from employee where client_id='$clientid' order by state asc";
                                    $res=$con->query($sql);
                                    while($al=mysqli_fetch_array($res))
                                    {?>
                                       <option <?if($state==$al['state']) echo "Selected";?>><?echo $al['state'];?></option>
                                    <?}
                                ?>
                            </select>
                        </td>
                    </tr>
                </table>
                <div class="col-sm-12">
                    <div class="form-group">
                        <?
                            if($f==0){?>
                                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                            <?}
                            else{?>
                                <input type="submit" name="update" class="btn btn-primary" value="Update">
                            <?}
                        ?>
                    </div>
                </div>
            </form>
            <?
                if(isset($_POST['submit']))
                {
                    extract($_POST);
                    $sql="insert into com_pt values ('','$pt_salleryfrom','$pt_salleryto','$ee_share','$er_share','$state','$clientid')";
                    $con->query($sql);

                    $sql="select max(pt_id) from com_pt where client_id='$clientid'";
                    $res=$con->query($sql);
                    $row=mysqli_fetch_array($res);
                    $id=$row[0];


                    foreach($allowance as $key)
                    {
                        $sql="insert into com_pt_allowance values ('','$id','$key','$clientid')";
                        $con->query($sql);
                    }
                    echo "<script>window.location.href='setting_pt?f=0';</script>";
                }

                if(isset($_POST['update']))
                {
                    extract($_POST);
                    $sql="update com_pt set sallery='$pt_salleryfrom',sallery_to='$pt_salleryto',ee_share='$ee_share',er_share='$er_share',state='$state' where pt_id='$pid'";
                    $con->query($sql);

                    $sql="delete from com_pt_allowance where pt_id='$pid'";
                    $res=$con->query($sql);

                    foreach($allowance as $key)
                    {
                        $sql="insert into com_pt_allowance values ('','$pid','$key','$clientid')";
                        $con->query($sql);
                    }
                    echo "<script>window.location.href='setting_pt?f=0';</script>";
                }
            ?>
        </div>
        <div class="clear"></div>
    </div><br>

    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="col-sm-8 col-xs-12 pad0">
                <div class="headding">PT Setting List</div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="col-sm-12 pad15">
            <table id="example" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Allowance</th>
                        <th>Salary From</th>
                        <th>To</th>
                        <th>EE Share</th>
                        <th>ER Share</th>
                        <th>State</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?
                        $sql="SELECT * FROM com_pt where client_id='$clientid' order by(pt_id) asc";
                        $res=$con->query($sql); $i=0;
                        while($row=mysqli_fetch_array($res))
                        {   $id=$row['pt_id']; ++$i;
                        ?>
                            <tr>
                                <td><?echo $i;?></td>
                                <td>
                                    <?
                                        $alt=$con->query("Select * from com_pt_allowance where pt_id='$id'");
                                        while($al=mysqli_fetch_array($alt))
                                        {
                                            echo $al['pt_allowance'].", ";
                                        }
                                    ?>
                                </td>
                                <td><?echo $row['sallery'];?></td>
                                <td><?echo $row['sallery_to'];?></td>
                                <td><?echo $row['ee_share'];?></td>
                                <td><?echo $row['er_share'];?></td>
                                <td><?echo $row['state'];?></td>
                                <td align="center">
                                    <a href="setting_pt?f=<?echo $id;?>"><i class="fa fa-edit"></i></a>
                                    <a href="#" onclick='JSconfirm(<?php echo $id;?>)'><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?}
                    ?>
                </tbody>
            </table>
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
        window.location = "delete.php?id="+delid+"&&tname=com_pt";   
    } 
    else {     
        swal("Record Not Deleted.");   
        } });
}
</script>


<?include('extra/footer.php');?>