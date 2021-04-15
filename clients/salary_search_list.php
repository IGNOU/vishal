
<?
    include('extra/connect.php');
    $y=$_REQUEST['year'];
    $m=$_REQUEST['month'];
    $clientid=$_REQUEST['cl'];
    
    $ym=$y."-".$m;
    $sql="select * from employee where client_id=$clientid order by (emp_id) asc";
    $res=$con->query($sql);


    $sql="SELECT name,designation,doj,category,department,location,slid,emp_code, pay_day, ot_hrs, gross, salary.bonus, over_time, gross_salary, salary.pf, salary.esi, salary.tds, salary.pt, salary.lwf, total_dec, net_payable, er_pf, er_esi, er_pt, er_lwf, paid_ctc from salary,employee where emp_code=empcode and salary.client_id='$clientid' and year='$y' and month='$m'";
    $res=$con->query($sql); 
?>

<div class="col-sm-8 pad0" style="font-size: 1.2em;">
    Result :- <b><?echo date("M-Y",strtotime($ym));?></b> &nbsp; Total Record : <?echo mysqli_num_rows($res);?> 
</div>
<div class="col-sm-4 pad0 text-right">
    <a href="#" onclick='JSconfirm(<?php echo $y;?>,<?php echo $m;?>)' title="Delete Record" class="batt btn"><i class="fa fa-trash" style="color: #FFF;"></i> Delete All</a>
</div>

<div class="col-sm-12 pad0" style="overflow: auto; padding-top: 10px;">
    <table class="table3 table-bordered" style="width: 320%;"> 
        <thead>
            <tr>
                <td>#</td>
                <td>Emp Id</td>
                <td>Name</td>
                <td>Designation</td>
                <td>DOJ</td>
                <td>Category</td>
                <td>Department</td>
                <td>Branch</td>
                <td align="center">Piad Days</td>
                <td align="center">OT Hrs.</td>
                <?
                    $sql="SELECT * from allowance where type='Fix' order by aid asc";
                    $re=$con->query($sql);
                    while($al=mysqli_fetch_array($re))
                    {?>
                        <td align="right"><?echo $al['allowance'];?></td>
                    <?}
                ?>
                <td align="right">Gross</td>
                <?
                    $sql="SELECT * from allowance where type='Fix' order by aid asc";
                    $re=$con->query($sql);
                    while($al=mysqli_fetch_array($re))
                    {?>
                        <td align="right"><?echo $al['allowance'];?></td>
                    <?}

                    $sql="SELECT * from allowance where type='Variable' order by aid asc";
                    $re=$con->query($sql);
                    while($al=mysqli_fetch_array($re))
                    {?>
                        <td align="right" style="text-transform: capitalize;"><?echo $al['allowance'];?></td>
                    <?}

                    $sql="SELECT * from com_bonus where client_id='$clientid'";
                    $re=$con->query($sql);
                    $al=mysqli_fetch_array($re);
                    if($al!="")
                    {?>
                        <td align="right" style="text-transform: capitalize;">Bonus</td>
                    <?}
                ?>
                <td>Over Time</td>
                <td>Gross salary</td>
                <?
                    $sql="SELECT * from com_pf where client_id='$clientid'";
                    $re=$con->query($sql);
                    $pf=mysqli_fetch_array($re);
                    if($pf){?>
                        <td>PF</td>
                    <?}
                
                    $sql="SELECT * from com_esi where client_id='$clientid'";
                    $re=$con->query($sql);
                    $esi=mysqli_fetch_array($re);
                    if($esi){?>
                        <td>ESI</td>
                    <?}
                ?>
                    <td>TDS</td>
                <?
                    $sql="SELECT * from com_pt where client_id='$clientid'";
                    $re=$con->query($sql);
                    $pt=mysqli_fetch_array($re);
                    if($pt){?>
                        <td>PT</td>
                    <?}

                    $sql="SELECT * from com_lwf where client_id='$clientid'";
                    $re=$con->query($sql);
                    $lwf=mysqli_fetch_array($re);
                    if($lwf){?>
                        <td>LWF</td>
                    <?}

                    $sql="SELECT * from deduction where client_id='$clientid'";
                    $re=$con->query($sql);
                    while($dec=mysqli_fetch_array($re))
                    {?>
                        <td><?echo $dec['deduction'];?></td>
                    <?}
                ?>
                <td>Total Dec.</td>
                <td>Net Payable</td>
                <td>Status</td>
                <td>ER PF</td>
                <td>ER ESI</td>
                <td>ER PT</td>
                <td>ER LWF</td>
                <td>Paid CTC</td>
            </tr>
        </thead>
        <tbody>
            <?
                $i=1;
                while($row=mysqli_fetch_array($res)) 
                {   $slid=$row['slid'];
                ?>
                    <tr>
                        <td><?echo $i++;?></td>
                        <td><?echo $code=$row['emp_code'];?></td>
                        <td><?echo $row['name'];?></td>
                        <td><?echo $row['designation'];?></td>
                        <td><?echo date('d-m-Y', strtotime($name=$row['doj']));?></td>
                        <td><?echo $row['category'];?></td>
                        <td><?echo $row['department'];?></td>
                        <td><?echo $row['location'];?></td>
                        <td><?echo $row['pay_day'];?></td>
                        <td><?echo $row['ot_hrs'];?></td>
                        <?
                            $s=$con->query("SELECT * from salary_breakup_amt where slid='$slid'");
                            while($sb=mysqli_fetch_array($s))
                            {?>
                                <td><?echo $sb['amt'];?></td>
                            <?}
                        ?>
                        <td><?echo $row['gross'];?></td>
                        <?
                            $s=$con->query("SELECT * from salary_breakup_amt where slid='$slid'");
                            while($sb=mysqli_fetch_array($s))
                            {?>
                                <td><?echo $sb['pay_amt'];?></td>
                            <?}
                            $sq="SELECT amt from salary_breakup,allowance where allowance=variable and emp_code='$code'and year='$y' and month='$m' and salary_breakup.client_id='$clientid'";
                            $s=$con->query($sq);
                            while($sb=mysqli_fetch_array($s))
                            {?>
                                <td><?echo $sb['amt'];?></td>
                            <?}
                        ?>
                        <td><?echo $row['bonus'];?></td>
                        <td><?echo $row['over_time'];?></td>
                        <td><?echo $row['gross_salary'];?></td>
                        <td><?echo $row['pf'];?></td>
                        <td><?echo $row['esi'];?></td>
                        <td><?echo $row['tds'];?></td>
                        <td><?echo $row['pt'];?></td>
                        <td><?echo $row['lwf'];?></td>
                        <?
                            $sq="SELECT amt from salary_breakup,deduction where deduction=variable and emp_code='$code'and year='$y' and month='$m' and salary_breakup.client_id='$clientid'";
                            $s=$con->query($sq);
                            while($sb=mysqli_fetch_array($s))
                            {?>
                                <td><?echo $sb['amt'];?></td>
                            <?}
                        ?>
                        <td><?echo $row['total_dec'];?></td>
                        <td><?echo $row['net_payable'];?></td>
                        <td></td>
                        <td><?echo $row['er_pt'];?></td>
                        <td><?echo $row['er_esi'];?></td>
                        <td><?echo $row['er_pt'];?></td>
                        <td><?echo $row['er_lwf'];?></td>
                        <td><?echo $row['paid_ctc'];?></td>
                    </tr>
                <?}
            ?>
            <tr class='notfound'>
                <td colspan='50'>No record found</td>
            </tr>
        </tbody>
    </table>
</div>