
<?include('extra/top.php');?>

<?include('extra/sidemenu.php');?>
<?
    $row=mysqli_fetch_array($con->query("SELECT * FROM company where client_id='$clientid'"));
?>
<div class="main">
    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="col-sm-6 pad0">
                <div class="headding">Edit Company Details</div>
            </div>  
        </div>
        <div class="col-sm-12 pad15">
            <form method="POST" class="form" enctype="multipart/form-data">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Company Name *</label>
                        <input type="text" name="name" class="form-control" required value="<?echo $row['name'];?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Email ID *</label>
                        <input type="email" name="email" class="form-control" required value="<?echo $row['email'];?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Mobile *</label>
                        <input type="text" name="mobile" class="form-control" required value="<?echo $row['mobile'];?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>GST Number</label>
                        <input type="text" name="gst" class="form-control" value="<?echo $row['gst'];?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>PAN</label>
                        <input type="text" name="pan" class="form-control" value="<?echo $row['pan'];?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>CIN</label>
                        <input type="text" name="cin" class="form-control" value="<?echo $row['cin'];?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>PF Code</label>
                        <input type="text" name="pf" class="form-control" value="<?echo $row['pf'];?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>ESI Code</label>
                        <input type="text" name="esi" class="form-control" value="<?echo $row['esi'];?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>LWF Number</label>
                        <input type="text" name="lwf" class="form-control" value="<?echo $row['lwf'];?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>PT Number</label>
                        <input type="text" name="pt" class="form-control" value="<?echo $row['pt'];?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Bank Name</label>
                        <input type="text" name="bank" class="form-control" value="<?echo $row['bank'];?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>IFSC Code</label>
                        <input type="text" name="ifsc" class="form-control" value="<?echo $row['ifsc'];?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Bank A/c</label>
                        <input type="text" name="account" class="form-control" value="<?echo $row['account'];?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Branch</label>
                        <input type="text" name="branch" class="form-control" value="<?echo $row['branch'];?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Logo</label>
                        <input type="file" name="logo" class="form-control" onchange="preview_image(event)">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" value="<?echo $row['address'];?>">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <img src="img/<?echo $pic=$row['logo'];?>" id="output_image" width="auto" height="150">
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
                    
                    if($_FILES['logo']['name']=="")
                        $img=$pic;
                    else
                    {
                        $img=rand().$_FILES['logo']['name'];
                        move_uploaded_file($_FILES['logo']['tmp_name'], "img/".$img);
                        unlink("img/$pic");
                    }
                    $sql="update company set name='$name',email='$email',mobile='$mobile',gst='$gst',pan='$pan',cin='$cin',pf='$pf',esi='$esi',lwf='$lwf',pt='$pt',bank='$bank',ifsc='$ifsc',account='$account',branch='$branch',logo='$img',address='$address' where client_id='$clientid'";
                    $con->query($sql);
                    echo "<script>window.location.href='create_company';</script>";
                }
            ?>
        </div>
        <div class="clear"></div>
    </div>
</div>

	


<script type="text/javascript">
    function preview_image(event) 
    {
     var reader = new FileReader();
     reader.onload = function()
     {
      var output = document.getElementById('output_image');
      output.src = reader.result;
     }
     reader.readAsDataURL(event.target.files[0]);
    }
</script>




<?include('extra/footer.php');?>