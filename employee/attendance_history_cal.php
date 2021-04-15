<?php 
	include('extra/connect.php');

    $y=$_REQUEST['y'];
    $m=$_REQUEST['m'];
    $empid=$_REQUEST['eid'];
    $clientid=$_REQUEST['cl'];

    $d=cal_days_in_month(CAL_GREGORIAN,$m,$y);
    $a=1;

    $ym=$y."-".$m;
?>
<table class="table table-bordered">
    <b>Month : <?echo date('M-Y',strtotime($ym));?></b>
    <tr style="font-weight: bold; background: #eee;">
        <td>Day</td>
        <td align="center">Intime</td>
        <td align="center">Outtime</td>
        <td align="center">Attendance</td>
        <td align="center">OT Hrs.</td>
        <td>Location</td>
    </tr>
    <?
        while($a<=$d)
        {
            if($a<10)
                $dd=$y."-".$m."-0".$a;
            else
                $dd=$y."-".$m."-".$a;

            $sql="select * from attendance where empid='$empid' and atd_date='$dd'";
            $row=mysqli_fetch_array($con->query($sql));
            ?>
            <tr>
                <td><?echo $a++;?></td>
                <td align="center"><?echo $row['intime'];?></td>
                <td align="center"><?echo $row['outtime'];?></td>
                <td align="center"><?echo $row['atd'];?></td>
                <td align="center"><?echo $row['oth'];?></td>
                <td><?echo $row['location'];?></td>
            </tr>  
        <?}
    ?>
</table>