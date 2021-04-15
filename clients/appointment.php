
<?include('extra/top.php');?>

<?include('extra/sidemenu.php');?>

<?
    $sql="SELECT * FROM appointment_letter where client_id='$clientid'";
    $res=$con->query($sql); 
    $row=mysqli_fetch_array($res);
    $del=$row['details'];
?>

<div class="main">
    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="col-sm-6 pad0">
                <div class="headding">Appointment Letter</div>
            </div> 
            <div class="col-sm-6 text-right pad0">
                <a href="create_company" class="batt btn">Back</a>
            </div>
        </div>
        <div class="col-sm-12 pad15">
            <form method="POST" class="form" enctype="multipart/form-data">
                <div class="col-sm-12 pad0 form-group">
                    <label for="name">Details</label>
                    <textarea name="details" class="form-control" id="myTextarea"><?echo $del;?></textarea>
                </div>
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
                    $del=htmlspecialchars($details,ENT_QUOTES);
                    $sql="insert into appointment_letter values('','$del','$clientid')";
                    $con->query($sql);
                    echo "<script>window.location.href='appointment';</script>";
                }

                if(isset($_POST['update']))
                {
                    extract($_POST);
                    $del=htmlspecialchars($details,ENT_QUOTES);
                    $sql="update appointment_letter set details='$del' where client_id='$clientid'";
                    $con->query($sql);
                    echo "<script>window.location.href='appointment';</script>";
                }
            ?>
        </div>
        <div class="clear"></div>
    </div>
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
        window.location = "delete.php?id="+delid+"&&tname=appointment_letter";   
    } 
    else {     
        swal("Record Not Deleted.");   
        } });
}
</script>


<?include('extra/footer.php');?>