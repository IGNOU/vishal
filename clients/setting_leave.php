<?include('extra/top.php');?>

<?include('extra/sidemenu.php');?>

<div class="main">
    <?
        $sql="SELECT * FROM com_leave where client_id='$clientid'";
        $res=$con->query($sql);
        $row=mysqli_fetch_array($res);
        $id=$row['lid'];
        if(!$row)
        {?>
            <div class="page_details">
                <div class="col-sm-12 pad15_line">
                    <div class="col-sm-6 pad0">
                        <div class="headding">Leave Setting</div>
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
                                <th>Month</th>
                                <th>Calculation</th>
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
                                    <select name="month" class="form-control">
                                        <option value="">--</option>
                                        <option value="01">Jan</option>
                                        <option value="02">Feb</option>
                                        <option value="03">Mar</option>
                                        <option value="04">Apr</option>
                                        <option value="05">May</option>
                                        <option value="06">Jun</option>
                                        <option value="07">Jul</option>
                                        <option value="08">Agu</option>
                                        <option value="09">Sep</option>
                                        <option value="10">Oct</option>
                                        <option value="11">Nov</option>
                                        <option value="12">Dev</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="ov_cal" class="form-control">
                                        <option>--</option>
                                        <option>30 Days</option>
                                        <option>Monthly</option>
                                    </select>
                                </td>
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
                            $sql="insert into com_leave values ('','$month','$ov_cal','$clientid')";
                            $con->query($sql);

                            $sql="select max(lid) from com_leave where client_id='$clientid'";
                            $res=$con->query($sql);
                            $row=mysqli_fetch_array($res);
                            $id=$row[0];

                            foreach($allowance as $key)
                            {
                                $sql="insert into com_leave_allowance values ('','$id','$key','$clientid')";
                                $con->query($sql);
                            }
                            echo "<script>window.location.href='setting_leave';</script>";
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
                        <div class="headding">Leave Setting</div>
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
                                <th>Month</th>
                                <th>Calculation</th>
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
                                                $s="select * from com_leave_allowance where l_alw='$alw' and client_id='$clientid'";
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
                                    <select name="month" class="form-control">
                                        <option value="">--</option>
                                        <option value="01"<?if($row['month']=="01") echo "Selected";?>>Jan</option>
                                        <option value="02"<?if($row['month']=="02") echo "Selected";?>>Feb</option>
                                        <option value="03"<?if($row['month']=="03") echo "Selected";?>>Mar</option>
                                        <option value="04"<?if($row['month']=="04") echo "Selected";?>>Apr</option>
                                        <option value="05"<?if($row['month']=="05") echo "Selected";?>>May</option>
                                        <option value="06"<?if($row['month']=="06") echo "Selected";?>>Jun</option>
                                        <option value="07"<?if($row['month']=="07") echo "Selected";?>>Jul</option>
                                        <option value="08"<?if($row['month']=="08") echo "Selected";?>>Agu</option>
                                        <option value="09"<?if($row['month']=="09") echo "Selected";?>>Sep</option>
                                        <option value="10"<?if($row['month']=="10") echo "Selected";?>>Oct</option>
                                        <option value="11"<?if($row['month']=="11") echo "Selected";?>>Nov</option>
                                        <option value="12"<?if($row['month']=="12") echo "Selected";?>>Dev</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="ov_cal" class="form-control">
                                        <option>--</option>
                                        <option <?if($row['calculation']=="30 Days") echo "Selected";?>>30 Days</option>
                                        <option <?if($row['calculation']=="Monthly") echo "Selected";?>>Monthly</option>
                                    </select>
                                </td>
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
                            $sql="update com_leave set calculation='$ov_cal',month='$month' where lid='$id'";
                            $con->query($sql);

                            $sql="delete from com_leave_allowance where l_id='$id'";
                            $res=$con->query($sql);

                            foreach($allowance as $key)
                            {
                                $sql="insert into com_leave_allowance values ('','$id','$key','$clientid')";
                                $con->query($sql);
                            }
                            echo "<script>window.location.href='setting_leave';</script>";
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
        window.location = "delete.php?id="+delid+"&&tname=com_leave";   
    } 
    else {     
        swal("Record Not Deleted.");   
        } });
}
</script>


<?include('extra/footer.php');?>