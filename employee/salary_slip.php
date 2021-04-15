
<?
    include('extra/top.php');
?>

<?include('extra/sidemenu.php');?>

<div class="main">
    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="col-sm-10 pad0"><div class="headding">Salary Slip</div></div>
        </div>
        <div class="col-sm-12 pad15">
            <table class="table table-bordered">
                <tr style="font-weight: bold; background: #eee;">
                    <td>#</td>
                    <td>EMP Code</td>
                    <td>Name</td>
                    <td>Month</td>
                    <td>Date</td>
                    <td align="center">Action</td>
                </tr>
                <?
                    $y=date('Y');
                    $sql="SELECT empcode,name,year,month,date,slid from salary,employee where emp_code=empcode and salary.client_id='$clientid' and empcode='$empcode' and year='$y' order by date desc";
                    $res=$con->query($sql); $i=1; 
                    while($row=mysqli_fetch_array($res))
                    {   $id=$row['slid'];
                        $ym=$row['year']."-".$row['month'];
                    ?>
                        <tr>
                            <td><?echo $i++;?></td>
                            <td><?echo $row['empcode'];?></td>
                            <td><?echo $row['name'];?></td>
                            <td><b><?echo date("M-Y",strtotime($ym));?></b></td>
                            <td><?echo date("d-m-Y",strtotime($row['date']));?></td>
                            <td align="center"><a target="_blank" href="salary_download?id=<?echo base64_encode($id);?>"><i class="fa fa-download"></i></a></td>
                        </tr>
                    <?}
                ?>
            </table>
        </div>
        <div class="clear"></div>
    </div>
</div>




<script type="text/javascript">
    function adt_month(val)
    {
        xmlhttp=new XMLHttpRequest();
        xmlhttp.open("GET","attendance_history_cal?find="+val,false);
        xmlhttp.send(null);
        document.getElementById('data').innerHTML=xmlhttp.responseText;
    }
</script>







<?include('extra/footer.php');?>