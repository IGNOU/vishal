<?include('extra/top.php');?>

<?include('extra/sidemenu.php');?>

<style>
  .notfound{
    display: none;
  }
  .select{
    width: 20px;
    height: 20px;
    font-weight: normal;
    cursor: pointer;
  }
  .table2{
    border: 1px solid #ddd;
    width: 100%;
    font-size: 1.1em;
    margin-bottom: 20px;
  }
  .table2 td{
    border: 1px solid #ddd;
    padding: 5px;
  }
</style>

<div class="main">
    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="col-sm-6 pad0">
                <div class="headding">Notification Setting</div>
            </div>  
            <div class="col-sm-6 text-right pad0">
                <a href="create_company" class="batt btn">Back</a>
            </div>
        </div>
        <div class="col-sm-12 pad15">
            <form class="form" role="form" method="post">
                <div class="form-group col-sm-8">
                    <label>Message</label>
                    <textarea class="form-control" name="message"></textarea>
                </div>
                <div class="col-sm-4">
                    <div class="form-group col-sm-12 pad0">
                        <label>Date</label>
                        <input type="date" class="form-control" name="date">
                    </div>
                    <div class="form-group col-sm-12 pad0">
                        <label>Period</label>
                        <select class="form-control" name="period">
                            <option value="">--</option>
                            <option>Daily</option>
                            <option>Weekly</option>
                            <option>Monthly</option>
                            <option>Yearly</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-8 pad0" style="background: #DDD; padding: 9px;">
                        <label style="font-size: 1.2em;">Assigned To</label>
                    </div>
                    <div class="col-sm-4 pad0" style="background: #DDD; padding: 6px;">
                        <input type="text" name="search" id="txt_searchall" class="form-control search" placeholder="Type to search..." oninput="this.value = this.value.toUpperCase()">
                    </div>
                </div>
                <div class="col-sm-12">
                    <table class="table2">
                        <thead>
                            <tr>
                                <td><input type="checkbox" name="checkall" class="select" id="select_all"></td>
                                <td>Name</td>
                                <td>Email</td>
                                <td>Mobile</td>
                                <td>Designation</td>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <?
                                $sql="SELECT * FROM employee where client_id=$clientid order by(emp_id) asc";
                                $res=$con->query($sql);
                                while($row=mysqli_fetch_array($res))
                                {   $id=$row['emp_id'];
                                ?>
                                    <tr>
                                        <td><input type="checkbox" class="checkbox select" name="check[]" value="<?echo $id;?>">
                                        </td>
                                        <td><?echo strtoupper($row['name']);?></td>
                                        <td><?echo $row['email'];?></td>
                                        <td><?echo $row['mobile'];?></td>
                                        <td><?echo $row['designation'];?></td>
                                    </tr>
                                <?}
                            ?>
                            <tr class='notfound'>
                              <td colspan='4'>No record found</td>
                            </tr>
                        </tfoot>
                    </table>
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
                    $msg=htmlspecialchars($message,ENT_QUOTES);
                    $sql="insert into com_notice values ('','$msg','$date','$period','$clientid')";
                    $con->query($sql);

                    $sql="select max(nid) from com_notice where client_id='$clientid'";
                    $res=$con->query($sql);
                    $row=mysqli_fetch_array($res);
                    $id=$row[0];

                    foreach($check as $key)
                    {
                        $sql="insert into com_notice_details values ('','$id','$key','$clientid')";
                        $con->query($sql);
                    }
                    echo "<script>window.location.href='setting_notice';</script>";
                }
            ?>
        </div>
        <div class="clear"></div>
    </div><br>

    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="col-sm-6 pad0">
                <div class="headding">Notification Setting List</div>
            </div>
        </div>
        <div class="col-sm-12 pad15">
            <table id="example" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th width="500">Message</th>
                        <th>Date</th>
                        <th>Period</th>
                        <th>Mail To</th>
                        <th align="center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?
                        $sql="SELECT * FROM com_notice where client_id=$clientid order by(nid) asc";
                        $res=$con->query($sql); $i=1;
                        while($row=mysqli_fetch_array($res))
                        {   $id=$row['nid'];
                        ?>
                            <tr>
                                <td><?echo $i++;?></td>
                                <td><?echo $row['msg'];?></td>
                                <td><?echo $row['date'];?></td>
                                <td><?echo $row['period'];?></td>
                                <td><?echo mysqli_num_rows($con->query("select * from com_notice_details where nid='$id'"));?></td>
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
        window.location = "delete.php?id="+delid+"&&tname=com_notice";   
    } 
    else {     
        swal("Record Not Deleted.");   
        } });
}
</script>


<?include('extra/footer.php');?>

<script type='text/javascript'>
    $(document).ready(function(){

        // Search all columns
        $('#txt_searchall').keyup(function(){
            // Search Text
            var search = $(this).val();

            // Hide all table tbody rows
            $('table tfoot tr').hide();

            // Count total search result
            var len = $('table tfoot tr:not(.notfound) td:contains("'+search+'")').length;

            if(len > 0){
              // Searching text in columns and show match row
              $('table tfoot tr:not(.notfound) td:contains("'+search+'")').each(function(){
                  $(this).closest('tr').show();
              });
            }else{
              $('.notfound').show();
            }
            
        });
       
    });

    $(document).ready(function(){
        $('#select_all').on('click',function(){
            if(this.checked){
                $('.checkbox').each(function(){
                    this.checked = true;
                });
            }else{
                 $('.checkbox').each(function(){
                    this.checked = false;
                });
            }
        });
    });
</script>