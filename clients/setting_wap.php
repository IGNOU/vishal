<?include('extra/top.php');?>

<?include('extra/sidemenu.php');?>

<div class="main">
    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="col-sm-6 pad0">
                <div class="headding">WAP Setting</div>
            </div>  
            <div class="col-sm-6 text-right pad0">
                <a href="create_company" class="batt btn">Back</a>
            </div>
        </div>
        <div class="col-sm-12 pad15">
            <form class="form" role="form" method="post">
                <table class="table table-bordered">
                   <tr>
                       <th>WAP Machine</th>
                       <th>IP Address</th>
                   </tr>
                   <tr>
                       <td><input type="text" class="form-control" name="machine"></td>
                       <td><input type="text" class="form-control" name="ipaddress"></td>
                   </tr>
                </table>
                <div class="col-sm-12 pad0">
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                    </div>
                </div>
            </form>
            <?
                if(isset($_POST['submit']))
                {
                    extract($_POST);
                    $sql="insert into com_wap values('','$machine','$ipaddress','$clientid')";
                    $con->query($sql);
                    echo "<script>window.location.href='setting_wap';</script>";
                }
            ?>
        </div>
        <div class="clear"></div>
    </div><br>

    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="col-sm-6 pad0">
                <div class="headding">Wap Setting List</div>
            </div>
        </div>
        <div class="col-sm-12 pad15">
            <table id="example" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th>Branch</th>
                        <th>IP Address</th>
                        <th align="center" width="100">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?
                        $sql="SELECT * FROM com_wap where client_id=$clientid order by(wid) asc";
                        $res=$con->query($sql); $i=1;
                        while($row=mysqli_fetch_array($res))
                        {   $id=$row['wid'];
                        ?>
                            <tr>
                                <td><?echo $i++;?></td>
                                <td><?echo $row['machine'];?></td>
                                <td><?echo $row['ipaddress'];?></td>
                                <td align="center">
                                    <a href=""><i class="fa fa-edit"></i></a>
                                    <a href="#" onclick='JSconfirm(<?php echo $id;?>)'><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?}
                    ?>
                </tfoot>
            </table>
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
        window.location = "delete.php?id="+delid+"&&tname=com_wap";   
    } 
    else {     
        swal("Record Not Deleted.");   
        } });
}
</script>


<?include('extra/footer.php');?>