<?
    $sql="SELECT emp_allowance,amount from allowance,employee_breakup where allowance=emp_allowance and emp_code='$code' and allowance.client_id='$clientid' order by aid asc";
    $re=$con->query($sql);
    $atotal=0; $atotal2=0;
    while($al=mysqli_fetch_array($re))
    {   $atotal+=$al['amount'];
        $atotal2+=$al['amount']*12;
    }

    // PF
    $total_dec=0;
    $total_lib=0;
    $erpf_amt=0;
    $eresi_amt=0;
    $erlwf_amt=0;
    $erpt_amt=0;

    $pf_amt=0;
    if($row['pf']=='Y')
    {
        $sql="SELECT pf_limit,ee_pf,sum(amount),person_limit,er_pf,er_eps from com_pf,com_pf_allowance,employee_breakup where pfid=pf_id and emp_allowance=pf_allowance and emp_code='$code' and employee_breakup.client_id='$clientid'";
        $re=$con->query($sql);
        $remp=mysqli_fetch_array($re);
        $limit=$remp['0'];
        $share=$remp['1'];
        $amount=$remp['2'];

        $limit2=$remp['3'];
        $share2=$remp['4'];
        $share3=$remp['5'];

        if($amount>$limit)
        {   
            $pf_amt=round($limit*$share/100);
            $erpf=round($limit*$share2/100);
        }
        else
        { 
            $pf_amt=round($amount*$share/100);
            $erpf=round($amount*$share2/100);
        }

        if($amount>$limit2)
        {   
            $ereps=round($limit2*$share3/100);
        }
        else
        { 
            $ereps=round($amount*$share3/100);
        }
        $erpf_amt=$erpf+$ereps;
    }
    else
    {
        $pf_amt.".00";
    }
    $total_dec+=$pf_amt;
    $total_lib+=$erpf_amt;

    // ESI
    $esi_amt=0;
    if($row['esi']=='Y')
    {
        $sql="SELECT ee_share,sum(amount),er_share from com_esi,com_esi_allowance,employee_breakup where com_esi.esi_id=com_esi_allowance.esi_id and emp_allowance=esi_allowance and emp_code='$code' and employee_breakup.client_id='$clientid'";
        $re=$con->query($sql);
        $remp=mysqli_fetch_array($re);
        $share=$remp['0'];
        $share2=$remp['2'];
        $amount=$remp['1'];
        $esi_amt=round($amount*$share/100);
        $eresi_amt=round($amount*$share2/100);
    }
    else
    {
        $esi_amt;
        $eresi_amt;
    }
    $total_dec+=$esi_amt;
    $total_lib+=$eresi_amt;

    // LWF
    $lwf_amt=0;
    if($row['lwf']=='Y')
    {
        $state=$row['state'];
        $sql="SELECT lwf_id,ee_share,er_share from com_lwf where client_id='$clientid' and state='$state'";
        $re=$con->query($sql);
        $remp=mysqli_fetch_array($re);
        if($remp!="")
        {
            $lwf_id=$remp['0'];
            $c=mysqli_num_rows($con->query($sql="SELECT * from com_lwf_allowance where client_id='$clientid' and lwf_id='$lwf_id'"));
            if($c=='12')
            {
                $lwf_amt=$remp['1'];
                $erlwf_amt=$remp['2'];

            }
            else
            {
                $lwf_amt;
                $erlwf_amt;
            }
        }
        else
        {
            $lwf_amt;
            $erlwf_amt;
        }
    }
    else
    {
        $lwf_amt;
        $erlwf_amt;
    }
    $total_dec+=$lwf_amt;
    $total_lib+=$erlwf_amt;

    // PT
    $pt_amt=0;
    if($row['pt']=='Y')
    {
        $state=$row['state']; $flage=0;
        $sq="SELECT * from com_pt where client_id='$clientid' and state='$state'";
        $rep=$con->query($sq);
        while($pta=mysqli_fetch_array($rep))
        {
            $pid=$pta['pt_id'];
            $sallery=$pta['sallery'];
            $sallery_to=$pta['sallery_to'];
            $share=$pta['ee_share'];
            $share2=$pta['er_share'];

            $sql="SELECT sum(amount) from com_pt,com_pt_allowance,employee_breakup where com_pt.pt_id=com_pt_allowance.pt_id and emp_allowance=pt_allowance and employee_breakup.client_id='$clientid' and emp_code='$code' and com_pt.pt_id='$pid'";
            $remp=mysqli_fetch_array($con->query($sql));
            if($sallery<=$amount and $sallery_to>=$amount)
            {   $flage=1;
                $pt_amt=$share;
                $erpt_amt=$share2;
            }
        }
        if($flage==0)
        {
            $pt_amt;
            $erpt_amt;
        }
    }
    else
    {
        $pt_amt;
        $erpt_amt;
    }
    $total_dec+=$pt_amt;
    $total_lib+=$erpt_amt;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Appointment Letter</title>

    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap');
        table{
            width: 740px;
            border-collapse: collapse;
            margin-left: -20px;
            font-family: 'Roboto', sans-serif;
            font-size: .8em;
        }
        td{
            padding: 8px 5px;
        }
        .clear{clear: both;}
        .logo{
            margin-right: 20px;
        }
        .name{
            font-size: 2em;
            font-weight: bold;
        }
        .data{
            width: 755px;
            margin: 20px 0px;
            margin-left: -26px;
            font-family: 'Roboto', sans-serif;
            font-size: .8em;
        }
    </style>
