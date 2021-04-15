
<?
    include('extra/top.php');
    $y=date("Y");
    $m=date("m");
    $ym=$y."-".$m;
?>

<?include('extra/sidemenu.php');?>

<div class="main">
    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="col-sm-9 pad0"><div class="headding">Attendance Approval</div></div>
            <div class="col-sm-1 pad0">
                <input type="text" class="form-control" name="year" id="y" value="<?echo date('Y');?>">
                <input type="hidden" class="form-control" name="ec" id="ec" value="<?echo $empcode;?>">
            </div>
            <div class="col-sm-2 pad0">
                <select class="form-control" name="m" onchange="adt_month(this.value)">
                    <option value="">-Select Month-</option>
                    <option value="01">Jan</option>
                    <option value="02">Feb</option>
                    <option value="03">Mar</option>
                    <option value="04">Apr</option>
                    <option value="05">May</option>
                    <option value="06">Jun</option>
                    <option value="07">Jul</option>
                    <option value="08">Aug</option>
                    <option value="09">Sep</option>
                    <option value="10">Oct</option>
                    <option value="11">Nov</option>
                    <option value="12">Dec</option>
                </select>
            </div>
        </div>
        <div class="col-sm-12 pad15">
            <div id="data">
                <div><b>Month : <?echo date('M-Y',strtotime($ym));?></b></div>
                <table class="table table-bordered">
                    <tr style="font-weight: bold; background: #eee;">
                        <td>Sn</td>
                        <td>Employee Name</td>
                        <td>Designation</td>
                        <td>Branch</td>
                        <td width="50" align="center">P</td>
                        <td width="50" align="center">W</td>
                        <td width="50" align="center">EL</td>
                        <td width="50" align="center">CL</td>
                        <td width="50" align="center">SL</td>
                        <td width="50" align="center">ML</td>
                        <td width="50" align="center">HO</td>
                        <td width="50" align="center">PD</td>
                        <td width="50" align="center">OT</td>
                        <td align="center">Approve/Reject</td>
                    </tr>
                    <?
                        $a=1;
                        $sql="SELECT distinct emp_id,name,designation,branch,empcode from employee where rmid='$empcode' and client_id='$clientid'";
                        $res=$con->query($sql);
                        while($row=mysqli_fetch_array($res))
                        {
                            $id=$row['0'];
                            $ec=$row['4'];
                            $sql2="select * from attandance_approve where eid='$id' and month='$m'";
                            $row2=mysqli_fetch_array($con->query($sql2));
                            ?>
                            <tr>
                                <td><?echo $a++;?></td>
                                <td><?echo $row['1'];?></td>
                                <td><?echo $row['2'];?></td>
                                <td><?echo $row['3'];?></td>
                                <td align="center"><? echo $p=mysqli_num_rows($con->query("select * from attendance where atd_date like '$ym%' and empid='$id' and atd='P' and client_id='$clientid'"))?></td>
                                <td align="center"><? echo $w=mysqli_num_rows($con->query("select * from attendance where atd_date like '$ym%' and empid='$id' and atd='W' and client_id='$clientid'"))?></td>
                                <td align="center"><? echo $el=mysqli_num_rows($con->query("select * from attendance where atd_date like '$ym%' and empid='$id' and atd='EL' and client_id='$clientid'"))?></td>
                                <td align="center"><? echo $cl=mysqli_num_rows($con->query("select * from attendance where atd_date like '$ym%' and empid='$id' and atd='CL' and client_id='$clientid'"))?></td>
                                <td align="center"><? echo $sl=mysqli_num_rows($con->query("select * from attendance where atd_date like '$ym%' and empid='$id' and atd='SL' and client_id='$clientid'"))?></td>
                                <td align="center"><? echo $ml=mysqli_num_rows($con->query("select * from attendance where atd_date like '$ym%' and empid='$id' and atd='ML' and client_id='$clientid'"))?></td>
                                <td align="center"><? echo $ho=mysqli_num_rows($con->query("select * from attendance where atd_date like '$ym%' and empid='$id' and atd='HO' and client_id='$clientid'"))?></td>
                                <td align="center"><? echo $p+$w+$el+$cl+$sl+$ml+$ho;?></td>
                                <td>
                                    <? $ot=mysqli_fetch_array($con->query("select sum(oth) from attendance where empid='$id' and year='$y' and month='$m' and client_id='$clientid'"));
                                        echo $ot['0'];
                                    ?>
                                </td>
                                <td align="center">
                                    <?
                                        if(!$row2)
                                        {?>
                                            <a class="btn batt" href="atd_approve?ec=<?echo $ec;?>&&y=<?echo $y;?>&&m=<?echo $m;?>">Approve</a>
                                        <?}
                                        else
                                        {?>
                                            <a class="btn batt" style="background: orange">Approved</a>
                                        <?}
                                    ?>
                                </td>
                            </tr>  
                        <?}
                    ?>
                </table>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>





<script type="text/javascript">
    function adt_month(val)
    {
        var y=document.getElementById('y').value;
        var ec=document.getElementById('ec').value;
        if(val!="")
        {
            xmlhttp=new XMLHttpRequest();
            xmlhttp.open("GET","atd_approve_list?y="+y+"&&m="+val+"&&ec="+ec+"&&cl=<?echo $clientid;?>",false);
            xmlhttp.send(null);
            document.getElementById('data').innerHTML=xmlhttp.responseText;
        }
    }
</script>







<?include('extra/footer.php');?>

<script type="text/javascript">
    $('#myModal').click({
        backdrop:'static',
        keybord:false
    })
</script>