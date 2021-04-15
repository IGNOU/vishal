
<?
    date_default_timezone_set('Asia/Kolkata');
    $dt=date('Y-m-d');
    include('extra/connect.php');
    $y=$_REQUEST['year'];
    $m=$_REQUEST['month'];
    $clientid=$_REQUEST['cl'];


    $ym=$y."-".$m;
    $d=cal_days_in_month(CAL_GREGORIAN,$m,$y);

    switch ($m) {
        case '1':
            $mmulti=3;
            //$stds=($y-1); $stdl=$y;
            break;
        case '2':
            $mmulti=2;
            break;
        case '3':
            $mmulti=1;
            break;
        case '4':
            $mmulti=12;
            break;
        case '5':
            $mmulti=11;
            break;
        case '6':
            $mmulti=10;
            break;
        case '7':
            $mmulti=9;
            break;
        case '8':
            $mmulti=8;
            break;
        case '9':
            $mmulti=7;
            break;
        case '10':
            $mmulti=6;
            break;
        case '11':
            $mmulti=5;
            break;
        case '12':
            $mmulti=4;
            break;

        default:
            break;
    }



    $sql="select * from employee where client_id=$clientid order by (emp_id) asc";
    $res=$con->query($sql);

    $ss=mysqli_fetch_array($con->query("SELECT * from salary where year='$y' and month='$m' and client_id='$clientid'"));

    if(!$ss)
    {
        $as="SELECT * from attendance where year='$y' and month='$m' and client_id='$clientid'";
        $ar=mysqli_num_rows($con->query($as));
        if($ar>0)
        {
        ?>
        <div class="page_details">
            <div class="col-sm-12 pad15_line">
                <div class="col-sm-6 col-xs-12 pad0">
                    <div class="headding">Salary List ( <b><?echo date("M-Y",strtotime($ym));?></b>)</div>
                </div>
                <div class="col-sm-6 text-right">
                </div>
                <div class="clear"></div>
            </div>
            <div class="col-sm-12 pad15">
                <div style="overflow: auto;">
                    <input type="hidden" name="y" id="y" value="<?echo $y;?>">
                    <input type="hidden" name="m" id="m" value="<?echo $m;?>">
                    <table class="table3 table-bordered" style="width: 340%;"> 
                        <tr class="tr">
                            <td>#</td>
                            <td>Emp Id</td>
                            <td>Name</td>
                            <td>Designation</td>
                            <td>DOJ</td>
                            <td>Category</td>
                            <td>Department</td>
                            <td>Branch</td>
                            <td align="center">Paid Days</td>
                            <td align="center">OT Hrs.</td>
                            <?
                                $sql="SELECT * from allowance where type='Fix' and client_id='$clientid' order by aid asc";
                                $re=$con->query($sql);
                                while($al=mysqli_fetch_array($re))
                                {?>
                                    <td align="right"><?echo $al['allowance'];?></td>
                                <?}
                            ?>
                            <td align="right">Gross</td>
                            <?
                                $sql="SELECT * from allowance where type='Fix' and client_id='$clientid' order by aid asc";
                                $re=$con->query($sql);
                                while($al=mysqli_fetch_array($re))
                                {?>
                                    <td align="right"><?echo $al['allowance'];?></td>
                                <?}

                                $sql="SELECT * from allowance where type='Variable' and client_id='$clientid' order by aid asc";
                                $re=$con->query($sql);
                                while($al=mysqli_fetch_array($re))
                                {?>
                                    <td align="right" style="text-transform: capitalize;"><?echo $al['allowance'];?></td>
                                <?}
                            ?>
                            <td align="right">Bonus</td>
                            <td align="right">Over Time</td>
                            <td>Leave Ench.</td>
                            <td align="right">Gross salary</td>
                            <td>PF</td>
                            <td>ESI</td>
                            <!-- <td>TDS</td> -->
                            <td>PT</td>
                            <td>LWF</td>
                            <?
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
                        <?  
                            $con->query("delete from salary where year='$y' and month='$m' and client_id='$clientid'");
                            $con->query("delete from salary_breakup_amt where year='$y' and month='$m' and client_id='$clientid'");

                            $sal_sql="";
                            $sql="select * from employee where dol='' and client_id=$clientid order by (emp_id) asc";
                            $res=$con->query($sql);   $count=0;
                            while($row=mysqli_fetch_array($res)) 
                            {   $aa=1; $eid=$row['emp_id']; $count++;
                                $p=0; $w=0; $el=0; $cl=0; $sl=0; $ml=0; $ho=0; $pd=0;
                                $gross=0; $grosssalary=0; $totdec=0; $totalcts=0;

                                $sal_sql="insert into salary values('',";
                                ?>
                                <tr>
                                    <td><?echo $count;?></td>
                                    <td><?echo $code=$row['empcode'];?></td>
                                    <td><?echo $row['name'];?></td>
                                    <td><?echo $row['designation'];?></td>
                                    <td><?echo date('d-m-Y', strtotime($row['doj']));?></td>
                                    <td><?echo $row['category'];?></td>
                                    <td><?echo $row['department'];?></td>
                                    <td><?echo $row['location'];?></td>
                                    <td align="center">
                                        <?
                                            $p=mysqli_num_rows($con->query("select * from attendance where year='$y' and month='$m' and client_id='$clientid' and empid='$eid' and atd='P'"));
                                            $w=mysqli_num_rows($con->query("select * from attendance where year='$y' and month='$m' and client_id='$clientid' and empid='$eid' and atd='W'"));
                                            $el=mysqli_num_rows($con->query("select * from attendance where year='$y' and month='$m' and client_id='$clientid' and empid='$eid' and atd='EL'"));
                                            $cl=mysqli_num_rows($con->query("select * from attendance where year='$y' and month='$m' and client_id='$clientid' and empid='$eid' and atd='CL'"));
                                            $sl=mysqli_num_rows($con->query("select * from attendance where year='$y' and month='$m' and client_id='$clientid' and empid='$eid' and atd='SL'"));
                                            $ml=mysqli_num_rows($con->query("select * from attendance where year='$y' and month='$m' and client_id='$clientid' and empid='$eid' and atd='ML'"));
                                            $ho=mysqli_num_rows($con->query("select * from attendance where year='$y' and month='$m' and client_id='$clientid' and empid='$eid' and atd='HO'"));
                                            echo $pd=$p+$w+$el+$cl+$sl+$ml+$ho;
                                        ?>
                                    </td>
                                    <?
                                        $oth=0;
                                        $sb=mysqli_fetch_array($con->query($sql="select sum(oth) from attendance where year='$y' and month='$m' and client_id='$clientid' and empid='$eid'"));
                                        $oth=$sb['0'];
                                        $sal_sql.="'$code','$pd','$oth'";
                                    ?>
                                    <td align="center"><?echo $oth;?></td>
                                    <?
                                        $sql="SELECT * from employee_breakup where emp_code='$code' and client_id='$clientid'";
                                        $re=$con->query($sql);
                                        while($al=mysqli_fetch_array($re))
                                        {   $gross+=$al['amount'];
                                            $alw[]=$al['amount'];
                                        ?>
                                            <td align="right"><?echo $al['amount'];?></td>
                                        <?}
                                    ?>
                                    <td align="right"><? echo number_format($gross,2);?></td>

                                    <!-- ************ 2nd Breackup **********-->

                                    <?
                                        $sal_sql.=",'$gross'";
                                        $sql="SELECT * from employee_breakup where emp_code='$code' and client_id='$clientid'";
                                        $re=$con->query($sql); $i=0;
                                        while($al=mysqli_fetch_array($re))
                                        {   $grosssalary+=$al['amount']/$d*$pd;
                                            ?>
                                            <td align="right"><?echo number_format($al['amount']/$d*$pd,2);?></td>
                                        <?}

                                        $sql="SELECT * from allowance where type='Variable' and client_id='$clientid' order by aid asc";
                                        $re=$con->query($sql);
                                        while($al=mysqli_fetch_array($re))
                                        {
                                            $alwv=$al['allowance'];
                                            $sb=mysqli_fetch_array($con->query($sql="select * from salary_breakup where year='$y' and month='$m' and variable='$alwv' and emp_code='$code' and client_id='$clientid'"));
                                            $grosssalary+=$sb['amt'];
                                            ?>
                                            <td align="right"><?echo $sb['amt'];?></td>
                                        <?}

                                    // **************** Bonus ****************
                                        $bonus_alw_pay=0;
                                        $bonus_amt=0;
                                        $sq="SELECT * from com_bonus where client_id='$clientid'";
                                        $rep=$con->query($sq); $flage=0;
                                        $bos=mysqli_num_rows($rep);
                                        if($row['bonus']=='Y' && $bos)
                                        {
                                            // $sq="SELECT * from com_bonus where client_id='$clientid'";
                                            // $rep=$con->query($sq); $flage=0;
                                            while($pta=mysqli_fetch_array($rep))
                                            {
                                                $bid=$pta['bid'];
                                                $sallery=$pta['sallery'];
                                                $sallery_to=$pta['sallery_to'];
                                                $share=$pta['bonus'];
                                                $month=$pta['month'];

                                                $sql="SELECT sum(amount) from com_bonus,com_bonus_allowance,employee_breakup where com_bonus.bid=com_bonus_allowance.bid and emp_allowance=b_allowance and employee_breakup.client_id='$clientid' and emp_code='$code' and com_bonus.bid='$bid'";
                                                $remp=mysqli_fetch_array($con->query($sql));
                                                $amount=$remp['0'];

                                                if($sallery<=$amount and $sallery_to>=$amount)
                                                    $bonus_alw_pay=$amount/$d*$pd;
                                            }

                                            if($month==$m)
                                            {
                                                $yy=($y-1)."-".$m;
                                                $ql="SELECT sum(bonus_alw_pay) from salary where client_id='$clientid' and ym>='$yy' and emp_code='$code'";
                                                $sbc=mysqli_fetch_array($con->query($ql));
                                                $sumbonus=$sbc[0];

                                                $bonus_amt=($bonus_alw_pay+$sumbonus)*$share/100;
                                                $grosssalary+=$bonus_amt;
                                            }
                                        }
                                        echo "<td align='right'>".round($bonus_amt,2)."</td>";
                                        $sal_sql.=",'$bonus_alw_pay','$bonus_amt'";
                                        

                            // **************  Over time *************
                                        $ot_alw_pay=0;
                                        $ot_amt=0;
                                        $ovt=mysqli_fetch_array($con->query("SELECT * from com_overtime where client_id='$clientid'"));
                                        if($row['ot']=='Y' && $ovt)
                                        {
                                            $sql="SELECT calculation,multiple,sum(amount) from com_overtime,com_overtime_allowance,employee_breakup where com_overtime.ov_id=com_overtime_allowance.ov_id and emp_allowance=ov_allowance and emp_code='$code' and com_overtime.client_id='$clientid'";
                                            $re=$con->query($sql);
                                            $remp=mysqli_fetch_array($re);
                                            $cal=$remp['0'];
                                            $mul=$remp['1'];
                                            $amount=$remp['2'];

                                            $sh=mysqli_fetch_array($con->query($sql="SELECT hour from com_shift where client_id='$clientid'"));
                                            $shf=$sh['0'];
                                            $ot_alw_pay=$amount;
                                            if($cal=="Monthly")
                                                $ot_amt=$amount/$d/$shf*$mul*$oth;
                                            else
                                                $ot_amt=$amount/30/$shf*$mul*$oth;
                                            $grosssalary+=$ot_amt;
                                        }
                                        echo "<td align='right'>".round($ot_amt,2)."</td>";
                                        $sal_sql.=",'$ot_alw_pay','$ot_amt'";


                                    // ************** leave Payment ***************
                                        $leave_alw_pay=0;
                                        $leave_amt=0;
                                        $lv=mysqli_fetch_array($con->query($sql="SELECT * from com_leave where client_id='$clientid'"));
                                        if($lv!="")
                                        {
                                            $sql="SELECT calculation,sum(amount) from com_leave,com_leave_allowance,employee_breakup where lid=l_id and emp_allowance=l_alw and emp_code='$code' and com_leave.client_id='$clientid' and month='$m'";
                                            $re=$con->query($sql);
                                            $remp=mysqli_fetch_array($re);
                                            $cal=$remp['0'];
                                            $leave_alw_pay=$remp['1'];

                                            $atd_el=mysqli_fetch_array($con->query($sql="select sum(atd) from attendance where year='$y' and client_id='$clientid' and empid='$eid' and atd='EL'"));
                                            $el_atd=$row['el']-$atd_el['0'];
                                            if($cal=="Monthly")
                                                $leave_amt=$leave_alw_pay/$d*$el_atd;
                                            else
                                                $leave_amt=$leave_alw_pay/30*$el_atd;

                                            $grosssalary+=$leave_amt;
                                        }
                                        echo "<td align='right'>".round($leave_amt,2)."</td>";
                                        $sal_sql.=",'$leave_alw_pay','$leave_amt'";
                                    ?>
                                    <td align="right"><?echo number_format($grosssalary,2);?></td>

                                    <!-- ************ end 2nd Breackup **********-->

                                    <!-- ************ Calculation **********-->
                                    <?
                                        $sal_sql.=",'$grosssalary'";
                                        $pf_alw_pay=0;
                                        $pf_amt=0;
                                        if($row['pf']=='Y')
                                        {
                                            $sql="SELECT pf_limit,ee_pf,sum(amount) from com_pf,com_pf_allowance,employee_breakup where pfid=pf_id and pf_allowance=emp_allowance and emp_code='$code' and com_pf.client_id='$clientid'";
                                            $re=$con->query($sql);
                                            $remp=mysqli_fetch_array($re);
                                            $limit=$remp['0'];
                                            $share=$remp['1'];
                                            $pf_alw_pay=$amount=$remp['2']/$d*$pd;
                                            if($amount>$limit)
                                            {   $pf_amt=round($limit*$share/100,2);
                                                $totdec+=$pf_amt;
                                            }
                                            else{ 
                                                $pf_amt+=round($amount*$share/100,2);
                                                $totdec+=$pf_amt;
                                            }
                                        }
                                        echo "<td align='right'>".round($pf_amt,2)."</td>";
                                        $sal_sql.=",'$pf_alw_pay','$pf_amt'";

                                // ************* ESI *****************
                                        $esi_alw_pay=0;
                                        $esi_amt=0;
                                        if($row['esi']=='Y')
                                        {
                                            $sql="SELECT ee_share,sum(amount) from com_esi,com_esi_allowance,employee_breakup where com_esi.esi_id=com_esi_allowance.esi_id and emp_allowance=esi_allowance and emp_code='$code' and com_esi.client_id='$clientid'";
                                            $re=$con->query($sql);
                                            $remp=mysqli_fetch_array($re);

                                            $sql2="SELECT ee_share,sum(amt) from com_esi,com_esi_allowance,salary_breakup where com_esi.esi_id=com_esi_allowance.esi_id and esi_allowance=variable and emp_code='$code' and com_esi.client_id='$clientid' and year='$y' and month='$m'";
                                            $re2=$con->query($sql2);
                                            $remp2=mysqli_fetch_array($re2);

                                            $share=$remp['0'];
                                            $esi_alw_pay=$amount=($remp['1']/$d*$pd)+$remp2['1'];
                                            
                                            $esi_amt=ceil($amount*$share/100);
                                            $totdec+=$esi_amt;
                                        }
                                        echo "<td align='right'>".ceil($esi_amt)."</td>";
                                        $sal_sql.=",'$esi_alw_pay','$esi_amt'";


                                // ************* TDS *****************
                                        // if($row['tds']=='Y')
                                        // {
                                        //     $tds_alw_p=0; $tds_alw_v=0; $tds_alw_v2=0; $total_salary=0; $total_deduction=0;
                                        //     $sql="SELECT * from employee_breakup where emp_code='$code' and client_id='$clientid'";
                                        //     $re=$con->query($sql);
                                        //     while($al=mysqli_fetch_array($re))
                                        //     {   
                                        //         if($al['emp_allowance']=="HRA")
                                        //             $hra_rev=($al['amount']/$d*$pd)*$mmulti;
                                        //         if($al['emp_allowance']=="Basic")
                                        //             $hra_bas=($al['amount']/$d*$pd)*$mmulti;

                                        //         $tds_alw_p+=($al['amount']/$d*$pd)*$mmulti;
                                        //     }

                                        //     // pichhala month variable allowance
                                        //     $sql="SELECT distinct allowance from allowance,com_incometax_allowance where allowance=alw and type='Variable' order by aid asc";
                                        //     $re=$con->query($sql);
                                        //     while($al=mysqli_fetch_array($re))
                                        //     {
                                        //         $alwv=$al['allowance'];
                                        //         $sb=mysqli_fetch_array($con->query($sql="select * from salary_breakup where year='$y' and month='$m' and variable='$alwv' and client_id='$clientid'"));
                                        //         $tds_alw_v+=$sb['amt'];

                                        //         $sql="SELECT sum(pay_amt) from salary_breakup_amt where year between '$stds' and '$stdl' and alw='$alwv' and client_id='$clientid' and code='$code'";
                                        //         $sb=mysqli_fetch_array($con->query($sql));
                                        //         $tds_alw_v2+=$sb['0'];
                                        //     }
                                            
                                        //     $cie=mysqli_fetch_array($con->query("select * from com_incometax_emp where emp_code='$code' and client_id='$clientid'"));
                                            
                                        //     $total_salary=$cie['other']+$tds_alw_p+$tds_alw_v+$tds_alw_v2+$ov_amount;
                                        //     $hra_rent=$cie['hra'];

                                        //     $it=mysqli_fetch_array($con->query("select * from com_incometax where client_id='$clientid'"));
                                        //     $dec=($it[2] < $cie[4]) ?$it[2] : $cie[4];
                                        //         $total_deduction+=$dec;
                                        //     $dec=($it[3] < $cie[5]) ?$it[3] : $cie[5];
                                        //         $total_deduction+=$dec;
                                        //     $dec=($it[4] < $cie[6]) ?$it[4] : $cie[6];
                                        //         $total_deduction+=$dec;
                                        //     $dec=($it[5] < $cie[7]) ?$it[5] : $cie[7];
                                        //         $total_deduction+=$dec;
                                        //     $dec=($it[6] < $cie[8]) ?$it[6] : $cie[8];
                                        //         $total_deduction+=$dec;
                                        //     $dec=($it[7] < $cie[9]) ?$it[7] : $cie[9];
                                        //         $total_deduction+=$dec;
                                        //     $dec=($it[8] < $cie[10]) ?$it[8] : $cie[10];
                                        //         $total_deduction+=$dec;
                                        //     $dec=($it[9] < $cie[11]) ?$it[9] : $cie[11];
                                        //         $total_deduction+=$dec;
                                        //     $dec=($it[10] < $cie[12]) ?$it[10] : $cie[12];
                                        //         $total_deduction+=$dec;
                                        //     $dec=($it[11] < $cie[13]) ?$it[11] : $cie[13];
                                        //         $total_deduction+=$dec;


                                        //     if($row['gender']=="M")
                                        //     {
                                        //         if($row['city_type']=="Metro")
                                        //             $hra_basic=$hra_bas*$it['slm_metro']/100;
                                        //         else
                                        //             $hra_basic=$hra_bas*$it['slm_nonmetro']/100;

                                        //         $hra_rent_paid=$hra_rent-($hra_bas*$it['slm_rent']/100);
                                        //         if($hra_rent_paid<0)
                                        //             $hra_rent_paid=0;

                                        //         if($hra_rev<$hra_basic)
                                        //             $hra=$hra_rev;
                                        //         else
                                        //         {
                                        //             if($hra_basic<$hra_rent_paid)
                                        //                 $hra=$hra_basic;
                                        //             else
                                        //                 $hra=$hra_rent_paid;
                                        //         }

                                        //         $total_deduction+=$hra;
                                        //         $taxable_salary=$total_salary-$total_deduction;
                                                
                                        //         if($taxable_salary<=0)
                                        //         {
                                        //             $total_tax=0;
                                        //         }
                                        //         elseif($taxable_salary>=$it['ss1'] && $taxable_salary<=$it['ssto1'])
                                        //         {
                                        //             $total_tax=$taxable_salary*$it['slm1']/100;
                                        //         } 
                                        //         elseif($taxable_salary>=$it['ss2'] && $taxable_salary<=$it['ssto2'])
                                        //         {
                                        //             $txs1=($tsl1=$it['ssto1']-$it['ss1'])*$it['slm1']/100;

                                        //             $txs2=($taxable_salary-$tsl1)*$it['slm2']/100;
                                        //             $total_tax=$txs1+$txs2;
                                        //         }
                                        //         elseif($taxable_salary>=$it['ss3'] && $taxable_salary<=$it['ssto3'])
                                        //         {
                                        //             $txs1=($tsl1=$it['ssto1']-$it['ss1'])*$it['slm1']/100;
                                        //             $txs2=($tsl2=$it['ssto2']-$it['ss2'])*$it['slm2']/100;

                                        //             $txs3=($taxable_salary-$tsl1-$tsl2)*$it['slm3']/100;
                                        //             $total_tax=$txs1+$txs2+$txs3;
                                        //         }
                                        //         else
                                        //         {
                                        //             $txs1=($tsl1=$it['ssto1']-$it['ss1'])*$it['slm1']/100;
                                        //             $txs2=($tsl2=$it['ssto2']-$it['ss2'])*$it['slm2']/100;
                                        //             $txs3=($tsl3=$it['ssto3']-$it['ss3'])*$it['slm3']/100;

                                        //             $txs4=($taxable_salary-$tsl1-$tsl2-$tsl3)*$it['slm4']/100;
                                        //             $total_tax=$txs1+$txs2+$txs3+$txs4;
                                        //         }

                                        //         if($taxable_salary<=$it['rebeat'])
                                        //             $total_tax_r=$total_tax-$it['slm_rebeat'];
                                        //         else
                                        //             $total_tax_r=$total_tax;
                                                
                                        //         $ts=0;
                                        //         if($taxable_salary>=$it['tax_sur1'] && $taxable_salary<=$it['tax_sur2'])
                                        //             $ts=$total_tax*$it['slm_tax1']/100;
                                        //         elseif($taxable_salary>=$it['tax_sur2'] && $taxable_salary<=$it['tax_sur3'])
                                        //             $ts=$total_tax*$it['slm_tax2']/100;
                                        //         elseif($taxable_salary>=$it['tax_sur3'] && $taxable_salary<=$it['tax_sur4'])
                                        //             $ts=$total_tax*$it['slm_tax3']/100;
                                        //         elseif($taxable_salary>=$it['tax_sur4'])
                                        //             $ts=$total_tax*$it['slm_tax4']/100;
                                        //         else
                                        //             $ts=0;
                                                
                                        //         $ed=($total_tax+$ts)*$it['slm_edu']/100;

                                        //         $net_tax=$total_tax_r+$ts+$ed;
                                        //         $month_tax=$net_tax/$mmulti;
                                        //     }
                                        //     else
                                        //     {
                                        //         ////// Female 

                                        //         if($row['city_type']=="Metro")
                                        //             $hra_basic=$hra_bas*$it['slf_metro']/100;
                                        //         else
                                        //             $hra_basic=$hra_bas*$it['slf_nonmetro']/100;
                                                
                                        //         $hra_rent_paid=$hra_rent-($hra_bas*$it['slf_rent']/100);
                                        //         if($hra_rent_paid<0)
                                        //             $hra_rent_paid=0;

                                        //         if($hra_rev<$hra_basic)
                                        //             $hra=$hra_rev;
                                        //         else
                                        //         {
                                        //             if($hra_basic<$hra_rent_paid)
                                        //                 $hra=$hra_basic;
                                        //             else
                                        //                 $hra=$hra_rent_paid;
                                        //         }

                                        //         $total_deduction+=$hra;
                                        //         $taxable_salary=$total_salary-$total_deduction;
                                                
                                        //         if($taxable_salary<=0)
                                        //         {
                                        //             $total_tax=0;
                                        //         }
                                        //         elseif($taxable_salary>=$it['ss1'] && $taxable_salary<=$it['ssto1'])
                                        //         {
                                        //             $total_tax=$taxable_salary*$it['slf1']/100;
                                        //         } 
                                        //         elseif($taxable_salary>=$it['ss2'] && $taxable_salary<=$it['ssto2'])
                                        //         {
                                        //             $txs1=($tsl1=$it['ssto1']-$it['ss1'])*$it['slf1']/100;

                                        //             $txs2=($taxable_salary-$tsl1)*$it['slf2']/100;
                                        //             $total_tax=$txs1+$txs2;
                                        //         }
                                        //         elseif($taxable_salary>=$it['ss3'] && $taxable_salary<=$it['ssto3'])
                                        //         {
                                        //             $txs1=($tsl1=$it['ssto1']-$it['ss1'])*$it['slf1']/100;
                                        //             $txs2=($tsl2=$it['ssto2']-$it['ss2'])*$it['slf2']/100;

                                        //             $txs3=($taxable_salary-$tsl1-$tsl2)*$it['slf3']/100;
                                        //             $total_tax=$txs1+$txs2+$txs3;
                                        //         }
                                        //         else
                                        //         {
                                        //             $txs1=($tsl1=$it['ssto1']-$it['ss1'])*$it['slf1']/100;
                                        //             $txs2=($tsl2=$it['ssto2']-$it['ss2'])*$it['slf2']/100;
                                        //             $txs3=($tsl3=$it['ssto3']-$it['ss3'])*$it['slf3']/100;

                                        //             $txs4=($taxable_salary-$tsl1-$tsl2-$tsl3)*$it['slf4']/100;
                                        //             $total_tax=$txs1+$txs2+$txs3+$txs4;
                                        //         }

                                        //         if($taxable_salary<=$it['rebeat'])
                                        //             $total_tax_r=$total_tax-$it['slf_rebeat'];
                                        //         else
                                        //             $total_tax_r=$total_tax;
                                                
                                        //         $ts=0;
                                        //         if($taxable_salary>=$it['tax_sur1'] && $taxable_salary<=$it['tax_sur2'])
                                        //             $ts=$total_tax*$it['slf_tax1']/100;
                                        //         elseif($taxable_salary>=$it['tax_sur2'] && $taxable_salary<=$it['tax_sur3'])
                                        //             $ts=$total_tax*$it['slf_tax2']/100;
                                        //         elseif($taxable_salary>=$it['tax_sur3'] && $taxable_salary<=$it['tax_sur4'])
                                        //             $ts=$total_tax*$it['slf_tax3']/100;
                                        //         elseif($taxable_salary>=$it['tax_sur4'])
                                        //             $ts=$total_tax*$it['slf_tax4']/100;
                                        //         else
                                        //             $ts=0;
                                                
                                        //         $ed=($total_tax+$ts)*$it['slf_edu']/100;

                                        //         $net_tax=$total_tax_r+$ts+$ed;
                                        //         $month_tax=$net_tax/$mmulti;
                                        //     }
                                        // }
                                        // else
                                        // {
                                        //     $month_tax="0.00";
                                        // }

                                        $month_tax=0;
                                        $totdec+=$month_tax;
                                        $sal_sql.=",'$month_tax'";
                                        ?>
                                            <!-- <td style="background: yellow;">

                                                <?echo round($month_tax,2);?>
                                                    
                                            </td> -->
                                        <?


                                // ************* PT *****************
                                        $pt_alw_pay=0;
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

                                                $sql="SELECT sum(amount) from com_pt,com_pt_allowance,employee_breakup where com_pt.pt_id=com_pt_allowance.pt_id and emp_allowance=pt_allowance and com_pt.client_id='$clientid' and emp_code='$code' and com_pt.pt_id='$pid'";
                                                $remp=mysqli_fetch_array($con->query($sql));
                                                $pt_alw_pay=$amount=$remp['0']/$d*$pd;

                                                if($sallery<=$amount and $sallery_to>=$amount && $pd>0)
                                                {   $flage=1;
                                                    $totdec+=$share;
                                                    $pt_amt=$share;
                                                }
                                            }
                                        }
                                        echo "<td align='right'>".$pt_amt."</td>";
                                        $sal_sql.=",'$pt_alw_pay','$pt_amt'";

                                    // ************* LWF *****************
                                        $lwf_alw_pay=0;
                                        $lwf_amt=0;
                                        if($row['lwf']=='Y')
                                        {
                                            $state=$row['state'];
                                            $sql="SELECT ee_share from com_lwf,com_lwf_allowance where com_lwf.lwf_id=com_lwf_allowance.lwf_id and com_lwf.client_id='$clientid' and state='$state' and lwf_allowance='$m'";
                                            $re=$con->query($sql);
                                            $remp=mysqli_fetch_array($re);
                                            $share=$remp['0'];
                                            if($pd>0 && $remp!="")
                                            {
                                                $totdec+=$share;
                                                $lwf_amt=$share;
                                            }
                                        }
                                        echo "<td align='right'>".$lwf_amt."</td>";
                                        $sal_sql.=",'$lwf_alw_pay','$lwf_amt'";


                                    // *********** Deduction *************

                                        $sql="SELECT * from deduction where client_id='$clientid'";
                                        $re=$con->query($sql);
                                        while($dec=mysqli_fetch_array($re))
                                        {   $var=$dec['deduction'];
                                            $adv=mysqli_fetch_array($con->query($sql="SELECT amt from salary_breakup where year='$y' and month='$m' and emp_code='$code' and variable='$var' and client_id='$clientid'"));
                                            $totdec+=$adv['0'];
                                            ?>
                                            <td><?echo $adv['0'];?></td>
                                        <?}
                                    ?>
                                    <td><?echo number_format($totdec,2);?></td>
                                    <td><?echo number_format($netp=$grosssalary-$totdec,2);?></td>
                                    <td></td>

                                <!-- *******  Company Calculation  ***********-->
                                    <?
                                        $sal_sql.=",'$totdec','$netp'";
                                        if($row['pf']=='Y')
                                        {
                                            $sql="SELECT pf_limit,er_pf,er_eps,sum(amount) from com_pf,com_pf_allowance,employee_breakup where pfid=pf_id and emp_allowance=pf_allowance and emp_code='$code' and com_pf.client_id='$clientid'";
                                            $re=$con->query($sql); $cpf=0;
                                            $remp=mysqli_fetch_array($re);
                                            $limit=$remp['0'];
                                            $share=$remp['1'];
                                            $share2=$remp['2'];
                                            $amount=$remp['3']/$d*$pd;
                                            if($amount>$limit)
                                            {   $cpf=round($limit*$share/100,2);
                                                $cpf2=round($limit*$share2/100,2);
                                                $totalcts+=$cpf;
                                                $totalcts+=$cpf2;
                                                $cpff=$cpf+$cpf2;
                                                $sal_sql.=",'$cpff'";
                                                ?>
                                                <td><?echo round($cpff,2);?></td>
                                            <?}
                                            else{ 
                                                $cpf=round($amount*$share/100,2);
                                                $cpf2=round($amount*$share2/100,2);
                                                $totalcts+=$cpf;
                                                $totalcts+=$cpf2;
                                                $cpff=$cpf+$cpf2;
                                                $sal_sql.=",'$cpff'";
                                                ?>
                                                <td><?echo round($cpff,2);?></td>
                                            <?}
                                        }
                                        else
                                        {
                                            $sal_sql.=",''";
                                            echo "<td>0.00</td>";
                                        }

                                    // *********** com ESI *************

                                        if($row['esi']=='Y')
                                        {
                                            $sql="SELECT er_share,sum(amount) from com_esi,com_esi_allowance,employee_breakup where com_esi.esi_id=com_esi_allowance.esi_id and emp_allowance=esi_allowance and emp_code='$code' and com_esi.client_id='$clientid'";
                                            $re=$con->query($sql);
                                            $remp=mysqli_fetch_array($re);

                                            $sql2="SELECT er_share,sum(amt) from com_esi,com_esi_allowance,salary_breakup where com_esi.esi_id=com_esi_allowance.esi_id and esi_allowance=variable and emp_code='$code' and com_esi.client_id='$clientid' and year='$y' and month='$m'";
                                            $re2=$con->query($sql2);
                                            $remp2=mysqli_fetch_array($re2);

                                            $share=$remp['0'];
                                            $amount=($remp['1']/$d*$pd)+$remp2['1'];

                                            $cesi=ceil($amount*$share/100);
                                            $totalcts+=$cesi;
                                            $sal_sql.=",'$cesi'";
                                            ?>
                                                <td><?echo ceil($cesi);?></td>
                                            <?
                                        }
                                        else
                                        {
                                            $sal_sql.=",''";
                                            echo "<td>0.00</td>";
                                        }


                                // ************* PT *****************

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
                                                $share=$pta['er_share'];

                                                $sql="SELECT sum(amount) from com_pt,com_pt_allowance,employee_breakup where com_pt.pt_id=com_pt_allowance.pt_id and emp_allowance=pt_allowance and com_pt.client_id='$clientid' and emp_code='$code' and com_pt.pt_id='$pid'";
                                                $remp=mysqli_fetch_array($con->query($sql));
                                                $amount=$remp['0']/$d*$pd;

                                                if($sallery<=$amount and $sallery_to>=$amount && $pd>0)
                                                {   $flage=1;
                                                    $totalcts+=$share;
                                                    $sal_sql.=",'$share'";
                                                    ?>
                                                    <td><?echo $share;?></td>
                                                <?}
                                            }
                                            if($flage==0)
                                            {$sal_sql.=",''";?>
                                                <td>0.00</td>
                                            <?}
                                        }
                                        else
                                        {
                                            $sal_sql.=",''";
                                            echo "<td>0.00</td>";
                                        }

                                    // ************* LWF *****************

                                        if($row['lwf']=='Y')
                                        {
                                            $state=$row['state'];
                                            //$sql="SELECT er_share from com_lwf where client_id='$clientid' and state='$state'";
                                            $sql="SELECT er_share from com_lwf,com_lwf_allowance where com_lwf.lwf_id=com_lwf_allowance.lwf_id and com_lwf.client_id='$clientid' and state='$state' and lwf_allowance='$m'";
                                            $re=$con->query($sql);
                                            $remp=mysqli_fetch_array($re);
                                            $share=$remp['0'];
                                            if($pd>0 && $remp!="")
                                            {
                                                $totalcts+=$share;
                                                $sal_sql.=",'$share'";
                                                ?>
                                                <td><?echo $share;?></td>
                                            <?}
                                            else{ $sal_sql.=",''";
                                                ?>
                                                <td>0.00</td>
                                            <?}
                                        }
                                        else
                                        {
                                            $sal_sql.=",''";
                                            echo "<td>0.00</td>";
                                        }
                                    ?>
                                    <td><?echo number_format($paid_ctc=$totalcts+$grosssalary,2);?></td>
                                </tr>

                                <?
                                
                            //  ********** Salary save automatic ********

                                $ym=$y."-".$m;
                                $sal_sql.=",'$paid_ctc','$y','$m','$clientid','$dt','$ym')";
                                $con->query($sal_sql);

                                $sal=mysqli_fetch_array($con->query("SELECT slid from salary where emp_code='$code' and client_id='$clientid' and year='$y' and month='$m'"));
                                $slid=$sal['0'];
                                $sql="SELECT * from employee_breakup where emp_code='$code' and client_id='$clientid'";
                                $re=$con->query($sql);
                                while($al=mysqli_fetch_array($re))
                                { 
                                    $value=$al['emp_allowance'];
                                    $salary=$al['amount'];
                                    $salary2=$al['amount']/$d*$pd;
                                    $sql="insert into salary_breakup_amt values('','$slid','$code','$value','$salary','$salary2','$y','$m','$clientid','$dt')";
                                    $con->query($sql);
                                }

                                $emp_el=$row['el']; $emp_sl=$row['sl']; $emp_cl=$row['cl']; $emp_ho=$row['ho'];
                                $sql_leave="insert into leave_update values('','$code','$emp_el','$el','$emp_sl','$sl','$emp_cl','$cl','$emp_ho','$ho','$y','$m','$clientid')";
                                $con->query($sql_leave);

                                $ael=$emp_el-$el; $asl=$emp_sl-$sl;  $acl=$emp_cl-$cl; $aho=$emp_ho-$ho;  
                                $sql_emp="UPDATE employee set el='$ael',sl='$asl',cl='$acl',ho='$aho' where empcode='$code'";
                                $con->query($sql_emp);
                            }
                        ?>
                    </table>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <?}
        else
        {?>
            <div class="page_details">
                <div class="col-sm-12 pad15">
                    <span style="display: block; text-align: center; font-size: 1.5em; font-weight: 300; color: red;">Attendance Not Updated.</span>
                </div>
            </div>
        <?}
    }
    else
    {?>


        <!-- ****************** Salary Dispay **************** -->

        <div class="page_details">
            <div class="col-sm-12 pad15_line">
                <div class="col-sm-6 col-xs-12 pad0">
                    <div class="headding">Salary List</div>
                </div>
                <div class="col-sm-6 pad0 text-right">
                    
                </div>
                <div class="clear"></div>
            </div>
            <div class="col-sm-12 pad15">
                <div class="col-sm-8 pad0" style="font-size: 1.2em;">
                    Result :- <b><?echo date("M",strtotime($ym));?>, <?echo $y;?></b> &nbsp; Total Record : <?echo mysqli_num_rows($res);?> 
                </div>
                <div class="col-sm-12 pad0" style="overflow: auto; padding-top: 10px;">
                    <input type="hidden" name="y" id="y" value="<?echo $y;?>">
                    <input type="hidden" name="m" id="m" value="<?echo $m;?>">
                    <table class="table3 table-bordered" style="width: 340%;"> 
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
                                <td align="center">Paid Days</td>
                                <td align="center">OT Hrs.</td>
                                <?
                                    $sql="SELECT * from allowance where type='Fix' and client_id='$clientid' order by aid asc";
                                    $re=$con->query($sql);
                                    while($al=mysqli_fetch_array($re))
                                    {?>
                                        <td align="right"><?echo $al['allowance'];?></td>
                                    <?}
                                ?>
                                <td align="right">Gross</td>
                                <?
                                    $sql="SELECT * from allowance where type='Fix' and client_id='$clientid' order by aid asc";
                                    $re=$con->query($sql);
                                    while($al=mysqli_fetch_array($re))
                                    {?>
                                        <td align="right"><?echo $al['allowance'];?></td>
                                    <?}

                                    $sql="SELECT * from allowance where type='Variable' and client_id='$clientid' order by aid asc";
                                    $re=$con->query($sql);
                                    while($al=mysqli_fetch_array($re))
                                    {?>
                                        <td align="right" style="text-transform: capitalize;"><?echo $al['allowance'];?></td>
                                    <?}
                                ?>
                                <td align="right">Bonus</td>
                                <td align="right">Over Time</td>
                                <td>Leave Ench.</td>
                                <td align="right">Gross salary</td>
                                <td>PF</td>
                                <td>ESI</td>
                                <!-- <td>TDS</td> -->
                                <td>PT</td>
                                <td>LWF</td>
                                <?
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
                                $sql="SELECT name,designation,doj,category,department,location,slid,emp_code, pay_day, ot_hrs, gross, salary.bonus, over_time,leave_ench,gross_salary, salary.pf, salary.esi, salary.tds, salary.pt, salary.lwf, total_dec, net_payable, er_pf, er_esi, er_pt, er_lwf, paid_ctc from salary,employee where emp_code=empcode and salary.client_id='$clientid' and year='$y' and month='$m'";
                                $res=$con->query($sql); $i=1;
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
                                            $sq=$con->query("SELECT * from salary_breakup_amt where slid='$slid'");
                                            while($sb=mysqli_fetch_array($sq))
                                            {?>
                                                <td><?echo $sb['amt'];?></td>
                                            <?}
                                        ?>
                                        <td><?echo $row['gross'];?></td>
                                        <?
                                            $sq=$con->query("SELECT * from salary_breakup_amt where slid='$slid'");
                                            while($sb=mysqli_fetch_array($sq))
                                            {?>
                                                <td><?echo $sb['pay_amt'];?></td>
                                            <?}

                                            $sq="SELECT amt from salary_breakup,allowance where allowance=variable and emp_code='$code'and year='$y' and month='$m' and salary_breakup.client_id='$clientid'";
                                            $sa=$con->query($sq);
                                            if(mysqli_num_rows($sa)>0)
                                            {
                                                while($sb=mysqli_fetch_array($sa))
                                                {?>
                                                    <td><?echo $sb['amt'];?></td>
                                                <?}
                                            }
                                            else
                                            {
                                                $sql="SELECT * from allowance where type='Variable' and client_id='$clientid' order by aid asc";
                                                $re=$con->query($sql);
                                                while($al=mysqli_fetch_array($re))
                                                {?>
                                                    <td align="center">0.00</td>
                                                <?}
                                            }
                                        ?>
                                        <td><?echo $row['bonus'];?></td>
                                        <td><?echo $row['over_time'];?></td>
                                        <td><?echo $row['leave_ench'];?></td>
                                        <td><?echo $row['gross_salary'];?></td>
                                        <td><?echo $row['pf'];?></td>
                                        <td><?echo $row['esi'];?></td>
                                        <td><?echo $row['pt'];?></td>
                                        <td><?echo $row['lwf'];?></td>
                                        <?
                                            $sq="SELECT amt from salary_breakup,deduction where deduction=variable and emp_code='$code'and year='$y' and month='$m' and salary_breakup.client_id='$clientid'";
                                            $sd=$con->query($sq);
                                            if(mysqli_num_rows($sa)>0)
                                            {
                                                while($sb=mysqli_fetch_array($sd))
                                                {?>
                                                    <td><?echo $sb['amt'];?></td>
                                                <?}
                                            }
                                            else
                                            {
                                                $sql="SELECT * from deduction where client_id='$clientid'";
                                                $re=$con->query($sql);
                                                while($dec=mysqli_fetch_array($re))
                                                {?>
                                                    <td>0.00</td>
                                                <?}
                                            }
                                        ?>
                                        <td><?echo $row['total_dec'];?></td>
                                        <td><?echo $row['net_payable'];?></td>
                                        <td></td>
                                        <td><?echo $row['er_pf'];?></td>
                                        <td><?echo $row['er_esi'];?></td>
                                        <td><?echo $row['er_pt'];?></td>
                                        <td><?echo $row['er_lwf'];?></td>
                                        <td><?echo $row['paid_ctc'];?></td>
                                    </tr>
                                <?}
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="clear"></div>
        </div>

    <?}

?>


