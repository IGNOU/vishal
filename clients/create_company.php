
<?include('extra/top.php');?>

<?include('extra/sidemenu.php');?>

<style type="text/css">
    .batt{
        margin-bottom: 5px;
    }
</style>

<div class="main">
    <?
        $sql="SELECT * FROM company where client_id='$clientid'";
        $res=$con->query($sql); $i=0;
        $row=mysqli_fetch_array($res);
        $id=$row['cmid'];
        if(!$row)
        { ?>
            <div class="page_details">
                <div class="col-sm-12 pad15_line">
                    <div class="col-sm-6 pad0">
                        <div class="headding">Add Company Details</div>
                    </div>  
                </div>
                <div class="col-sm-12 pad15">
                    <form method="POST" class="form" enctype="multipart/form-data">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Company Name *</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Email ID *</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Mobile *</label>
                                <input type="text" name="mobile" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>GST Number</label>
                                <input type="text" name="gst" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>PAN</label>
                                <input type="text" name="pan" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>CIN</label>
                                <input type="text" name="cin" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>PF Code</label>
                                <input type="text" name="pf" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>ESI Code</label>
                                <input type="text" name="esi" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>LWF Number</label>
                                <input type="text" name="lwf" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>PT Number</label>
                                <input type="text" name="pt" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Bank Name</label>
                                <input type="text" name="bank" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>IFSC Code</label>
                                <input type="text" name="ifsc" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Bank A/c</label>
                                <input type="text" name="account" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Branch</label>
                                <input type="text" name="branch" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Logo</label>
                                <input type="file" name="logo" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <img id="output_image" width="auto" height="150">
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
                            // INSERT INTO `company`(`cmid`, `name`, `email`, `mobile`, `gst`, `pan`, `cin`, `pf`, `esi`, `lwf`, `pt`, `bank`, `ifsc`, `account`, `branch`, `logo`, `address`)

                            if($_FILES['logo']['name']=="")
                                $img="";
                            else
                            {
                                $img=rand().$_FILES['logo']['name'];
                                move_uploaded_file($_FILES['logo']['tmp_name'], "img/".$img);
                            }
                            $sql="insert into company values('','$name','$email','$mobile','$gst','$pan','$cin','$pf','$esi','$lwf','$pt','$bank','$ifsc','$account','$branch','$img','$address','$clientid','Active')";
                            $con->query($sql);
                            echo "<script>window.location.href='create_company';</script>";
                        }
                    ?>
                </div>
                <div class="clear"></div>
            </div>
        <?
        }
        else
        {?>
            <div class="page_details" style="background: none; border: none;">
                <div class="col-sm-8 pad0" style="background: #FFF; border: 1px solid #ddd;">
                    <div class="col-sm-12 pad15_line">
                        <div class="col-sm-6 pad0">
                            <div class="headding">Company Details</div>
                        </div>  
                    </div>
                    <div class="col-sm-12 pad15">
                        <table class="table">
                            <tr>
                                <td>Name</td>
                                <td colspan="2"><?echo $row['name'];?></td>
                                <td rowspan="4"><img src="img/<?echo $row['logo'];?>" width="auto" height="100"></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td colspan="2"><?echo $row['email'];?></td>
                            </tr>
                            <tr>
                                <td>Mobile</td>
                                <td colspan="2"><?echo $row['mobile'];?></td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td colspan="2"><?echo $row['address'];?></td>
                            </tr>
                            <tr>
                                <td>GST</td>
                                <td><?echo $row['gst'];?></td>
                                <td>Pan Card</td>
                                <td><?echo $row['pan'];?></td>
                            </tr>
                            <tr>
                                <td>CIN</td>
                                <td><?echo $row['cin'];?></td>
                                <td>PF Code</td>
                                <td><?echo $row['pf'];?></td>
                            </tr>
                            <tr>
                                <td>ESI Code</td>
                                <td><?echo $row['esi'];?></td>
                                <td>LWF No.</td>
                                <td><?echo $row['lwf'];?></td>
                            </tr>
                            <tr>
                                <td>PT No.</td>
                                <td><?echo $row['pt'];?></td>
                                <td>Bank Name</td>
                                <td><?echo $row['bank'];?></td>
                            </tr>
                            <tr>
                                <td>Bank A/C</td>
                                <td><?echo $row['account'];?></td>
                                <td>IFSC</td>
                                <td><?echo $row['ifsc'];?></td>
                            </tr>
                            <tr>
                                <td>Branch</td>
                                <td colspan="3"><?echo $row['branch'];?></td>
                            </tr>
                        </table>

                        <a href="company_edit" class="btn batt"><i class="fa fa-pencil" style="color: #FFF;"></i> Edit Company</a>
                        <!-- <a href="#" onclick='JSconfirm(<?php echo $id;?>)' class="btn batt pull-right"><i class="fa fa-trash" style="color: #FFF;"></i> Remove Company</a> -->

                    </div>
                </div>
                <div class="col-sm-4" style="padding-right: 0px;">
                    <div style="background: #FFF; padding-right: 0px; border: 1px solid #ddd;">
                        <div class="col-sm-12 pad15_line">
                            <div class="col-sm-6 pad0">
                                <div class="headding">Settings</div>
                            </div>  
                        </div>
                        <div class="col-sm-12 pad15 con_setting">
                            <div class="col-sm-6 pad0">
                                <a href="setting_pf" class="batt btn">PF</a>
                                <a href="setting_esi" class="batt btn">ESI</a>
                                <a href="setting_lwf?f=0" class="batt btn">LWF</a>
                                <a href="setting_pt?f=0" class="batt btn">PT</a>
                                <a href="setting_overtime" class="batt btn">Over Time</a>
                                <a href="setting_bonus?f=0" class="batt btn">Bonus</a>
                                <a href="setting_gratuti" class="batt btn">Gratuity</a>
                                <a href="appointment" class="batt btn">Appointment Letter</a>
                            </div>
                            <div class="col-sm-6">
                                <a href="setting_incometax" class="batt btn">Income Tax</a>
                                <a href="setting_abs" class="batt btn">Auto Birthday</a>
                                <a href="setting_notice" class="batt btn">Notice</a>
                                <a href="setting_wap" class="batt btn">WAP / Biometric</a>
                                <a href="setting_week" class="batt btn">Week Off</a>
                                <a href="setting_shift" class="batt btn">Shift</a>
                                <a href="setting_leave" class="batt btn">Leave</a>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        <?}
    ?>                
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
        window.location = "delete.php?id="+delid+"&&tname=company";   
    } 
    else {     
        swal("Record Not Deleted.");   
        } });
}
</script>


<?include('extra/footer.php');?>