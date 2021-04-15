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
    $y=$_REQUEST['y'];
    $m=$_REQUEST['m'];
    $e=$_REQUEST['e'];
    $b=$_REQUEST['b'];
    $clid=$_REQUEST['cl'];

    $ym=$y."-".$m;

    $sql="SELECT empcode,name,location,category,state,pt_alw_pay,salary.pt,er_pt from employee,salary where empcode=emp_code and employee.pt='Y' and year='$y' and month='$m' and employee.client_id='$clid'";
    if($e!="")
        $sql .=" and empcode='$e'";
    if($b!="")
        $sql .=" and location='$b'";
        
    $sql.="order by (emp_id) asc";

    $res=$con->query($sql);
?>

<div id="report">
    <h2 align="center">P Tax Monthaly Return</h2>
    <table border="1"> 
        <tr>
            <td colspan="10">P Tax Report for the month of : <b><?echo date("M-Y",strtotime($ym));?></b></td>
        </tr>
        <tr>
            <td>#</td>
            <td>Emp code</td>
            <td>Name</td>
            <td>Branch</td>
            <td>Category</td>
            <td>State</td>
            <td>Salary</td>
            <td align='center'>EMP. P Tax</td>
            <td align='center'>Employer</td>
            <td align='center'>Total</td>
        </tr>
        <?  
            $i=1;
            while($row=mysqli_fetch_array($res))
            {   //extract($row);
                ?>
                <tr>
                    <td><?echo $i++;?></td>
                    <td><?= $row[0];?></td>
                    <td><?= $row[1];?></td>
                    <td><?= $row[2];?></td>
                    <td><?= $row[3];?></td>
                    <td><?= $row[4];?></td>
                    <td><?= $row[5];?></td>
                    <td><?= $row[6];?></td>
                    <td><?= $row[7];?></td>
                    <td><?= $row[6]+$row[7];?></td>
                </tr>
            <?}
        ?>
    </table>
</div>




<script type="text/javascript" src="../js/jquery.min.js"></script>
<script src="../js/table2excel.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        // $("#report").table2excel({
        //     filename: "LWF Return.xls"
        // });
    });
</script>
</body>
</html>

