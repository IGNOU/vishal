<!DOCTYPE html>
<html>
<head>
    <title>Salary Slip</title>

    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap');
        table{
            width: 105%;
            border: 1px solid #ddd;
            border-collapse: collapse;
            margin-left: -20px;
            font-family: 'Roboto', sans-serif;
            font-size: .8em;
        }
        td{
            border: 1px solid #ddd;
            padding: 5px;
        }
        .name{
            font-size: 2em;
            font-weight: bold;
        }
        .logo{
            width: 100px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
<table>
    <tr>
        <td style="border-right: 1px solid #fff;">
            <?
                if($data2['logo']!="")
                {?>   
            `       <img src="img/<?echo $data2['logo'];?>" class="logo">
                <?}
            ?>
        </td>
        <td align="center">
            <span class="name"><?echo $data2['name'];?></span>
        </td>
    </tr>
    <tr>
        <td align="center" valign="top" colspan="2"><?echo $data2['address'];?></td>
    </tr>
</table>
<table>
    <tr>
        <td align="center" colspan="6" height="40"><b>Pay slip for the month of <?echo date('M-Y',strtotime($ym));?></b></td>
    </tr>
    <tr>
        <td width="60">EMP Code</td>
        <td width="95"><?echo $code=$row['empcode']?></td>
        <td width="57">Name</td>
        <td width="150"><?echo $row['name']?></td>
        <td width="30">Branch</td>
        <td><?echo $row['location']?></td>
    </tr>
    <tr>
        <td>Department</td>
        <td><?echo $row['department']?></td>
        <td>Designation</td>
        <td><?echo $row['designation']?></td>
        <td>UAN</td>
        <td><?echo $row['uan']?></td>
    </tr>
    <tr>
        <td>ESIC No.</td>
        <td><?echo $row['esi_code']?></td>
        <td>DOJ</td>
        <td><?echo date("d-M-Y",strtotime($row['doj']))?></td>
        <td>PF No.</td>
        <td><?echo $row['pf_code']?></td>
    </tr>
    <tr>
        <td>Bank A/C No.</td>
        <td><?echo $row['account']?></td>
        <td>Bank Name</td>
        <td><?echo $row['bank']?></td>
        <td colspan="2"></td>
    </tr>
</table>
<table>
    <?  
        $lv=mysqli_fetch_array($con->query("SELECT * from leave_update where client_id='$clientid' and emp_code='$code' and year='$y' and month='$m'"));
    ?>
    <tr>
        <td>Payable Days    :   <?echo $row2['pay_day'];?></td>
        <td>Opening Leave Bal:  <?echo $lv['el']+$lv['sl']+$lv['cl'];?></td>
        <td>Availed Leave:  <?echo $lv['el_l']+$lv['sl_l']+$lv['cl_l'];?></td>
        <td>Closing Leave Bal: <?echo ($lv['el']+$lv['sl']+$lv['cl'])-($lv['el_l']+$lv['sl_l']+$lv['cl_l']);?></td>
    </tr>
</table>
<table>
    <tr>
        <td>Particulars</td>
        <td align="right">Actual (Rs.)</td>
        <td align="right">Earnings (Rs.)</td>
    </tr>
    <?
        $sql="SELECT * from salary_breakup_amt where code='$code' and year='$y' and month='$m' and client_id='$clientid' order by sba_id asc";
        $re=$con->query($sql);
        $total=0; $total2=0;
        while($al=mysqli_fetch_array($re))
        {   $total+=$al['amt'];
            $total2+=$al['pay_amt'];

            ?>
            <tr>
                <td><?echo $al['alw'];?></td>
                <td align="right"><?echo number_format($al['amt'],2);?></td>
                <td align="right"><?echo number_format($al['pay_amt'],2);?></td>
            </tr>
        <?}

        $sql="SELECT variable,amt from salary_breakup,allowance where allowance=variable and emp_code='$code' and year='$y' and month='$m' and salary_breakup.client_id='$clientid' order by sbid asc";
        $re=$con->query($sql);
        while($al=mysqli_fetch_array($re))
        {   $total2+=$al['amt'];
            ?>
            <tr>
                <td><?echo $al['variable'];?></td>
                <td align="right"></td>
                <td align="right"><?echo number_format($al['amt'],2);?></td>
            </tr>
        <?}
    ?>
    <tr>
        <td>Bonus</td>
        <td align="right"></td> 
        <td align="right"><?echo $row2['bonus']; $total2+=$row2['bonus'];?></td> 
    </tr>
    <tr>
        <td>Over Time</td>
        <td align="right"></td> 
        <td align="right"><?echo $row2['over_time']; $total2+=$row2['over_time'];?></td> 
    </tr>
    <tr>
        <td>Leave Ench.</td>
        <td align="right"></td> 
        <td align="right"><?Echo $row2['leave_ench']; $total2+=$row2['leave_ench'];?></td> 
    </tr>
    <tr>
        <td><b>Total Gross Salary</b></td>
        <td align="right"><b><?echo number_format($total,2);?></b></td> 
        <td align="right"><b><?echo number_format(round($total2),2);?></b></td> 
    </tr>
    <tr>
        <td colspan="3"><b>Deductions</b></td>
    </tr>
    <tr>
        <td>PF</td>
        <td align="right"></td> 
        <td align="right"><?echo $row2['pf'];?></td> 
    </tr>
    <tr>
        <td>ESI</td>
        <td align="right"></td> 
        <td align="right"><?echo $row2['esi'];?></td> 
    </tr>
    <tr>
        <td>TDS</td>
        <td align="right"></td> 
        <td align="right"><?echo $row2['tds'];?></td> 
    </tr>
    <tr>
        <td>LWF</td>
        <td align="right"></td> 
        <td align="right"><?echo $row2['lwf'];?></td> 
    </tr>
    <?
        $dec=0;
        $sql="SELECT variable,amt from salary_breakup,deduction where deduction=variable and emp_code='$code' and year='$y' and month='$m' and salary_breakup.client_id='$clientid' order by sbid asc";
        $re=$con->query($sql);
        while($al=mysqli_fetch_array($re))
        {   $dec+=$al['amt'];
            ?>
            <tr>
                <td><?echo $al['variable'];?></td>
                <td align="right"></td>
                <td align="right"><?echo number_format($al['amt'],2);?></td>
            </tr>
        <?}
        $dec+=$row2['pf']+$row2['esi']+$row2['tds']+$row2['lwf'];
    ?>
    <tr>
        <td><b>Total Deduction</b></td>
        <td align="right"><b></td> 
        <td align="right"><b><?echo number_format($dec,2);?></b></td> 
    </tr>
    <tr>
        <td><b> Net Payable</b></td>
        <td align="right"><b></td> 
        <td align="right"><b><?echo number_format(round($row2['net_payable']),2);?></b></td> 
    </tr>
    <tr>
        <td colspan="3" align="center" height="50" valign="bottom">This is a computer generated salary slip. Signature not required</td>
    </tr>
</table>
</body>
</html>

