<?include('extra/top.php');?>

<?include('extra/sidemenu.php');?>

<?
    $f=$_REQUEST['f'];
    $sallary="";
    $sallary_to="";
    $month="";
    $bonus="";
    if($f!=0)
    {
        $sql="SELECT * FROM com_bonus where bid='$f'";
        $res=$con->query($sql);
        $row=mysqli_fetch_array($res);

        $bid=$row['bid'];
        $sallary=$row['sallery'];
        $sallary_to=$row['sallery_to'];
        $month=$row['month'];
        $bonus=$row['bonus'];
    }
?>

<div class="main">
    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="col-sm-6 pad0">
                <div class="headding">Bonus Setting</div>
            </div>  
            <div class="col-sm-6 text-right pad0">
                <a href="setting_bonus?f=0" class="batt btn">Add New</a>
                <a href="create_company" class="batt btn">Back</a>
            </div>
        </div>
        <div class="col-sm-12 pad15">
            <form class="form" role="form" method="post">
                <table class="table table-bordered">
                    <tr>
                        <th>Select Allowance</th>
                        <th>Salary</th>
                        <th>Salary To</th>
                        <th>Period</th>
                        <th>Period To</th>
                        <th width="100">Due Month</th>
                        <th>Bonus %</th>
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
                                            $s="select * from com_bonus_allowance where b_allowance='$alw' and bid='$bid'";
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
                        <td><input type="text" name="bo_sallery" class="form-control" value="<?echo $sallary;?>"></td>
                        <td><input type="text" name="bo_sallery_to" class="form-control" value="<?echo $sallary_to;?>"></td>
                        <td><input type="text" name="period" class="form-control" value="Apr" readonly></td>
                        <td><input type="text" name="period_to" class="form-control" value="Mar" readonly></td>
                        <td>
                            <select name="bo_type" class="form-control">
                                <option value="">--</option>
                                <option value="03" <?if($month=="03") echo "selected";?>>Mar</option>
                                <option value="04" <?if($month=="04") echo "selected";?>>Apr</option>
                                <option value="05" <?if($month=="05") echo "selected";?>>May</option>
                                <option value="06" <?if($month=="06") echo "selected";?>>Jun</option>
                                <option value="07" <?if($month=="07") echo "selected";?>>Jul</option>
                                <option value="08" <?if($month=="08") echo "selected";?>>Aug</option>
                                <option value="09" <?if($month=="09") echo "selected";?>>Sep</option>
                                <option value="10" <?if($month=="10") echo "selected";?>>Oct</option>
                                <option value="11" <?if($month=="11") echo "selected";?>>Nov</option>
                                <option value="12" <?if($month=="12") echo "selected";?>>Dec</option>
                            </select>
                        </td>
                        <td><input type="text" name="bonus" class="form-control" value="<?echo $bonus;?>"></td>
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
                    $sql="insert into com_bonus values ('','$bo_sallery','$bo_sallery_to','$bo_type','$bonus','$clientid')";
                    $con->query($sql);

                    $sql="select max(bid) from com_bonus where client_id='$clientid'";
                    $res=$con->query($sql);
                    $row=mysqli_fetch_array($res);
                    $id=$row[0];


                    foreach($allowance as $key)
                    {
                        $sql="insert into com_bonus_allowance values ('','$id','$key','$clientid')";
                        $con->query($sql);
                    }
                    echo "<script>window.location.href='setting_bonus?f=0';</script>";
                }

                if(isset($_POST['update']))
                {
                    extract($_POST);
                    $sql="update com_bonus set sallery='$bo_sallery',sallery_to='$bo_sallery_to',month='$bo_type',bonus='$bonus' where bid='$bid'";
                    $con->query($sql);

                    $sql="delete from com_bonus_allowance where bid='$bid'";
                    $res=$con->query($sql);

                    foreach($allowance as $key)
                    {
                        $sql="insert into com_bonus_allowance values ('','$bid','$key','$clientid')";
                        $con->query($sql);
                    }
                    echo "<script>window.location.href='setting_bonus?f=0';</script>";
                }
            ?>
        </div>
        <div class="clear"></div>
    </div><br>

    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="col-sm-8 col-xs-12 pad0">
                <div class="headding">PF Setting List</div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="col-sm-12 pad15">
            <table id="example" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Allowance</th>
                        <th>Salary</th>
                        <th>Salary To</th>
                        <th>Period</th>
                        <th>Period To</th>
                        <th>Month</th>
                        <th>Bonus %</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?
                        $sql="SELECT * FROM com_bonus where client_id='$clientid' order by(bid) asc";
                        $res=$con->query($sql); $i=0;
                        while($row=mysqli_fetch_array($res))
                        {   $id=$row['bid']; ++$i;
                        ?>
                            <tr>
                                <td><?echo $i;?></td>
                                <td>
                                    <?
                                        $alt=$con->query("Select * from com_bonus_allowance where bid='$id'");
                                        while($al=mysqli_fetch_array($alt))
                                        {
                                            echo $al['b_allowance'].", ";
                                        }
                                        $m=$row['month'];
                                        $ym=date("Y")."-".$m;
                                    ?>
                                </td>
                                <td><?echo $row['sallery'];?></td>
                                <td><?echo $row['sallery_to'];?></td>
                                <td>Apr</td>
                                <td>Mar</td>
                                <td><?echo date("M",strtotime($ym));?></td>
                                <td><?echo $row['bonus'];?></td>
                                <td align="center">
                                    <a href="setting_bonus?f=<?echo $id;?>"><i class="fa fa-edit"></i></a>
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
        window.location = "delete.php?id="+delid+"&&tname=com_bonus";   
    } 
    else {     
        swal("Record Not Deleted.");   
        } });
}
</script>


<?include('extra/footer.php');?>