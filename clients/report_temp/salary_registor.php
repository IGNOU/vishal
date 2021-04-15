<!DOCTYPE html>
<html>
<head>
    <title>Salary Registor</title>

    <style type="text/css">
        table{
            border: 1px solid #333;
            width: 300%;
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
    
    $data2=mysqli_fetch_array($con->query("select * from company where client_id='$clid'"));

?>

<div id="report">
    <table border="1"> 
        <tr>
            <td colspan="38" align="center">
                <h2>Register of  Wages (Central) Rules Form X</h2>                                                         
                <b>Register of Wages Rule 26(a)</b>
            </td>
        </tr>
        <tr>
            <td colspan="3">Name of Establishment</td>
            <td colspan="16"><b><?echo $data2['name'];?></b></td>
            <td colspan="3">EPF Registration no.</td>
            <td colspan="16"><?echo $data2['pf'];?></td>
        </tr>
        <tr>
            <td colspan="3">Address of employer</td>
            <td colspan="16"><b><?echo $data2['address'];?></b></td>
            <td colspan="3">ESIC Registration no.</td>
            <td colspan="16"><?echo $data2['esi'];?></td>
        </tr>
        <tr>
            <td colspan="3">Salary for the Month </td>
            <td colspan="35"><b><?echo date("M-Y",strtotime($ym));?></b></td>
        </tr>
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
                $sql="SELECT * from allowance where type='Fix' and client_id='$clid' order by aid asc";
                $re=$con->query($sql);
                while($al=mysqli_fetch_array($re))
                {?>
                    <td align="right"><?echo $al['allowance'];?></td>
                <?}
            ?>
            <td align="right">Gross</td>
            <?
                $sql="SELECT * from allowance where type='Fix' and client_id='$clid' order by aid asc";
                $re=$con->query($sql);
                while($al=mysqli_fetch_array($re))
                {?>
                    <td align="right"><?echo $al['allowance'];?></td>
                <?}

                $sql="SELECT * from allowance where type='Variable' and client_id='$clid' order by aid asc";
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
                $sql="SELECT * from deduction where client_id='$clid'";
                $re=$con->query($sql);
                while($dec=mysqli_fetch_array($re))
                {?>
                    <td><?echo $dec['deduction'];?></td>
                <?}
            ?>
            <td>Total Dec.</td>
            <td>Net Payable</td>
            <td>Account No.</td>
        </tr>
        <?
            $sql="SELECT name,designation,doj,category,department,location,account,slid,emp_code, pay_day, ot_hrs, gross, salary.bonus, over_time,leave_ench,gross_salary, salary.pf, salary.esi, salary.tds, salary.pt, salary.lwf, total_dec, net_payable, er_pf, er_esi, er_pt, er_lwf, paid_ctc from salary,employee where emp_code=empcode and salary.client_id='$clid' and year='$y' and month='$m'";
            if($e!="")
                $sql.=" and emp_code='$e'";
            if($b!="")
                $sql.=" and location='$b'";

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

                        $sq="SELECT amt from salary_breakup,allowance where allowance=variable and emp_code='$code'and year='$y' and month='$m' and salary_breakup.client_id='$clid'";
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
                            $sql="SELECT * from allowance where type='Variable' and client_id='$clid' order by aid asc";
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
                        $sq="SELECT amt from salary_breakup,deduction where deduction=variable and emp_code='$code'and year='$y' and month='$m' and salary_breakup.client_id='$clid'";
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
                            $sql="SELECT * from deduction where client_id='$clid'";
                            $re=$con->query($sql);
                            while($dec=mysqli_fetch_array($re))
                            {?>
                                <td>0.00</td>
                            <?}
                        }
                    ?>
                    <td><?echo $row['total_dec'];?></td>
                    <td><?echo $row['net_payable'];?></td>
                    <td>'<?echo $row['account'];?></td>
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
            filename: "Salary Registor.xls"
        });
    });
</script>
</body>
</html>

