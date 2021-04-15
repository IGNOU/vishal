<!DOCTYPE html>
<html>
<head>
    <title>PF ECR</title>

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

    $d=cal_days_in_month(CAL_GREGORIAN,$m,$y);
?>

<div id="report">
    <table border="1"> 
        <tr style="font-weight: bold;">
            <td>Year</td>
            <td colspan="10"><?echo date('M-Y',strtotime($ym));?></td>
        </tr>
        <tr>
            <td>UAN</td>
            <td>Member Name</td>
            <td>Gross Wages</td>
            <td>EPF Wages</td>
            <td>EPS Wages</td>
            <td>EDLI Wages</td>
            <td>EPF Contribution</td>
            <td>EPS Contribution</td>
            <td>EPF-EPS Diff</td>
            <td>NCP Days</td>
            <td>Refund_of_Avance</td>
        </tr>
        <?
        $sql="select * from com_pf where client_id='$clid'";
        $respf=$con->query($sql);
        $compf=mysqli_fetch_array($respf);

        $sql="select * from employee where pf='Y' and client_id='$clid' order by (emp_id) asc";
        $res=$con->query($sql); $i=1;

        while($row=mysqli_fetch_array($res))
        {   
            $epf_cont=0; $eps_cont=0;
            extract($row);
            ?>
            <tr>
                <td><?= $uan;?></td>
                <td><?= $name;?></td>
                <?
                    $sql2="select * from salary where emp_code='$empcode' and year='$y' and month='$m' and client_id='$clid' ";
                    $res2=$con->query($sql2);
                    $row2=mysqli_fetch_array($res2);
                ?>
                <td><?echo round($row2['gross_salary']);?></td>
                <td><?echo round($row2['pf_alw_pay']);?></td>
                <td>
                    <?
                        $eps=0;
                        if($row2['pf_alw_pay']>$compf['person_limit'])
                            echo $eps=round($compf['person_limit']);
                        else
                            echo $eps=round($row2['pf_alw_pay']);
                    ?>
                </td>
                <td>
                    <? 
                        $edli=0;
                        date_default_timezone_set('Asia/Kolkata');
                        $today = $y."-".$m."-".$d;
                        $diff = date_diff(date_create($dob), date_create($today));
                        $oy=$diff->format('%y');
                        if($oy>58)
                            echo $edli;
                        else
                            echo $edli=$eps;
                    ?>
                </td>
                <td><? echo $epf_cont=round($eps*$compf['ee_pf']/100);?></td>
                <td>
                    <?
                        if($pension=='Y')
                            echo $eps_cont=round($eps*$compf['er_eps']/100);
                        else
                            echo $eps_cont;
                    ?>
                </td>
                <td><?= $epf_cont-$eps_cont;?></td>
                <td><?= $d-$row2['pay_day'];?></td>
                <td></td>
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
            filename: "PF ECR.xls"
        });
    });
</script>
</body>
</html>