</head>
<body>
<table style="margin-top: 150px;">
    <tr>
        <td align="center" colspan="4" height="40"><b style="font-size: 1.3em;"><u>Appointment Letter</u></b></td>
    </tr>
    <tr>
        <td>EMP Name</td>
        <td width="350"><?echo $row['name'];?></td>
        <td width="90">Date :- <?echo date('d-M-Y', strtotime($row['doj']));?></td>
    </tr>
    <tr>
        <td>EMP ID</td>
        <td><?echo $code=$row['empcode'];?></td>
        <td></td>
        <td></td>
    </tr>
</table>
<div class="data">
    Dear <b><?echo $row['name'];?></b>,  <br><br>                               
                                        
    We are pleased to offer you employment in our organization on the following terms & conditions:                                 
</div>
<table>
    <tr>
        <td width="120"><b>1. Date of  Joining :-</b></td>
        <td><?echo date('d-M-Y', strtotime($row['doj']));?></td>
    </tr>
    <tr>
        <td><b>2. Designation :-</b></td>
        <td><?echo $row['designation'];?></td>
    </tr>
    <tr>
        <td><b>3. Compensation :-</b></td>
        <td>Your annual Cost to the Company would be is Rs. <b><?echo ($atotal+$total_lib)*12;?> /-</b> as per attached annexure.</td>
    </tr>
    <tr>
        <td><b>4. Location :-</b></td>
        <td><?echo $row['location'];?></td>
    </tr>
</table>
<?echo html_entity_decode($apl['details']);?>
<table>
    <tr>
        <td colspan="2">
            We welcome you as a member of our organization.  We hope that our association will be a mutually happy and rewarding one.<br><br>

            Please sign and return the duplicate copy of this letter in token of your acceptance of the above terms and conditions, at the earliest.<br><br><br>
        </td>
    </tr>
    <tr>
        <td>
            <b>For <?echo $data2['name'];?></b><br><br><br><br><br><br>
            Authorized Signatory  
        </td>
        <td align="center">
            Accepted by<br><br><br><br><br><br>
            Signature of Employee<br>
            <?echo $row['name'];?>
        </td>
    </tr>
    <tr>
        <td></td>
        <td align="center"><br><br><br><br>Witness Signature<br>Name................<br>Emp ID................<br>Mobile No.............</td>
    </tr>
    <tr>
        <td colspan="2"><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></td>
    </tr>
</table>
<table>
    <tr>
        <td colspan="3" align="center"><b style="font-size: 1.3em; text-decoration: underline;">Annexure</b><br><br></td>
    </tr>
    <tr>
        <td width="100">Name</td>
        <td width="50" align="center"> : </td>
        <td><?echo $row['name'];?></td> 
    </tr>
    <tr>
        <td width="100">Designation</td>
        <td width="50" align="center"> : </td>
        <td><?echo $row['designation'];?></td>
    </tr>
    <tr>      
        <td width="100">Department</td>
        <td width="50" align="center"> : </td>
        <td><?echo $row['department'];?></td>   
    </tr>
    <tr> 
        <td width="100">Date of Birth</td>
        <td width="50" align="center"> : </td>
        <td><?echo date('d-M-Y', strtotime($row['dob']));?></td> 
    </tr>
    <tr>    
        <td width="100">DOJ</td>
        <td width="50" align="center"> : </td>
        <td><?echo date('d-M-Y', strtotime($row['doj']));?></td>
    </tr>
