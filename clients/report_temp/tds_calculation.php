<!DOCTYPE html>
<html>
<head>
    <title>TDS Calculation</title>

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

    $sql.=" order by (emp_id) asc";
    $res=$con->query($sql);

    $stds=($y-1); $stdl=$y;
?>

<div id="report">
    <table border="1"> 
        <tr>
            <td colspan="9" align="center">Gratuity Calculation for the year <b><?echo date('M-Y',strtotime($ym));?></b></td> 
        </tr>
        <tr>
            <td>Annual Salary Allowance</td>
            <td colspan="2">Amount</td>
        </tr>
        <?  
            $i=1;
            while($row=mysqli_fetch_array($res))
            {   
                extract($row); $gross=0;
                $sql="SELECT month,sum(bonus) from salary where emp_code='$empcode' and client_id='$clid' and year between '$stds' and '$stdl'";
                $sl=mysqli_fetch_array($con->query($sql));

                $s="select * from com_incometax_emp where emp_code='$empcode' and client_id='$clid' and year between '$stds' and '$stdl'";
                $cie=mysqli_fetch_array($con->query($s));

                $sql="SELECT code,alw,sum(pay_amt) from salary_breakup_amt where code='$empcode' and client_id='$clid' and year between '$stds' and '$stdl' group by alw";
                $re=$con->query($sql);
                while($al=mysqli_fetch_array($re))
                {   $gross+=$al['2'];
                ?>
                    <tr>
                        <td><?echo $al['1'];?></td>
                        <td align="right"><?echo $al['2'];?></td>
                    </tr>
                <?}

                $sql="SELECT emp_code,variable,sum(amt) from salary_breakup,com_incometax_allowance where variable=alw and emp_code='$empcode' and salary_breakup.client_id='$clid' and year between '$stds' and '$stdl' group by alw";
                $re=$con->query($sql);
                while($al=mysqli_fetch_array($re))
                {   $gross+=$al['2'];
                ?>
                    <tr>
                        <td><?echo $al['1'];?></td>
                        <td align="right"><?echo $al['2'];?></td>
                    </tr>
                <?}
            }
        ?>
        <tr>
            <td>Bonus</td>
            <td align="right"><? echo $sl['1'];?></td>
        </tr>
        <tr>
            <td>Other Salary</td>
            <td align="right"><? echo $cie['other'];?></td>
        </tr>
    </table>
</div>




<script type="text/javascript" src="../js/jquery.min.js"></script>
<script src="../js/table2excel.js" type="text/javascript"></script>
<script type="text/javascript">
    // $(function () {
    //     $("#report").table2excel({
    //         filename: "Gratuity Calculation.xls"
    //     });
    // });
</script>
</body>
</html>

