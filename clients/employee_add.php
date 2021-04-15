
<?include('extra/top.php');?>

<?include('extra/sidemenu.php');?>

<style>
  .switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 20px;
  }

  .switch input { 
    opacity: 0;
    width: 0;
    height: 0;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 18px;
    width: 18px;
    left: 4px;
    bottom: 1px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }

  input:checked + .slider {
    background-color: #2196F3;
  }

  input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }

  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  }
</style>

<div class="main">
    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="col-sm-6 pad0">
                <div class="headding">Add Employee</div>
            </div>  
        </div>
        <div class="col-sm-12 pad15">
            <form method="POST" class="form" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <div class="panel-heading">Employee Information</div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <td>Emp ID (As User ID) *</td>
                                <td>
                                    <input type="text" name="empcode" class="form-control" required>
                                </td>
                                <td></td>
                                <td></td>
                                <td rowspan="6">
                                    <img id="output_image" width="150" height="150"><br>
                                    <input type="file" name="pic" class="form-control" onchange="preview_image(event)">
                                </td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td><input type="text" name="name" class="form-control" required></td>
                                <td>Designation</td>
                                <td>
                                    <select class="form-control" name="designation">
                                        <option value="">--</option>
                                        <?
                                            $res=$con->query("SELECT * from designation where client_id='$clientid' order by designation asc");
                                            while($deg=mysqli_fetch_array($res))
                                            {?>
                                                <option><?echo $deg['designation'];?></option>
                                            <?}
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Father's/Spouse Name *</td>
                                <td><input type="text" name="fname" class="form-control" required></td>
                                <td>DOJ</td>
                                <td><input type="date" name="doj" class="form-control"></td>
                            </tr>
                            <tr>
                                <td>Relation *</td>
                                <td><input type="text" name="relation" class="form-control" required>
                                </td>
                                <td>Department</td>
                                <td>
                                    <select class="form-control" name="department">
                                        <option value="">--</option>
                                        <?
                                            $res=$con->query("SELECT * from department where client_id='$clientid' order by department asc");
                                            while($deg=mysqli_fetch_array($res))
                                            {?>
                                                <option><?echo $deg['department'];?></option>
                                            <?}
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>DOB *</td>
                                <td><input type="date" name="dob" class="form-control" required></td>
                                <td>Category</td>
                                <td>
                                    <select class="form-control" name="category">
                                        <option value="">--</option>
                                        <?
                                            $res=$con->query("SELECT * from categary where client_id='$clientid' order by categary asc");
                                            while($deg=mysqli_fetch_array($res))
                                            {?>
                                                <option><?echo $deg['categary'];?></option>
                                            <?}
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Gender *</td>
                                <td>
                                    <select class="form-control" name="gender" required>
                                        <option value="">--</option>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select>
                                </td>
                                <td>Religion</td>
                                <td><input type="text" name="religion" class="form-control"></td>
                                
                            </tr>
                            <tr>
                                <td>Marital Status *</td>
                                <td>
                                    <select class="form-control" name="marital" required>
                                        <option value="">--</option>
                                        <option>Married</option>
                                        <option>Unmarried</option>
                                    </select>
                                </td>
                                <td>Pan No.</td>
                                <td><input type="text" name="pan" class="form-control" required></td>
                                <td>State</td>
                            </tr>
                            <tr>
                                <td>Mobile</td>
                                <td><input type="text" name="mobile" class="form-control" required></td>
                                <td>Job Location</td>
                                <td>
                                    <select class="form-control" name="location">
                                        <option value="">--</option>
                                        <?
                                            $res=$con->query("SELECT * from branch where client_id='$clientid' order by branch asc");
                                            while($deg=mysqli_fetch_array($res))
                                            {?>
                                                <option><?echo $deg['branch'];?></option>
                                            <?}
                                        ?>
                                    </select>
                                </td>
                                <td><input type="text" name="state" class="form-control"></td>
                            </tr>
                            <tr>
                                <td>Email Id *</td>
                                <td><input type="email" name="email" class="form-control" required></td>
                                <td>UAN Number</td>
                                <td colspan="2"><input type="text" name="uan" class="form-control"></td>
                            </tr>
                            <tr>
                                <td>Current Address</td>
                                <td><input type="text" name="caddress" class="form-control" required></td>
                                <td>PF Number</td>
                                <td colspan="2"><input type="text" name="pf_code" class="form-control"></td>
                            </tr>
                            <tr>
                                <td>Permanent Address</td>
                                <td><input type="text" name="paddress" class="form-control" required></td>
                                <td>ESI Number</td>
                                <td colspan="2"><input type="text" name="esi_code" class="form-control"></td>
                            </tr>
                            <tr>
                                <td>Nationality</td>
                                <td><input type="text" name="nationality" class="form-control" required></td>
                                <td>Reporting Manager</td>
                                <td colspan="2">
                                    <select name="rep_manager" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" onchange="ManagerId(this.value)">
                                        <option value="">--</option>
                                        <?
                                            $sql="select emp_id,name from employee,designation where des_id=employee.designation and designation.designation='Manager' order by name asc";
                                            $res=$con->query($sql);
                                            while($al=mysqli_fetch_array($res))
                                                echo "<option value='".$al['emp_id']."'>".$al['name']."</option>";
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Education</td>
                                <td><input type="text" name="education" class="form-control" required></td>
                                <td>RM EMP-ID</td>
                                <td colspan="2">
                                    <div id="rmid_id"></div>
                                    <input type="text" name="rmid" id="rmid" class="form-control" readonly></td>
                            </tr>
                            <tr>
                                <td>Adhaar Number</td>
                                <td><input type="text" name="adhaar" class="form-control" required></td>
                                <td>Official Email</td>
                                <td colspan="2"><input type="text" name="official_email" class="form-control"></td>
                            </tr>
                            <tr>
                                <td>City Type</td>
                                <td><input type="text" name="city_type" class="form-control" required></td>
                                <td>DOL</td>
                                <td colspan="2"><input type="date" name="dol" class="form-control"></td>
                            </tr>
                            <tr>
                                <td>Bank Name</td>
                                <td><input type="text" name="bank" class="form-control" required></td>
                                <td>Field 1</td>
                                <td colspan="2"><input type="text" name="field1" class="form-control"></td>
                            </tr>
                            <tr>
                                <td>Account No.</td>
                                <td><input type="text" name="account" class="form-control"></td>
                                <td>Field 2</td>
                                <td colspan="2"><input type="text" name="field2" class="form-control"></td>
                            </tr>
                            <tr>
                                <td>IFSC Code</td>
                                <td><input type="text" name="ifsc" class="form-control"></td>
                                <td>Field 3</td>
                                <td colspan="2"><input type="text" name="field3" class="form-control"></td>
                            </tr>
                            <tr>
                                <td>Bank Branch</td>
                                <td><input type="text" name="branch" class="form-control"></td>
                                <td>Field 4</td>
                                <td colspan="2"><input type="text" name="field4" class="form-control"></td>
                            </tr>
                            <tr>
                                <td>Payment Mode</td>
                                <td><input type="text" name="mode" class="form-control"></td>
                                <td>Field 5</td>
                                <td colspan="2"><input type="text" name="field5" class="form-control"></td>
                            </tr>
                        </table>
                    </div>
                </div>


                <div class="col-sm-6 pad0">
                    <div class="panel panel-default">
                        <div class="panel-heading">Salary Break Up</div>
                        <div class="panel-body">
                            <table class="table">
                                <?
                                    $sql="SELECT * from allowance where type='Fix' and client_id='$clientid' order by aid asc";
                                    $re=$con->query($sql);
                                    while($al=mysqli_fetch_array($re))
                                    {?>
                                        <tr>
                                            <td><input type="hidden" name="break[]" value="<?echo $al['allowance'];?>"><?echo $al['allowance'];?></td>
                                            <td><input type="text" name="salary[]" class="form-control"></td>
                                        </tr>
                                    <?}
                                ?>
                            </table>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">Annual Leave</div>
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td width="200">EL</td>
                                    <td><input type="text" name="el" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>SL</td>
                                    <td><input type="text" name="sl" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>CL</td>
                                    <td><input type="text" name="cl" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>HO</td>
                                    <td><input type="text" name="ho" class="form-control"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">Applicable</div>
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>PF</td>
                                    <td>
                                        <label class="switch">
                                          <input type="checkbox" name="pf" value="Y">
                                          <span class="slider round"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pension</td>
                                    <td>
                                        <label class="switch">
                                          <input type="checkbox" name="pension" value="Y">
                                          <span class="slider round"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>ESI</td>
                                    <td>
                                        <label class="switch">
                                          <input type="checkbox" name="esi" value="Y">
                                          <span class="slider round"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>LWF</td>
                                    <td>
                                        <label class="switch">
                                          <input type="checkbox" name="lwf" value="Y">
                                          <span class="slider round"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>TDS</td>
                                    <td>
                                        <label class="switch">
                                          <input type="checkbox" name="tds" value="Y">
                                          <span class="slider round"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>PT</td>
                                    <td>
                                        <label class="switch">
                                          <input type="checkbox" name="pt" value="Y">
                                          <span class="slider round"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>OT</td>
                                    <td>
                                        <label class="switch">
                                          <input type="checkbox" name="ot" value="Y">
                                          <span class="slider round"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bonus</td>
                                    <td>
                                        <label class="switch">
                                          <input type="checkbox" name="bonus" value="Y">
                                          <span class="slider round"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Gratuity</td>
                                    <td>
                                        <label class="switch">
                                          <input type="checkbox" name="gratuty" value="Y">
                                          <span class="slider round"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>EMP. Login</td>
                                    <td>
                                        <label class="switch">
                                          <input type="checkbox" name="login" value="Y">
                                          <span class="slider round"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Attendance Marking</td>
                                    <td>
                                        <label class="switch">
                                          <input type="checkbox" name="atd" value="Y">
                                          <span class="slider round"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Working Hour</td>
                                    <td><input type="text" name="work_hour" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Rf-Id Card Number</td>
                                    <td><input type="text" name="card" class="form-control"></td>
                                </tr>
                            </table>
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
                    $pf="N";
                    $pension="N";
                    $esi="N";
                    $lwf="N";
                    $tds="N";
                    $pt="N";
                    $ot="N";
                    $bonus="N";
                    $gratuty="N";
                    $login="N";
                    $atd="N";
                    extract($_POST);

                    if($_FILES['pic']['name']=="")
                        $img=$pic;
                    else
                    {
                        $img=rand().$_FILES['pic']['name'];
                        move_uploaded_file($_FILES['pic']['tmp_name'], "emp_img/".$img);
                        unlink("emp_img/$pic");
                    }

                    $sql="insert into employee values('','$empcode','$name','$fname','$relation','$dob','$gender','$marital','$mobile','$email','$caddress','$paddress','$nationality','$education','$adhaar','$city_type','$religion','$img','$pan','$bank','$account','$ifsc','$branch','$mode','$designation','$doj','$department','$category','$location','$state','$uan','$pf_code','$esi_code','$rep_manager','$rmid','$official_email','$dol','$field1','$field2','$field3','$field4','$field5','$el','$sl','$cl','$ho','$pf','$pension','$esi','$lwf','$tds','$pt','$ot','$bonus','$gratuty','$login','$atd','$work_hour','$card','','$clientid','$mobile')";
                    $con->query($sql);

                    foreach($break as $i=>$value)
                    {
                        $sql="insert into employee_breakup values('','$value','$salary[$i]','$empcode','$clientid')";
                        $con->query($sql);
                    }
                    echo "<script>window.location.href='employee_add';</script>";
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

    function ManagerId(val)
    {
        xmlhttp=new XMLHttpRequest();
        xmlhttp.open("GET","emp_manager.php?find="+val,false);
        xmlhttp.send(null);
        document.getElementById('rmid').value=xmlhttp.responseText;
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