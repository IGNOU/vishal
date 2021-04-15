<!DOCTYPE html>
<html>
<head>
    <title>Over Time Registor</title>

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
    $y=$_REQUEST['y'];
    $m=$_REQUEST['m'];
    $e=$_REQUEST['e'];
    $b=$_REQUEST['b'];
    $clid=$_REQUEST['cl'];

    $ym=$y."-".$m;
      
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
        <tr>
            <td colspan="5">Name of Establishment</td>
            <td colspan="26"><b><?echo $data2['name'];?></b></td>
        </tr>
        <tr>
            <td colspan="5">Address of employer</td>
            <td colspan="26"><b><?echo $data2['address'];?></b></td>
        </tr>
        <tr>
            <td colspan="5">Year</td>
            <td colspan="26"><b><?echo date("M-Y",strtotime($ym));?></b></td>
        </tr>
        <tr>
            <td>#</td>
            <td>Emp code</td>
            <td>Name</td>
            <td>Category</td>
            <td>Designation</td>
            <?
                $a=4; $aa=1;
                while($a<=15)
                {
                    if($a<13)
                        $ya=$a;
                    else
                        $ya=$aa++;

                    $dateObj   = DateTime::createFromFormat('!m', $ya);
                    echo "<td align='center'>".$dateObj->format('F')."</td>";
                    $a++;
                }
            ?>
            <td align='center'>Total</td>
            <?
                $a=4; $aa=1;
                while($a<=15)
                {
                    if($a<13)
                        $ya=$a;
                    else
                        $ya=$aa++;

                    $dateObj   = DateTime::createFromFormat('!m', $ya);
                    echo "<td align='center'>".$dateObj->format('F')."</td>";
                    $a++;
                }
            ?>
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
                    <td><?= $category;?></td>
                    <td><?= $designation;?></td>
                    <?
                        $a=4; $aa=1; $Total_oth=0;
                        while($a<=15)
                        {
                            if($a<13)
                                $ya=$a;
                            else
                                $ya=$aa++;

                            if($ya==$m && $m!="")
                            {
                                $sql="SELECT * from salary where emp_code='$empcode' and year='$y' and month='$ya' and client_id='$clid'"; 
                                $sl=$con->query($sql);
                                $sr=mysqli_fetch_array($sl);
                                $Total_oth+=$sr['ot_hrs'];
                                echo "<td align='center'>".$sr['ot_hrs']."</td>";
                            }
                            elseif($m=="")
                            {
                                $sql="SELECT * from salary where emp_code='$empcode' and year='$y' and month='$ya' and client_id='$clid'"; 
                                $sl=$con->query($sql);
                                $sr=mysqli_fetch_array($sl);
                                $Total_oth+=$sr['ot_hrs'];
                                echo "<td align='center'>".$sr['ot_hrs']."</td>";
                            }
                            else
                            {
                                echo "<td></td>";
                            }
                            $a++;
                        }
                    ?>
                    <td align="center"><?echo number_format($Total_oth,2);?></td>
                    <?
                        $a=4; $aa=1; $Total_oth=0;
                        while($a<=15)
                        {
                            if($a<13)
                                $ya=$a;
                            else
                                $ya=$aa++;

                            if($ya==$m && $m!="")
                            {
                                $sql="SELECT * from salary where emp_code='$empcode' and year='$y' and month='$ya' and client_id='$clid'"; 
                                $sl=$con->query($sql);
                                $sr=mysqli_fetch_array($sl);
                                $Total_oth+=$sr['over_time'];
                                echo "<td align='center'>".$sr['over_time']."</td>";
                            }
                            elseif($m=="")
                            {
                                $sql="SELECT * from salary where emp_code='$empcode' and year='$y' and month='$ya' and client_id='$clid'"; 
                                $sl=$con->query($sql);
                                $sr=mysqli_fetch_array($sl);
                                $Total_oth+=$sr['over_time'];
                                echo "<td align='center'>".$sr['over_time']."</td>";
                            }
                            else
                            {
                                echo "<td></td>";
                            }
                            $a++;
                        }
                    ?>
                    <td align="center"><?echo number_format($Total_oth,2);?></td>
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
            filename: "Over Time Registor.xls"
        });
    });
</script>
</body>
</html>

