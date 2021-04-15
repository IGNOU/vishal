
<?include('extra/top.php');?>

<?include('extra/sidemenu.php');?>

<div class="main">        
    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="col-sm-8 pad0">
                <div class="headding">Employee List</div>
            </div>
            <div class="col-sm-4 pad0 text-right">
                <button onclick='JSconfirm_all()' title="Delete Record" class="batt btn"><i class="fa fa-trash" style="color: #FFF;"></i> All Delete</button>
            </div>
            <div class="clear"></div>
            
        </div>
        <div class="col-sm-12 pad15">
            <table id="example" class="table table-striped table-bordered">
                <thead>
                    <tr class="tr">
                        <td>#</td>
                        <td>EMP ID</td>
                        <td>Name</td>
                        <td>Father' Name</td>
                        <td>Designation</td>
                        <td>Deparment</td>
                        <td>Branch</td>
                        <!-- <td width="100" align="center">DOB</td> -->
                        <td>State</td>
                        <td align="center">Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?
                        $sql="SELECT * FROM employee where client_id=$clientid order by(emp_id) asc";
                        $res=$con->query($sql); $i=0;
                        while($row=mysqli_fetch_array($res))
                        {   $id=$row['emp_id']; ++$i;
                        ?>
                            <tr>
                                <td><?echo $i;?></td>
                                <td><?echo $row['empcode'];?></td>
                                <td><?echo $row['name'];?></td>
                                <td><?echo $row['fname'];?></td>
                                <td><?echo $row['designation'];?></td>
                                <td><?echo $row['department'];?></td>
                                <td><?echo $row['branch'];?></td>
                                <!-- <td><?echo date('d-m-Y', strtotime($row['dob']));?></td> -->
                                <td><?echo $row['state'];?></td>
                                <td align="center">
                                    <a href="employee_edit?id=<?php echo $id;?>"><i class="fa fa-edit"></i></a>

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
        window.location = "delete.php?id="+delid+"&&tname=company";   
    } 
    else {     
        swal("Record Not Deleted.");   
        } });
}

function JSconfirm_all(delid){
    swal({ 
    title: "Do you want to delete all employee data ?",   
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
        window.location = "delete.php?id=&&tname=all_employee"+"&&cl=<?echo $clientid;?>";   
    } 
    else {     
        swal("Record Not Deleted.");   
        } });
}
</script>


<?include('extra/footer.php');?>