<?include('extra/top.php');?>

<?include('extra/sidemenu.php');?>

<div class="main">
    <?
        $sql="SELECT * FROM com_esi where client_id='$clientid'";
        $res=$con->query($sql);
        $row=mysqli_fetch_array($res);
        $id=$row['esi_id'];
        if(!$row)
        {?>
            <div class="page_details">
                <div class="col-sm-12 pad15_line">
                    <div class="col-sm-6 pad0">
                        <div class="headding">ESI Setting</div>
                    </div>  
                    <div class="col-sm-6 text-right pad0">
                        <a href="create_company" class="batt btn">Back</a>
                    </div>
                </div>
                <div class="col-sm-12 pad15">
                    <form class="form" role="form" method="post">
                        <table class="table table-bordered">
                            <tr>
                                <th>Select Allowance</th>
                                <th>EE Share %</th>
                                <th>ER Share %</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="allowance[]" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" multiple="true">
                                        <?
                                            $sql="select * from allowance where client_id='$clientid' order by allowance asc";
                                            $res=$con->query($sql);
                                            while($al=mysqli_fetch_array($res))
                                                echo "<option>".$al['allowance']."</option>";
                                        ?>
                                    </select>
                                </td>
                                <td><input type="text" name="ee_share" class="form-control"></td>
                                <td><input type="text" name="er_share" class="form-control"></td>
                            </tr>
                        </table>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                            </div>
                        </div>
                    </form>
                    <?
                        if(isset($_POST['submit']))
                        {
                            extract($_POST);
                            $sql="insert into com_esi values ('','$ee_share','$er_share','$clientid')";
                            $con->query($sql);

                            $sql="select max(esi_id) from com_esi where client_id='$clientid'";
                            $res=$con->query($sql);
                            $row=mysqli_fetch_array($res);
                            $esi_id=$row[0];


                            foreach($allowance as $key)
                            {
                                $sql="insert into com_esi_allowance values ('','$esi_id','$key','$clientid')";
                                $con->query($sql);
                            }
                            echo "<script>window.location.href='setting_esi';</script>";
                        }
                    ?>
                </div>
                <div class="clear"></div>
            </div>
        <?}
        else
        {?>
            <div class="page_details">
                <div class="col-sm-12 pad15_line">
                    <div class="col-sm-6 pad0">
                        <div class="headding">ESI Setting</div>
                    </div>  
                    <div class="col-sm-6 text-right pad0">
                        <a href="create_company" class="batt btn">Back</a>
                    </div>
                </div>
                <div class="col-sm-12 pad15">
                    <form class="form" role="form" method="post">
                        <table class="table table-bordered">
                            <tr>
                                <th>Select Allowance</th>
                                <th>EE Share %</th>
                                <th>ER Share %</th>
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
                                                $s="select * from com_esi_allowance where esi_allowance='$alw' and client_id='$clientid'";
                                                $alt=mysqli_fetch_array($con->query($s));
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
                                <td><input type="text" name="ee_share" class="form-control" value="<?echo $row['ee_share'];?>"></td>
                                <td><input type="text" name="er_share" class="form-control" value="<?echo $row['er_share'];?>"></td>
                            </tr>
                        </table>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-primary" value="Update">
                                <a href="#" onclick='JSconfirm(<?php echo $id;?>)' class="batt btn pull-right"><i class="fa fa-trash" style="color: #FFF;"></i> Remove ESI</a>
                            </div>
                        </div>
                    </form>
                    <?
                        if(isset($_POST['submit']))
                        {
                            extract($_POST);
                            $sql="update com_esi set ee_share='$ee_share',er_share='$er_share'where esi_id='$id'";
                            $con->query($sql);

                            $sql="delete from com_esi_allowance where esi_id='$id'";
                            $res=$con->query($sql);

                            foreach($allowance as $key)
                            {
                                $sql="insert into com_esi_allowance values ('','$id','$key','$clientid')";
                                $con->query($sql);
                            }
                            echo "<script>window.location.href='setting_esi';</script>";
                        }
                    ?>
                </div>
                <div class="clear"></div>
            </div>
        <?}
    ?>
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
        window.location = "delete.php?id="+delid+"&&tname=com_esi";   
    } 
    else {     
        swal("Record Not Deleted.");   
        } });
}
</script>


<?include('extra/footer.php');?>