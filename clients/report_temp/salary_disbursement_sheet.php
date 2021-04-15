<!DOCTYPE html>
<html>
<head>
    <title>Salary disbursement sheet</title>

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
    $c=$_REQUEST['c'];
    $b=$_REQUEST['b'];
    $clid=$_REQUEST['cl'];

    $ym=$y."-".$m;

    $sql="select * from employee where client_id='$clid'";

    if($c!="")
        $sql .=" and category='$c'";
    if($b!="")
        $sql .=" and location='$b'";
    else
        $b="All";

    $sql.=" order by (emp_id) asc";

    $res=$con->query($sql);
?>

<div id="report">
    <table border="1"> 
        <tr>
            <td colspan="8">Payment disbursement sheet for the month of :-  <b><?echo date('M-Y',strtotime($ym));?></b></td>
        </tr>
        <tr>    
            <td colspan="8">Branch :-  <b><?echo $b;?></b></td>
        </tr>
        <tr>
            <td>#</td>
            <td>Emp code</td>
            <td>Name</td>
            <td>Bank Name</td>
            <td>Bank Branch</td>
            <td>Account No.</td>
            <td>IFSC Code </td>
            <td align="right">Amount</td>
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
                    <td><?= $bank;?></td>
                    <td><?= $branch;?></td>
                    <td>'<?= $account;?></td>
                    <td><?= $ifsc;?></td>
                    <td align="right">
                        <?
                            $sql="SELECT * from salary where emp_code='$empcode' and year='$y' and month='$m' and client_id='$clid'";
                            $sl=mysqli_fetch_array($con->query($sql));
                            echo number_format($sl['net_payable'],2);
                        ?>
                    </td>
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
            filename: "Salary disbursement sheet.xls"
        });
    });
</script>
</body>
</html>

