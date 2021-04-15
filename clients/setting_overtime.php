<?include('extra/top.php');?>

<?include('extra/sidemenu.php');?>

<div class="main">
    <?
        $sql="SELECT * FROM com_overtime where client_id='$clientid'";
        $res=$con->query($sql);
        $row=mysqli_fetch_array($res);
        $id=$row['ov_id'];
        if(!$row)
        {?>
            <div class="page_details">
                <div class="col-sm-12 pad15_line">
                    <div class="col-sm-6 pad0">
                        <div class="headding">Over Time Setting</div>
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
                                <th>Calculation On</th>
                                <th>Multiple</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="allowance[]" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" multiple>
                                        <?
                                            $sql="select * from allowance where client_id='$clientid' order by allowance asc";
                                            $res=$con->query($sql);
                                            while($al=mysqli_fetch_array($res))
                                                echo "<option>".$al['allowance']."</option>";
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <select name="ov_cal" class="form-control">
                                        <option>--</option>
                                        <option>30 Days</option>
                                        <option>Monthly</option>
                                    </select>
                                </td>
                                <td><input type="text" name="ov_multi" class="form-control"></td>
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
                            $sql="insert into com_overtime values ('','$ov_cal','$ov_multi','$clientid')";
                            $con->query($sql);

                            $sql="select max(ov_id) from com_overtime where client_id='$clientid'";
                            $res=$con->query($sql);
                            $row=mysqli_fetch_array($res);
                            $id=$row[0];


                            foreach($allowance as $key)
                            {
                                $sql="insert into com_overtime_allowance values ('','$id','$key','$clientid')";
                                $con->query($sql);
                            }
                            echo "<script>window.location.href='setting_overtime';</script>";
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
                        <div class="headding">Over Time Setting</div>
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
                                <th>Calculation On</th>
                                <th>Multiple</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="allowance[]" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" multiple>
                                        <?
                                            $sql="select * from allowance where client_id='$clientid' order by allowance asc";
                                            $res=$con->query($sql);
                                            while($al=mysqli_fetch_array($res))
                                            {
                                                $alw=$al['allowance'];
                                                $s="select * from com_overtime_allowance where ov_allowance='$alw' and client_id='$clientid'";
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
                                <td>
                                    <select name="ov_cal" class="form-control">
                                        <option>--</option>
                                        <option <?if($row['calculation']=="30 Days") echo "Selected";?>>30 Days</option>
                                        <option <?if($row['calculation']=="Monthly") echo "Selected";?>>Monthly</option>
                                    </select>
                                </td>
                                <td><input type="text" name="ov_multi" class="form-control" value="<?echo $row['multiple'];?>"></td>
                            </tr>
                        </table>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-primary" value="Update">
                                <a href="#" onclick='JSconfirm(<?php echo $id;?>)' class="batt btn pull-right"><i class="fa fa-trash" style="color: #FFF;"></i> Remove Over Time</a>
                            </div>
                        </div>
                    </form>
                    <?
                        if(isset($_POST['submit']))
                        {
                            extract($_POST);
                            $sql="update com_overtime set calculation='$ov_cal',multiple='$ov_multi' where ov_id='$id'";
                            $con->query($sql);

                            $sql="delete from com_overtime_allowance where ov_id='$id'";
                            $res=$con->query($sql);

                            foreach($allowance as $key)
                            {
                                $sql="insert into com_overtime_allowance values ('','$id','$key','$clientid')";
                                $con->query($sql);
                            }
                            echo "<script>window.location.href='setting_overtime';</script>";
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
        window.location = "delete.php?id="+delid+"&&tname=com_overtime";   
    } 
    else {     
        swal("Record Not Deleted.");   
        } });
}
</script>


<?include('extra/footer.php');?>