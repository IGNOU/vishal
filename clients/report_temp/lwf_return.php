<!DOCTYPE html>
<html>
<head>
    <title>LWF Return</title>

    <style type="text/css">
        table{
            border: 1px solid #333;
            width: 100%;
            border-collapse: collapse;
        }
        td{
            height: 30px;
            padding: 0px 3px;
            border: 1px solid #333;
        }
    </style>
</head>
<body>
<?
    include('../extra/connect.php');
    $f=$_REQUEST['f'];
    $t=$_REQUEST['t'];
    $e=$_REQUEST['e'];
    $b=$_REQUEST['b'];
    $clid=$_REQUEST['cl'];

    $sy=substr($f,0,4);
    $std="01-04-".$sy;
    $ltd="31-03-".($sy+1);
      
    $sql="select * from employee where client_id='$clid'";
    if($e!="")
        $sql .=" and empcode='$e'";
    if($b!="")
        $sql .=" and location='$b'";
        
    $sql.="order by (emp_id) asc";

    $res=$con->query($sql);

    $data2=mysqli_fetch_array($con->query("select * from company where client_id='$clid'"));

?>

<div id="report">
    <table border="1"> 
        <tr><td colspan="31" align="center">Form B</td></tr>
        <tr><td colspan="31" align="center">Under Rule 22(2)</td></tr>
        <tr><td colspan="31" align="center">Punjab Labour Wefare Fund Rules 1965 </td></tr> 
        <tr><td colspan="31" align="center"><b><?echo $data2['name'];?></b></td></tr>
        <tr><td colspan="31" align="center"><?echo $data2['address'];?></td></tr> 
        <tr><td colspan="31" align="center">Contribution from <b><?echo date('d-M-Y', strtotime($std));?></b> to <b><?echo date('d-M-Y', strtotime($ltd));?></b></td></tr>
        <tr>
            <td colspan="4"></td>
            <?
                $a=4; $aa=1;
                while($a<=15)
                {
                    if($a<13)
                        $ya=$sy."-".$a;
                    else
                        $ya=($sy+1)."-".$aa++;
                    echo "<td colspan='2' align='center'>".date('M-Y', strtotime($ya))."</td>";
                    $a++;
                }
            ?>
            <td colspan="3" align="center">Total</td>
        </tr>
        <tr>
            <td>#</td>
            <td>Emp code</td>
            <td>Name</td>
            <td>State</td>
            <?
                $a=4; $aa=1;
                while($a<=15)
                {
                    if($a<13)
                        $ya=$sy."-".$a;
                    else
                        $ya=($sy+1)."-".$aa++;
                    echo "<td align='center'>EE LWF</td>";
                    echo "<td align='center'>ER LWF</td>";
                    $a++;
                }
            ?>
            <td align='center'>EE Total</td>
            <td align='center'>ER Total</td>
            <td align='center'>Total</td>
        </tr>
        <?  
            $i=1;
            while($row=mysqli_fetch_array($res))
            {   extract($row);
                ?>
                <tr>
                    <td><?= $i++;?></td>
                    <td><?= $empcode;?></td>
                    <td><?= $name;?></td>
                    <td><?= $state;?></td>
                    <?
                        $tee=0; $ter=0; $tt=0;
                        $a=4; $aa=1;
                        while($a<=15)
                        {
                            if($a<13)
                            {
                                $y=$sy;
                                $m2=$a;
                            }
                            else
                            {
                                $y=$sy+1;
                                $m2=$aa++;
                            }

                            $sql="SELECT * from salary where emp_code='$empcode' and year='$y' and month='$m2' and client_id='$clid'"; 
                            $sal=mysqli_fetch_array($con->query($sql));
                            $tee+=$sal['lwf'];
                            $ter+=$sal['er_lwf'];
                            $tt+=$sal['lwf']+$sal['er_lwf'];

                            echo "<td>".$sal['lwf']."</td>";
                            echo "<td>".$sal['er_lwf']."</td>";
                            $a++;
                        }
                    ?>
                    <td align="center"><?echo number_format($tee,2);?></td>
                    <td align="center"><?echo number_format($ter,2);?></td>
                    <td align="center"><?echo number_format($tt,2);?></td>
                </tr>
            <?}
        ?>
    </table>
</div>




<script type="text/javascript" src="../js/jquery.min.js"></script>
<script src="../js/table2excel.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $("#report").table2excel({
            filename: "LWF Return.xls"
        });
    });
</script>
</body>
</html>

