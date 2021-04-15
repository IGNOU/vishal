<?include('extra/top.php');?>

<?include('extra/sidemenu.php');?>

<div class="main">
    <?
        $sql="SELECT * FROM com_abm where client_id='$clientid'";
        $res=$con->query($sql);
        $row=mysqli_fetch_array($res);
        $id=$row['abmid'];
        if(!$row)
        {?>
            <div class="page_details">
                <div class="col-sm-12 pad15_line">
                    <div class="col-sm-6 pad0">
                        <div class="headding">Auto Birthday Mail Setting</div>
                    </div>  
                    <div class="col-sm-6 text-right pad0">
                        <a href="create_company" class="batt btn">Back</a>
                    </div>
                </div>
                <div class="col-sm-12 pad15">
                    <form class="form" role="form" method="post">
                        <div class="form-group">
                            <label>Details</label>
                            <textarea class="form-control" name="details"></textarea>
                        </div>
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

                            $del=htmlspecialchars($details,ENT_QUOTES);
                            $sql="insert into com_abm values ('','$del','$clientid')";
                            $con->query($sql);

                           echo "<script>window.location.href='setting_abs';</script>";
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
                        <div class="headding">Auto Birthday Mail Setting</div>
                    </div>  
                    <div class="col-sm-6 text-right pad0">
                        <a href="create_company" class="batt btn">Back</a>
                    </div>
                </div>
                <div class="col-sm-12 pad15">
                    <form class="form" role="form" method="post">
                        <div class="form-group">
                            <label>Details</label>
                            <textarea class="form-control" name="details"><?echo $row['details'];?></textarea>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="submit" name="update" class="btn btn-primary" value="Update">
                                <a href="#" onclick='JSconfirm(<?php echo $id;?>)' class="batt btn pull-right"><i class="fa fa-trash" style="color: #FFF;"></i> Remove ABM</a>
                            </div>
                        </div>
                    </form>
                    <?
                        if(isset($_POST['update']))
                        {
                            extract($_POST);

                            $del=htmlspecialchars($details,ENT_QUOTES);
                            $sql="update com_abm set details='$del' where abmid='$id'";
                            $con->query($sql);

                           echo "<script>window.location.href='setting_abs';</script>";
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
        window.location = "delete.php?id="+delid+"&&tname=com_abm";   
    } 
    else {     
        swal("Record Not Deleted.");   
        } });
}
</script>


<?include('extra/footer.php');?>