</table>

<table border="1">
    <tr>
        <td width="300">Allowances</td>
        <td align="right"><b>Monthly</b></td>
        <td align="right"><b>Annual</b></td>
    </tr>
    <?
        $sql="SELECT emp_allowance,amount from allowance,employee_breakup where allowance=emp_allowance and emp_code='$code' and allowance.client_id='$clientid' order by aid asc";
        $re=$con->query($sql);
        $total=0; $total2=0;
        while($al=mysqli_fetch_array($re))
        {   $total+=$al['amount'];
            $total2+=$al['amount']*12;
            ?>
            <tr>
                <td><?echo $al['emp_allowance'];?></td>
                <td align="right"><?echo number_format($al['amount'],2);?></td>
                <td align="right"><?echo number_format($al['amount']*12,2);?></td>
            </tr>
        <?}
    ?>
    <tr>
        <td><b>Total</b></td>
        <td align="right"><b><?echo number_format($total,2);?></b></td>
        <td align="right"><b><?echo number_format($total2,2);?></b></td>
    </tr>
</table><br>

<table border="1">
    <tr>
        <td width="300"><b>Deduction</b></td>
        <td align="right"></td>
        <td align="right"></td>
    </tr>
    <tr>
        <td>PF</td>
        <td align="right"><?echo $pf_amt;?>.00</td>
        <td align="right"><?echo $pf_amt*12;?>.00</td>
    </tr>
    <tr>
        <td>ESIC</td>
        <td align="right"><?echo $esi_amt;?>.00</td>
        <td align="right"><?echo $esi_amt*12;?>.00</td>
    </tr>
    <tr>
        <td>LWF</td>
        <td align="right"><?echo $lwf_amt;?></td>
        <td align="right"><?echo $lwf_amt*12;?>.00</td>
    </tr>
    <tr>
        <td>PT</td>
        <td align="right"><?echo $pt_amt;?></td>
        <td align="right"><?echo $pt_amt*12;?>.00</td>
    </tr>
    <tr>
        <td><b>Total Deduction</b></td>
        <td align="right"><b><?echo $total_dec;?>.00</b></td>
        <td align="right"><b><?echo $total_dec*12;?>.00</b></td>
    </tr>
</table><br>


<table border="1">
    <tr>
        <td width="300"><b>Liabilites</b></td>
        <td align="right"></td>
        <td align="right"></td>
    </tr>
    <tr>
        <td>PF</td>
        <td align="right"><?echo $erpf_amt;?>.00</td>
        <td align="right"><?echo $erpf_amt*12;?>.00</td>
    </tr>
    <tr>
        <td>ESIC</td>
        <td align="right"><?echo $eresi_amt;?>.00</td>
        <td align="right"><?echo $eresi_amt*12;?>.00</td>
    </tr>
    <tr>
        <td>LWF</td>
        <td align="right"><?echo $erlwf_amt;?></td>
        <td align="right"><?echo $erlwf_amt*12;?>.00</td>
    </tr>
    <tr>
        <td>PT</td>
        <td align="right"><?echo $erpt_amt;?></td>
        <td align="right"><?echo $erpt_amt*12;?>.00</td>
    </tr>
    <tr>
        <td><b>Employer Contribution</b></td>
        <td align="right"><b><?echo $total_lib;?>.00</b></td>
        <td align="right"><b><?echo $total_lib*12;?>.00</b></td>
    </tr>
</table><br>
<table border="1">
    <tr>
        <td width="300"><b>Net Take Home</b></td>
        <td align="right"><?echo $total-$total_dec;?>.00</td>
        <td align="right"><?echo ($total+$total_dec)*12;?>.00</td>
    </tr>
    <tr>
        <td><b>CTC</b></td>
        <td align="right"><?echo $total+$total_lib;?>.00</td>
        <td align="right"><?echo ($total+$total_lib)*12;?>.00</td>
    </tr>
</table>
</body>
</html>

