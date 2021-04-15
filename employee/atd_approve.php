
<?
    include('extra/top.php');

    $y=$_REQUEST['y'];
    $m=$_REQUEST['m'];
    $empcode=$_REQUEST['ec'];
    $ym=$y."-".$m;

    $sql="select * from employee where empcode='$empcode' and client_id='$clientid'";
    $res=$con->query($sql);
    $row=mysqli_fetch_array($res);
    $eid=$row['emp_id'];
?>

<?include('extra/sidemenu.php');?>

<div class="main">
    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="col-sm-10 pad0"><div class="headding">Attendance Approval</div></div>
            <div class="col-sm-2 pad0 text-right">
                <a class="btn batt" href="attendance_approval">Back</a>
            </div>
        </div>
        <div class="col-sm-12 pad15">
            <div><b>Month : <?echo date('M-Y',strtotime($ym));?></b></div>
            <table class="table table-bordered">
                <tr>
                    <td>EMP Code</td>
                    <td><?echo $row['empcode'];?></td>
                    <td>Name</td>
                    <td><?echo $row['name'];?></td>
                </tr>
                <tr>
                    <td>Designation</td>
                    <td><?echo $row['designation'];?></td>
                    <td>Branch</td>
                    <td><?echo $row['branch'];?></td>
                </tr>
            </table>
            <span>*********** Edit then Enter ***********</span>
            <table id="data_table" class="table table-striped table-bordered">
                <thead>
                    <tr style="font-weight: bold; background: #eee;">
                        <td>Date</td>
                        <td align="center">Intime (HH:MM)</td>
                        <td align="center">Outtime (HH:MM)</td>
                        <td align="center">Attendance</td>
                        <td align="center">OT Hrs.</td>
                        <td>Location</td>
                    </tr>
                </thead>
                <tbody>
                <?
                    $sql="select * from attendance where emp_code='$empcode' and year='$y' and month='$m' and client_id='$clientid' order by atd_date asc";
                    $res=$con->query($sql);
                    while($row=mysqli_fetch_array($res))
                    {?>
                        <tr>
                            <td align="center"><?echo $row['atdid'];?></td>
                            <td><?echo date('d-m-Y',strtotime($row['atd_date']));?></td>
                            <td align="center"><?echo $row['intime'];?></td>
                            <td align="center"><?echo $row['outtime'];?></td>
                            <td align="center"><?echo $row['atd'];?></td>
                            <td align="center"><?echo $row['oth'];?></td>
                            <td><?echo $row['location'];?></td>
                        </tr>  
                    <?}
                ?>
                </tbody>
            </table>
            <div class="col-sm-12 " align="center">
                <form method="post">
                    <input type="hidden" name="eid" value="<?echo $eid;?>">
                    <input type="hidden" name="m" value="<?echo $m;?>">
                    <input type="hidden" name="y" value="<?echo $y;?>">
                    <input type="submit" name="save" class="btn batt" value="Approve Now">
                </form>
                <?
                    if(isset($_POST['save']))
                    {
                        extract($_POST);
                        $sql="select * from attandance_approve where eid='$eid' and month='$m' and year='$y' and client_id='$clientid'";
                        $row=mysqli_fetch_array($con->query($sql));

                        if(!$row)
                            $sql="insert into attandance_approve value('','$eid','$m','$y','$clientid')";
                        else
                        {
                            $apid=$row['apid'];
                            // $sql="update attandance_approve apr='$value' where apid='$apid')";
                        }
                        $con->query($sql);
                        echo "<script>window.location.href='attendance_approval';</script>";
                    }
                ?>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>






<?include('extra/footer.php');?>

<script type="text/javascript" src="js/jquery.tabledit.js"></script>
<!-- <script type="text/javascript" src="js/custom_table_edit.js"></script> -->
<script type="text/javascript">
$(document).ready(function(){
    $('#data_table').Tabledit({
        deleteButton: false,
        editButton: false,          
        columns: {
          identifier: [0, 'id'],                    
          editable: [[2, 'intime'], [3, 'outtime'], [4, 'atd'], [5, 'oth']]
        },
        hideIdentifier: true,
        url: 'atd_update.php'       
    });
});
</script>