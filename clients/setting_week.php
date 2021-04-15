<?include('extra/top.php');?>

<?include('extra/sidemenu.php');?>

<?
    $sql="SELECT * FROM com_week where client_id='$clientid'";
    $res=$con->query($sql); 
    $row=mysqli_fetch_array($res);
    $day=$row['day'];
?>

<div class="main">
    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="col-sm-6 pad0">
                <div class="headding">Week Setting</div>
            </div>  
            <div class="col-sm-6 text-right pad0">
                <a href="create_company" class="batt btn">Back</a>
            </div>
        </div>
        <div class="col-sm-6 pad15">
            <form class="form" role="form" method="post">
                <table class="table table-bordered">
                    <tr>
                        <th>Select Day *</th>
                        <td>
                            <select name="day" class="form-control" required>
                                <option value="">--</option>
                                <option value="Sun" <?if($day=="Sun") echo "Selected";?>>Sunday</option>
                                <option value="Mon" <?if($day=="Mon") echo "Selected";?>>Monday</option>
                                <option value="Tue" <?if($day=="Tue") echo "Selected";?>>Tuesday</option>
                                <option value="Wed" <?if($day=="Wed") echo "Selected";?>>Wednesday</option>
                                <option value="Thu" <?if($day=="Thu") echo "Selected";?>>Thursday</option>
                                <option value="Fri" <?if($day=="Fri") echo "Selected";?>>Friday</option>
                                <option value="Sat" <?if($day=="Sat") echo "Selected";?>>Saturday</option>
                                <option <?if($day=="Mannual") echo "Selected";?>>Mannual</option>
                            </select>
                        </td>
                    </tr>
                   
                </table>
                <div class="col-sm-12 pad0">
                    <div class="form-group">
                        <?
                            if($row!="")
                            {?>
                                <input type="submit" class="btn btn-primary" name="update" value="Update">
                                <a href="#" onclick='JSconfirm(<?php echo $clientid;?>)' class="batt btn pull-right"><i class="fa fa-trash" style="color: #FFF;"></i> Remove</a>
                            <?}
                            else
                            {?>
                                <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                            <?}
                        ?> 
                    </div>
                </div>
            </form>
            <?
                if(isset($_POST['submit']))
                {
                    extract($_POST);
                    $sql="insert into com_week values('','$day','$clientid')";
                    $con->query($sql);
                    echo "<script>window.location.href='setting_week';</script>";
                }

                if(isset($_POST['update']))
                {
                    extract($_POST);
                    $sql="update com_week set day='$day' where client_id='$clientid'";
                    $con->query($sql);
                    echo "<script>window.location.href='setting_week';</script>";
                }
            ?>
        </div>
        <div class="clear"></div>
    </div>
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
        window.location = "delete.php?id="+delid+"&&tname=com_week";   
    } 
    else {     
        swal("Record Not Deleted.");   
        } });
}
</script>


<?include('extra/footer.php');?>