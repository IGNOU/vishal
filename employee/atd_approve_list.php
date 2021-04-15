
<?
	include('extra/connect.php');
	$date=date("Y-m-d");

	$y=$_REQUEST['y'];
    $m=$_REQUEST['m'];
	$empcode=$_REQUEST['ec'];
    $clientid=$_REQUEST['cl'];


    $ym=$y."-".$m;
?>
<div><b>Month : <?echo date('M-Y',strtotime($ym));?></b></div>
<table class="table table-bordered">
    <tr style="font-weight: bold; background: #eee;">
        <td>Sn</td>
        <td>Employee Name</td>
        <td>Designation</td>
        <td>Branch</td>
        <td width="50" align="center">P</td>
        <td width="50" align="center">W</td>
        <td width="50" align="center">EL</td>
        <td width="50" align="center">CL</td>
        <td width="50" align="center">SL</td>
        <td width="50" align="center">ML</td>
        <td width="50" align="center">HO</td>
        <td width="50" align="center">PD</td>
        <td width="50" align="center">OT</td>
        <td>Approve/Reject</td>
    </tr>
    <?
        $a=1;
        $sql="SELECT emp_id,name,designation,branch,empcode from employee where rmid='$empcode' and client_id='$clientid'";
        $res=$con->query($sql);
        while($row=mysqli_fetch_array($res))
        {
            $id=$row['0'];
            $ec=$row['4'];
            $sql2="select * from attandance_approve where eid='$id' and month='$m'";
            $row2=mysqli_fetch_array($con->query($sql2));
            ?>
            <tr>
                <td><?echo $a++;?></td>
                <td><?echo $row['1'];?></td>
                <td><?echo $row['2'];?></td>
                <td><?echo $row['3'];?></td>
                <td align="center"><? echo $p=mysqli_num_rows($con->query("select * from attendance where atd_date like '$ym%' and empid='$id' and atd='P' and client_id='$clientid'"))?></td>
                <td align="center"><? echo $w=mysqli_num_rows($con->query("select * from attendance where atd_date like '$ym%' and empid='$id' and atd='W' and client_id='$clientid'"))?></td>
                <td align="center"><? echo $el=mysqli_num_rows($con->query("select * from attendance where atd_date like '$ym%' and empid='$id' and atd='EL' and client_id='$clientid'"))?></td>
                <td align="center"><? echo $cl=mysqli_num_rows($con->query("select * from attendance where atd_date like '$ym%' and empid='$id' and atd='CL' and client_id='$clientid'"))?></td>
                <td align="center"><? echo $sl=mysqli_num_rows($con->query("select * from attendance where atd_date like '$ym%' and empid='$id' and atd='SL' and client_id='$clientid'"))?></td>
                <td align="center"><? echo $ml=mysqli_num_rows($con->query("select * from attendance where atd_date like '$ym%' and empid='$id' and atd='ML' and client_id='$clientid'"))?></td>
                <td align="center"><? echo $ho=mysqli_num_rows($con->query("select * from attendance where atd_date like '$ym%' and empid='$id' and atd='HO' and client_id='$clientid'"))?></td>
                <td align="center"><? echo $p+$w+$el+$cl+$sl+$ml+$ho;?></td>
                <td>
                    <? $ot=mysqli_fetch_array($con->query("select sum(oth) from attendance where empid='$id' and year='$y' and month='$m' and client_id='$clientid'"));
                        echo $ot['0'];
                    ?>
                </td>
                <td align="center">
                    <?
                        if(!$row2)
                        {?>
                            <a class="btn batt" href="atd_approve?ec=<?echo $ec;?>&&y=<?echo $y;?>&&m=<?echo $m;?>">Approve</a>
                        <?}
                        else
                        {?>
                            <a class="btn batt" style="background: orange">Approved</a>
                        <?}
                    ?>
                </td>
            </tr>  
        <?}
    ?>
</table>