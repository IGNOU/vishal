<!DOCTYPE html>
<html>
<head>
    <title>ESI Upload</title>

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
?>

<div id="report">
    <h1 align="center">ESI UPload</h1>
    <table border="1"> 
        <tr>
            <td colspan="2">Year</td>
            <td colspan="5"><b><?echo date('M-Y',strtotime($ym));?></b></td>
        </tr>
        <tr>
            <td>#</td>
            <td>IP Number</td>
            <td>IP Name</td>
            <td align="center">No of Days for which wages paid/payable during the month</td>
            <td align="center">Total Monthly Wages</td>
            <td>Reason Code for Zero workings days(numeric only; provide 0 for all other reasons- Click on the link for reference)</td>
            <td>" Last Working Day ( Format DD/MM/YYYY  or DD-MM-YYYY)"</td>
        </tr>
        <?
        $sql="select * from employee where esi_code>0 and client_id='$clid'";
        if($e!="")
            $sql .=" and empcode='$e'";
        if($b!="")
            $sql .=" and location='$b'";
        $sql.="order by (emp_id) asc";
        $res=$con->query($sql); $i=1;

        while($row=mysqli_fetch_array($res))
        {   
            extract($row);
            ?>
            <tr>
                <td><?= $i++;?></td>
                <td><?= $esi_code;?></td>
                <td><?= $name;?></td>
                <?
                    $sql2="select * from salary where emp_code='$empcode' and year='$y' and month='$m' and client_id='$clid' ";
                    $res2=$con->query($sql2);
                    $row2=mysqli_fetch_array($res2);
                ?>
                <td align="center"><?echo $row2['pay_day'];?></td>
                <td align="center"><?echo $row2['net_payable'];?></td>
                <td></td>
                <td><?= $dol;?></td>
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
            filename: "ESI Upload.xls"
        });
    });
</script>
</body>
</html>

