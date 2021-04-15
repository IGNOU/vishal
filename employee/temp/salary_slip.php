
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
            font-size: 1.8em;
            font-weight: bold;
        }
    </style>
</head>
<body>
<table>
    <tr>
        <?
            if($data2['logo']=="")
            {?>
                <td colspan="2" align="center"><span class="name"><?echo $data2['name'];?></span></td>
            <?}
            else
            {?>
                <td align="center"><img src="clients/img/<?echo $data2['logo'];?>" class="logo"></td>
                <td><span class="name"><?echo $data2['name'];?></span></td>
            <?}
        ?>
        
    </tr>
    <tr>
        <td align="center" valign="top" colspan="2"><?echo $data2['address'];?></td>
    </tr>
</table>
<table>
    <tr>
        <td align="center" colspan="6" height="40"><b>Pay slip for the month of <?echo date("M-Y",strtotime($ym));?></b></td>
    </tr>
    <tr>
        <td>EMP Code</td>
        <td><?echo $code=$data['empcode']?></td>
        <td>Name</td>
        <td><?echo $data['name']?></td>
        <td>Branch</td>
        <td><?echo $data['location']?></td>
    </tr>
    <tr>
        <td>Department</td>
        <td><?echo $data['department']?></td>
        <td>Designation</td>
        <td><?echo $data['designation']?></td>
        <td>UAN</td>
        <td><?echo $data['uan']?></td>
    </tr>
    <tr>
        <td>ESIC No.</td>
        <td><?echo $data['esi_code']?></td>
        <td>Date Of Joining</td>
        <td><?echo date("d-M-Y",strtotime($data['doj']))?></td>
        <td>PF No.</td>
        <td><?echo $data['pf_code']?></td>
    </tr>
    <tr>
        <td>Bank A/C No.</td>
        <td><?echo $data['account']?></td>
        <td>Bank Name</td>
        <td><?echo $data['bank']?></td>
        <td colspan="2"></td>
    </tr>
</table>
<table>
    <tr>
        <td>Payable Days    :   <?Echo $row2['pay_day'];?></td>
        <td>Opening Leave Bal:  0   </td>
        <td>Availed Leave:  0   </td>
        <td>Closing Leave Bal: 0</td>
    </tr>
</table>
<table>
    <tr>
        <td>Particulars</td>
        <td align="right">Actual (Rs.)</td>
        <td align="right">Earnings (Rs.)</td>
    </tr>
    <?
        $sql="SELECT * from salary_breakup_amt where slid='$id' order by sba_id asc";
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
        <td><b>Total</b></td>
        <td align="right"><b><?echo number_format($total,2);?></b></td> 
        <td align="right"><b><?echo number_format($total2,2);?></b></td> 
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
        <td><b> Employee Net Pay</b></td>
        <td align="right"><b></td> 
        <td align="right"><b><?echo number_format($total2-$dec,2);?></b></td> 
    </tr>
    <tr>
        <td colspan="3" align="center" height="50" valign="bottom">This is a computer generated salary slip. Signature not required</td>
    </tr>
</table>
</body>
</html>

