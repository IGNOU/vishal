
<?
    include('extra/connect.php');
    $y=$_REQUEST['year'];
    $m=$_REQUEST['month'];
    $clientid=$_REQUEST['cl'];


    $ym=$y."-".$m;
    $d=cal_days_in_month(CAL_GREGORIAN,$m,$y);
    $a=1;
    
    $sql="select * from employee where client_id=$clientid order by (emp_id) asc";
    $res=$con->query($sql);

    $count=0;
?>

<div class="page_details">
    <div class="col-sm-12 pad15_line">
        <div class="col-sm-6 col-xs-12 pad0">
            <div class="headding">Attendance List ( <b><?echo date("M-Y",strtotime($ym));?></b>)</div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="col-sm-12 pad15">
        <input type="hidden" name="y" id="y" value="<?echo $y;?>">
        <input type="hidden" name="m" id="m" value="<?echo $m;?>">
        <table class="table table-bordered" style="background: #eee">
            <tr>
                <td>P= Present</td> 
                <td>A= Absent</td>
                <td>W= Week Off</td>
                <td>HD= Half Day</td>
                <td>HO= Holiday</td>
                <td>EL= Earned Leave</td>
                <td>CL= Casual Leave</td>
                <td>SL= Sick Leave</td>
                <td>ML= Maternity Leave</td>
            </tr>
        </table>
        <div style="overflow: auto;">
            <table class="table3 table-bordered" style="width: 300%;"> 
                <tr style="font-weight: bold;">
                    <td colspan="<?echo $d+12;?>">Attendance Details</td>
                    <td colspan="<?echo $d+1;?>">Over Time Details</td>
                </tr>
                <tr style="font-weight: bold;">
                    <td>#</td>
                    <td>Emp Id</td>
                    <td width="300">Name</td>
                    <td width="230">DOJ (YYYY-MM-DD)</td>
                    <?while($a<=$d)
                        {
                            echo "<td width='50' align='center'>".$a."</td>";
                            $a++;
                        }
                    ?>
                    <td width="50" align="center">P</td>
                    <td width="50" align="center">W</td>
                    <td width="50" align="center">EL</td>
                    <td width="50" align="center">CL</td>
                    <td width="50" align="center">SL</td>
                    <td width="50" align="center">ML</td>
                    <td width="50" align="center">HO</td>
                    <td width="50" align="center">PD</td>
                    <?
                        $a=1;
                        while($a<=$d)
                        {
                            echo "<td width='50' align='center'>".$a."</td>";
                            $a++;
                        }
                    ?>
                    <td align="center">Total</td>
                </tr>
                <?  $i=1;
                    while($row=mysqli_fetch_array($res))
                    {   $aa=1; $eid=$row['emp_id']; $count++; $p=0; $w=0; $el=0; $cl=0; $sl=0; $ml=0; $ho=0;
                        ?>
                        <tr>
                            <td><?echo $i++;?></td>
                            <td><?echo $row['empcode'];?></td>
                            <td><?echo $name=$row['name'];?></td>
                            <td align="center"><?echo $row['doj'];?></td>
                            <?
                                while($aa<=$d)
                                {   
                                    if($aa<10)
                                        $dd=$y."-".$m."-0".$aa;
                                    else
                                        $dd=$y."-".$m."-".$aa;
                                    
                                        $s="select * from attendance where atd_date='$dd' and empid='$eid'";
                                        $atd=mysqli_fetch_array($con->query($s));
                                        
                                        echo "<td style='text-align:center;'>".$atd['atd']."</td>";
                                    $aa++;
                                }
                            ?>
                            <td align="center"><? echo $p=mysqli_num_rows($con->query("select * from attendance where atd_date like '$ym%' and empid='$eid' and atd='P'"))?></td>
                            <td align="center"><? echo $w=mysqli_num_rows($con->query("select * from attendance where atd_date like '$ym%' and empid='$eid' and atd='W'"))?></td>
                            <td align="center"><? echo $el=mysqli_num_rows($con->query("select * from attendance where atd_date like '$ym%' and empid='$eid' and atd='EL'"))?></td>
                            <td align="center"><? echo $cl=mysqli_num_rows($con->query("select * from attendance where atd_date like '$ym%' and empid='$eid' and atd='CL'"))?></td>
                            <td align="center"><? echo $sl=mysqli_num_rows($con->query("select * from attendance where atd_date like '$ym%' and empid='$eid' and atd='SL'"))?></td>
                            <td align="center"><? echo $ml=mysqli_num_rows($con->query("select * from attendance where atd_date like '$ym%' and empid='$eid' and atd='ML'"))?></td>
                            <td align="center"><? echo $ho=mysqli_num_rows($con->query("select * from attendance where atd_date like '$ym%' and empid='$eid' and atd='HO'"))?></td>
                            <td align="center"><? echo $p+$w+$el+$cl+$sl+$ml+$ho;?></td>

                            <?
                                $aa=1; $ott=0;
                                while($aa<=$d)
                                {   
                                    if($aa<10)
                                        $dd=$y."-".$m."-0".$aa;
                                    else
                                        $dd=$y."-".$m."-".$aa;
                                    
                                        $s="select * from attendance where atd_date='$dd' and empid='$eid'";
                                        $ot=mysqli_fetch_array($con->query($s));
                                        $ott+=$ot['oth'];
                                        if($ot['oth']!="" && $ot['oth']>0)
                                            echo "<td style='text-align:center;'>".$ot['oth']."</td>";
                                        else
                                            echo "<td style='text-align:center;'></td>";
                                    $aa++;
                                }
                            ?>
                            <td align="center"><? echo $ott;?></td>
                        </tr>
                    <?}
                ?>
            </table>
            <div class="col-sm-12" style="padding: 10px 0px; font-size: 1.2em; font-weight: bold;">
                Total Employee : <?echo $count;?>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>




