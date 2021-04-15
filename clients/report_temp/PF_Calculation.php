<!DOCTYPE html>
<html>
<head>
    <title>PF Calculation</title>

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

    $sql="select * from com_pf where client_id='$clid'";
    $respf=$con->query($sql);
    $compf=mysqli_fetch_array($respf);

    $sql="select * from employee where pf='Y' and client_id='$clid' order by (emp_id) asc";
    $res=$con->query($sql);
    $pf_count=mysqli_num_rows($res);

    $com_share_ac1=0; $emp_share_ac1=0; $epf=0; $eps_total=0; $pension_ac10=0; $com_share_ac21=0; $edli_total=0;
    $pns_count=0; $edli_count=0;
    while($row=mysqli_fetch_array($res))
    {
        extract($row);
        $sql2="select * from salary where emp_code='$empcode' and year='$y' and month='$m' and client_id='$clid' ";
        $res2=$con->query($sql2);
        $row2=mysqli_fetch_array($res2);

        $eps=0; $epf_cont=0; $eps_cont=0;
        if($row2['pf_alw_pay']>$compf['person_limit'])
            $eps=round($compf['person_limit']);
        else
            $eps=round($row2['pf_alw_pay']);
        $eps_total+=$eps;

        $edli=0;
        date_default_timezone_set('Asia/Kolkata');
        $today = $y."-".$m."-".$d;
        $diff = date_diff(date_create($dob), date_create($today));
        $oy=$diff->format('%y');
        if($oy>58)
            $edli;
        else
        {
            $edli=$eps;
            $edli_count++;
        }
        $edli_total+=$edli;

        $epf+=round($row2['pf_alw_pay']);
        $com_share_ac21+=$eps;
        $emp_share_ac1+=$epf_cont=round($eps*$compf['ee_pf']/100);

        if($pension=='Y')
        {
            $pension_ac10+=$eps_cont=round($eps*$compf['er_eps']/100);
            $pns_count++;
        }
        else
            $eps_cont;

        $com_share_ac1+=$epf_cont-$eps_cont;
    }
?>

<div id="report">
    <h1 align="center">PF Challan</h1>
    <table>
        <tr>
            <td>Month Of</td>
            <td></td>
            <td>EPF</td>
            <td>EPS</td>
            <td>EDLI</td>
        </tr>
        <tr>
            <td><b><?echo date('M-Y',strtotime($ym));?></b></td>
            <td>Wages</td>
            <td><?echo $epf;?></td>
            <td><?echo $eps_total;?></td>
            <td><?echo $edli_total;?></td>
        </tr>
        <tr>
            <td></td>
            <td>EMP</td>
            <td><?Echo $pf_count;?></td>
            <td><?echo $pns_count;?></td>
            <td><?echo $edli_count;?></td>
        </tr>
    </table><br>
    <table border="1"> 
        <tr>
            <td>#</td>
            <td>PARTICULARS</td>
            <td>A/C NO. 1</td>
            <td>A/C NO. 2</td>
            <td>A/C NO. 10</td>
            <td>A/C NO. 21</td>
            <td>A/C NO. 22</td>
            <td>TOTAL</td>
        </tr>
        <tr>
            <td>1</td>
            <td>EMPLOYER'S SHARE OF CONTRIBUTION</td>
            <td><?echo $com_share_ac1;?></td>
            <td></td>
            <td><?echo $pension_ac10;?></td>
            <td><?echo $e21=round($edli_total*$compf['edli21']/100);?></td>
            <td></td>
            <td><?echo $com_share_ac1+$pension_ac10+$e21;?></td>
        </tr>
        <tr>
            <td>2</td>
            <td>EMPLOYEE'S SHARE OF CONTRIBUTION</td>
            <td><?echo $emp_share_ac1;?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><?echo $emp_share_ac1;?></td>
        </tr>
        <tr>
            <td>3</td>
            <td>ADMINISTRATIVE SHARGES</td>
            <td></td>
            <td><?echo $ad=round($epf*$compf['admin']/100);?></td>
            <td></td>
            <td></td>
            <td></td>
            <td><?echo $ad;?></td>
        </tr>
        <tr>
            <td>4</td>
            <td>INSPECTION CHARGES</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><?echo $ip=round($edli_total*$compf['edli22']/100);?></td>
            <td><?echo $ip;?></td>
        </tr>
        <tr>
            <td>5</td>
            <td>PENAL DAMAGES</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>0</td>
        </tr>
        <tr>
            <td>6</td>
            <td>MISC PAYMENT</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>0</td>
        </tr>
        <tr>
            <td></td>
            <td>Total</td>
            <td><?echo $a=$com_share_ac1+$emp_share_ac1;?></td>
            <td><?echo $b=$ad;?></td>
            <td><?echo $c=$pension_ac10;?></td>
            <td><?echo $d=$e21;?></td>
            <td><?echo $e=$ip;?></td>
            <td><?echo $a+$b+$c+$d+$e;?></td>
        </tr>
        
    </table>
</div>




<script type="text/javascript" src="../js/jquery.min.js"></script>
<script src="../js/table2excel.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $("#report").table2excel({
            filename: "PF Challan.xls"
        });
    });
</script>
</body>
</html>

