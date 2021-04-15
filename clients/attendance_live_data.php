
<?php 
	session_start();
    if(!$_SESSION['user'])
        echo "<script>window.location.href='logout.php';</script>";

    $sesuser=$_SESSION['user'];

    include('extra/connect.php');
    $data=mysqli_fetch_array($con->query("select * from client where email='$sesuser'"));
    $data2=mysqli_fetch_array($con->query("select * from d_setting"));

    $clientid=$data['cid'];

    $id=$_REQUEST['id'];

    date_default_timezone_set('Asia/Kolkata');
	$timestamp = time();
	$date=date("Y-m-d");
	$time = date("H:i", $timestamp);

    $date=date("Y-m-d");
    $sql="select * from employee where card='$id'";
    $res=$con->query($sql);
    $row=mysqli_fetch_array($res);

    $sql="select * from attendance where atd_date='$date' and card_no='$id'";
    $atdc=mysqli_fetch_array($con->query($sql));

    if($atdc!="")
    { 
    	$aid=$atdc['atdid'];
	    $sql="update attendance set outtime='$time' where atdid='$aid'";
	    $con->query($sql);
    	?>
        <div class="col-sm-3"></div>
    	<div class="col-sm-6 pad0">
            <div class="panel panel-default">
                <div class="panel-heading">Employee Details</div>
                <div class="panel-body">
                    <div class="col-sm-8 pad0">
                        <table>
                            <tr>
                                <td>Emp Id</td>
                                <td><?echo $row['emp_id'];?> </td>
                            </tr>
                            <tr>
                                <td>Card Number</td>
                                <td><?echo $row['card'];?></td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td><?echo $row['name'];?></td>
                            </tr>
                            <tr>
                                <td>Father's Name</td>
                                <td><?echo $row['fname'];?></td>
                            </tr>
                            <tr>
                                <td>DOB</td>
                                <td><?echo $row['dob'];?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-4">
                        <img src="emp_img/<?echo $row['image'];?>" class="img-responsive">
                    </div>
                </div>
            </div>
        </div>
    <?}
    else
    {
	    $eid=$row['emp_id'];
	    $sql="insert into attendance values('','$date','$time','','P','$eid','$id','','$clientid')";
	    $con->query($sql);

	    ?>
        <div class="col-sm-3"></div>
        <div class="col-sm-6 pad0">
            <div class="panel panel-default">
                <div class="panel-heading">Employee Details</div>
                <div class="panel-body">
                    <div class="col-sm-8 pad0">
                        <table>
                            <tr>
                                <td>Emp Id</td>
                                <td><?echo $row['emp_id'];?> </td>
                            </tr>
                            <tr>
                                <td>Card Number</td>
                                <td><?echo $row['card'];?></td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td><?echo $row['name'];?></td>
                            </tr>
                            <tr>
                                <td>Father's Name</td>
                                <td><?echo $row['fname'];?></td>
                            </tr>
                            <tr>
                                <td>DOB</td>
                                <td><?echo $row['dob'];?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-4">
                        <img src="emp_img/<?echo $row['image'];?>" class="img-responsive">
                    </div>
                </div>
            </div>
        </div>
  
	<?}
?>
