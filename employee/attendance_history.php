
<?
    include('extra/top.php');
?>

<?include('extra/sidemenu.php');?>

<div class="main">
    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="col-sm-9 pad0"><div class="headding">Attendance History</div></div>
            <div class="col-sm-1 pad0">
                <input type="text" class="form-control" name="year" id="y" value="<?echo date('Y');?>">
                <input type="hidden" class="form-control" name="eid" id="eid" value="<?echo $empid;?>">
            </div>
            <div class="col-sm-2 pad0">
                <select class="form-control" name="m" onchange="adt_month(this.value)">
                    <option value="">--</option>
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
                <?
                    $m=date("m");
                    $y=date("Y");
                    $d=cal_days_in_month(CAL_GREGORIAN,$m,$y);
                    $a=1;
                    $ym=$y."-".$m;
                ?>
                <b>Month : <?echo date('M-Y',strtotime($ym));?></b>
                <table class="table table-bordered">
                    <tr style="font-weight: bold; background: #eee;">
                        <td>Day</td>
                        <td align="center">Intime</td>
                        <td align="center">Outtime</td>
                        <td align="center">Attendance</td>
                        <td align="center">OT Hrs.</td>
                        <td>Location</td>
                    </tr>
                    <?
                        while($a<=$d)
                        {
                            if($a<10)
                                $dd=$y."-".$m."-0".$a;
                            else
                                $dd=$y."-".$m."-".$a;

                            $sql="select * from attendance where empid='$empid' and atd_date='$dd'";
                            $row=mysqli_fetch_array($con->query($sql));
                            ?>
                            <tr>
                                <td><?echo $a++;?></td>
                                <td align="center"><?echo $row['intime'];?></td>
                                <td align="center"><?echo $row['outtime'];?></td>
                                <td align="center"><?echo $row['atd'];?></td>
                                <td align="center"><?echo $row['oth'];?></td>
                                <td><?echo $row['location'];?></td>
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
        var eid=document.getElementById('eid').value;
        if(val!="")
        {
            xmlhttp=new XMLHttpRequest();
            xmlhttp.open("GET","attendance_history_cal?y="+y+"&&m="+val+"&&eid="+eid+"&&cl=<?echo $clientid;?>",false);
            xmlhttp.send(null);
            document.getElementById('data').innerHTML=xmlhttp.responseText;
        }
    }
</script>







<?include('extra/footer.php');?>