<!DOCTYPE html>
<html>
<head>
    <title>Attendance & Over Time Smaple Fromate</title>

    <style type="text/css">
        table{
            border: 1px solid #333;
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
    $m=$_REQUEST["m"];
    $y=$_REQUEST["y"];

    session_start();
    if(!$_SESSION['cu'])
        echo "<script>window.location.href='logout.php';</script>";

    $sesuser=$_SESSION['cu'];

    include('extra/connect.php');
    $data=mysqli_fetch_array($con->query("select * from client where email='$sesuser'"));
    $clientid=$data['cid'];

    $ym=$y."-".$m;
    $d=cal_days_in_month(CAL_GREGORIAN,$m,$y);
    $a=1;
    
    $sql="select * from employee where dol='' and client_id='$clientid' order by (emp_id) asc";
    $res=$con->query($sql);

    $count=0;
?>

<div id="report">
    <table class="table">
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
    <table class="table"> 
        <tr>
            <td colspan="<?echo $d+12;?>">Attendance Details</td>
            <td colspan="<?echo $d+1;?>">Over Time Details</td>
        </tr>
        <tr>
            <td>#</td>
            <td>Emp Id</td>
            <td>Name</td>
            <td>DOJ (YYYY-MM-DD)</td>
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
            <td>Total</td>
        </tr>
        <?  
            $i=1;
            while($row=mysqli_fetch_array($res))
            {   $aa=1; $eid=$row['emp_id'];
                ?>
                <tr>
                    <td><?echo $i++;?></td>
                    <td><?echo $row['empcode'];?></td>
                    <td><?echo $name=$row['name'];?></td>
                    <td><?echo $row['doj'];?></td>
                    <?
                        $a=1;
                        while($a<=$d)
                        {
                            echo "<td width='50' align='center'></td>";
                            $a++;
                        }
                    ?>
                    <td width="50" align="center"></td>
                    <td width="50" align="center"></td>
                    <td width="50" align="center"></td>
                    <td width="50" align="center"></td>
                    <td width="50" align="center"></td>
                    <td width="50" align="center"></td>
                    <td width="50" align="center"></td>
                    <td width="50" align="center"></td>
                    </td>
                    <?
                        $a=1;
                        while($a<=$d)
                        {
                            echo "<td width='50' align='center'></td>";
                            $a++;
                        }
                    ?>
                    <td></td>
                </tr>
            <?}
        ?>
    </table>
</div>


<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="js/table2excel.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $("#report").table2excel({
            filename: "Attendance & Over Time Smaple Fromate.xls"
        });
    });
</script>
</body>
</html>