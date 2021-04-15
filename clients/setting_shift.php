<?include('extra/top.php');?>

<?include('extra/sidemenu.php');?>

<div class="main">
    <?
        $sql="SELECT * FROM com_shift where client_id='$clientid'";
        $res=$con->query($sql);
        $row=mysqli_fetch_array($res);
        $id=$row['csid'];
        if(!$row)
        {?>
            <div class="page_details">
                <div class="col-sm-12 pad15_line">
                    <div class="col-sm-6 pad0">
                        <div class="headding">Shift Setting</div>
                    </div>  
                    <div class="col-sm-6 text-right pad0">
                        <a href="create_company" class="batt btn">Back</a>
                    </div>
                </div>
                <div class="col-sm-6 pad15">
                    <form class="form" role="form" method="post">
                        <table class="table table-bordered">
                            <tr style="font-weight: bold;">
                                <td>Shift Hrs.</td>
                                <td>Half Day Hrs.</td>
                            </tr>
                            <tr>
                                <td><input type="text" name="hour" class="form-control" placeholder="00:00"></td>
                                <td><input type="text" name="half" class="form-control" placeholder="00:00"></td>
                            </tr>
                        </table>
                        <div class="col-sm-12 pad0">
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                            </div>
                        </div>
                    </form>
                    <?
                        if(isset($_POST['submit']))
                        {
                            extract($_POST);
                            $sql="insert into com_shift values('','$hour','$half','$clientid')";
                            $con->query($sql);
                            echo "<script>window.location.href='setting_shift';</script>";
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
                        <div class="headding">Shift Setting</div>
                    </div>  
                    <div class="col-sm-6 text-right pad0">
                        <a href="create_company" class="batt btn">Back</a>
                    </div>
                </div>
                <div class="col-sm-6 pad15">
                    <form class="form" role="form" method="post">
                        <table class="table table-bordered">
                            <tr style="font-weight: bold;">
                                <td>Shift Hrs.</td>
                                <td>Half Day Hrs.</td>
                            </tr>
                            <tr>
                                <td><input type="text" name="hour" class="form-control" value="<?echo $row['hour'];?>"></td>
                                <td><input type="text" name="half" class="form-control" value="<?echo $row['half'];?>"></td>
                            </tr>
                        </table>
                        <div class="col-sm-12 pad0">
                            <div class="form-group">
                                <input type="submit" name="update" class="btn btn-primary" value="Update">
                                <a href="#" onclick='JSconfirm(<?php echo $id;?>)' class="batt btn pull-right"><i class="fa fa-trash" style="color: #FFF;"></i> Remove Shift</a>
                            </div>
                        </div>
                    </form>
                    <?
                        if(isset($_POST['update']))
                        {
                            extract($_POST);
                            $sql="update com_shift set hour='$hour',half='$half' where csid='$id'";
                            $con->query($sql);
                            echo "<script>window.location.href='setting_shift';</script>";
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
        window.location = "delete.php?id="+delid+"&&tname=com_shift";   
    } 
    else {     
        swal("Record Not Deleted.");   
        } });
}
</script>


<?include('extra/footer.php');?>