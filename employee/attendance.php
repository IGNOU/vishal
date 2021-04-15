
<?
    include('extra/top.php');
    $date=date('Y-m-d');
    $card=$data['card'];

    $sql="select * from employee where emp_id='$empid'";
    $row=mysqli_fetch_array($con->query($sql));

    $sqll="select * from attendance where atd_date='$date' and empid='$empid'";
    $atdc=mysqli_fetch_array($con->query($sqll));

    $sql="select * from com_shift where client_id='$clientid'";
    $sf=mysqli_fetch_array($con->query($sql));
    $h=$sf['half'];
    $f=$sf['hour'];

    function decimal_to_time($decimal) {
        $hours = floor($decimal / 60);
        $minutes = floor($decimal % 60);
        $seconds = $decimal - (int)$decimal;
        $seconds = round($seconds * 60);
     
        return str_pad($hours, 2, "0", STR_PAD_LEFT) . ":" . str_pad($minutes, 2, "0", STR_PAD_LEFT) . ":" . str_pad($seconds, 2, "0", STR_PAD_LEFT);
    }

    $half=decimal_to_time($h);
    $full=decimal_to_time($f);

?>
<?include('extra/sidemenu.php');?>

<div class="main">
    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="headding">Punch Attendance</div>
        </div>
        <div class="col-sm-12 pad15">
            <form method="POST" class="form">
                <div class="col-sm-6" style="background: #ddd; padding: 20px;">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <?
                                if($atdc=="")
                                  {?>
                                    <label>
                                        <input checked type="radio" name="check" value="IN"> In Time <span style="padding: 8px; background: #fff; font-weight: bold;"><?echo date('D d-M-Y',strtotime($date)); ?>&nbsp;&nbsp;&nbsp;<?echo $ctime; ?></span>
                                    </label>
                                  <?} 
                                else
                                {
                                ?>
                                    <label>
                                        <input type="hidden" name="intime" value="<?echo $atdc['intime'];?>">
                                        <input type="hidden" name="half" value="<?echo $half;?>">
                                        <input type="hidden" name="full" value="<?echo $full;?>">
                                        <input checked type="radio" name="check" value="OUT"> Out Time <span style="padding: 8px; background: #fff; font-weight: bold;"><?echo date('D d-M-Y',strtotime($date)); ?>&nbsp;&nbsp;&nbsp;<?echo $ctime; ?></span>            
                                    </label>
                                <?
                                }
                            ?>
                        </div>
                    </div>
                   
                                  
                    <div class="col-sm-12 form-group">
                        <input type="submit" class="btn btn-primary" name="save" value="Submit">
                    </div>
                </div>
            </form> 
            <?
                if(isset($_POST['save']))
                {
                    extract($_POST); $location=""; //punch attendance location
                    if($check=="IN")
                    {
                        $sql="insert into attendance values('','$date','$ctime','','A','','$location','$empid','$empcode','$clientid','$y','$m')";
                        $con->query($sql);
                    }
                    else
                    {
                        $a = new DateTime($intime);
                        $b = new DateTime($ctime);
                        $interval = $a->diff($b);
                        $duration=$interval->format("%H:%I");
                        if($duration<=$half)
                        {
                            $sql="update attendance set outtime='$ctime',atd='A' where empid='$empid' and atd_date='$date'";
                            $con->query($sql);
                        }
                        else if($duration>=$half && $duration<$full)
                        {
                            $sql="update attendance set outtime='$ctime',atd='HD' where empid='$empid' and atd_date='$date'";
                            $con->query($sql);
                        }
                        else
                        {
                            $a = new DateTime($duration);
                            $b = new DateTime($full);
                            $interval = $a->diff($b);
                            $over=$interval->format("%H");
                            $sql="update attendance set outtime='$ctime',atd='P',oth='$over' where empid='$empid' and atd_date='$date'";
                            $con->query($sql);
                        }
                    }
                    echo "<script>window.location.href='attendance';</script>";
                }
            ?>     
        </div>
        <div class="clear"></div>
    </div><br>

</div>









<style type="text/css">
    input[type=checkbox]
    {
        cursor: pointer;
        width: 18px;
        height: 18px;
        border-radius: 0px;
    }
</style>


<?include('extra/footer.php');?>