
<?php include('extra/top.php');?>

<?php include('extra/sidemenu.php');?>

<div class="main">
    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="col-sm-6 pad0">
                <div class="headding">Add Plan</div>
            </div>  
        </div>
        <div class="col-sm-12 pad15">
            <form method="POST" class="form" enctype="multipart/form-data">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Plan Name *</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Validity ( In Month ) *</label>
                        <input type="text" name="validity" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Price *</label>
                        <input type="text" name="price" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Emp Limit *</label>
                        <input type="text" name="limit" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-12 form-group">
                    <label for="name">Details</label>
                    <textarea name="details" class="form-control" id="myTextarea"></textarea>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                    </div>
                </div>
            </form>
            <?php 
                if(isset($_POST['submit']))
                {
                    extract($_POST);

                    $sql="insert into plan values('','$name','$validity','$price','$limit','$details')";
                    $con->query($sql);
                    echo "<script>window.location.href='Plan';</script>";
                }
            ?>
        </div>
        <div class="clear"></div>
    </div><br>

    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="col-sm-8 col-xs-12 pad0">
                <div class="headding">Plan List</div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="col-sm-12 pad15">
            <table id="example" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td width="100">#</td>
                        <td>Plan</td>
                        <td>Validity</td>
                        <td>Price</td>
                        <td>Emp Lilit</td>
                        <td width="100" align="center">Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $sql="SELECT * FROM plan order by(pid) asc";
                        $res=$con->query($sql); $i=0;
                        while($row=mysqli_fetch_array($res))
                        {   $id=$row['pid']; ++$i;
                        ?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?php echo $row['plan'];?></td>
                                <td><?php echo $row['validity'];?> Months</td>
                                <td><?php echo $row['price'];?></td>
                                <td><?php echo $row['emp_limit'];?></td>
                                <td align="center">
                                    <a href="#" onclick='JSconfirm(<?php php echo $id;?>)'><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="clear"></div>
    </div><br>
</div>

	




<script src="tinymce/tinymce.js"></script>
<script type="text/javascript">
    tinymce.init({
        selector: '#myTextarea',
        height: 200,
        theme: 'modern',
        plugins: [
          'advlist autolink lists link image charmap print preview hr anchor pagebreak',
          'searchreplace wordcount visualblocks visualchars code fullscreen',
          'insertdatetime media nonbreaking save table contextmenu directionality',
          'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true
    });
</script>

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
        window.location = "delete.php?id="+delid+"&&tname=plan";   
    } 
    else {     
        swal("Record Not Deleted.");   
        } });
}
</script>


<?php include('extra/footer.php');?>