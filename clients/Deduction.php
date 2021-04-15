
<?include('extra/top.php');?>

<?include('extra/sidemenu.php');?>

<div class="main">
    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="col-sm-6 pad0">
                <div class="headding">Add Deduction</div>
            </div>  
        </div>
        <div class="col-sm-12 pad15">
            <form method="POST" class="form" enctype="multipart/form-data">
                <div class="col-sm-12 pad0">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Deduction Name *</label>
                            <input type="text" name="name" class="form-control" required>
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

                    $sql="insert into deduction values('','$name','$clientid')";
                    $con->query($sql);
                    echo "<script>window.location.href='Deduction';</script>";
                }
            ?>
        </div>
        <div class="clear"></div>
    </div><br>

    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="col-sm-8 col-xs-12 pad0">
                <div class="headding">Deduction List</div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="col-sm-12 pad15">
            <table id="example" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td width="100">#</td>
                        <td>Name</td>
                        <td width="100" align="center">Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?
                        $sql="SELECT * FROM deduction where client_id='$clientid' order by(did) asc";
                        $res=$con->query($sql); $i=0;
                        while($row=mysqli_fetch_array($res))
                        {   $id=$row['did']; ++$i;
                        ?>
                            <tr>
                                <td><?echo $i;?></td>
                                <td><?echo $row['deduction'];?></td>
                                <td align="center">
                                    <a href=""><i class="fa fa-edit"></i></a>
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
        window.location = "delete.php?id="+delid+"&&tname=Allowance";   
    } 
    else {     
        swal("Record Not Deleted.");   
        } });
}
</script>


<?include('extra/footer.php');?>