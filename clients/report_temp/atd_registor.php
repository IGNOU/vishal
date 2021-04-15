<!DOCTYPE html>
<html>
<head>
    <title>Attendance Registor</title>

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
    
    $data2=mysqli_fetch_array($con->query("select * from company where client_id='$clid'"));

?>

<div id="report">
    <table border="1"> 
        <tr>
            <td colspan="45" align="center">
                <h2>Muster Roll </h2>                                                                    
                <b>FORM V Rule 26(5)</b>
            </td>
        </tr>
        <tr>
            <td colspan="4">Name of Establishment</td>
            <td colspan="20"><b><?echo $data2['name'];?></b></td>
            <td colspan="10">EPF Registration no.</td>
            <td colspan="11"><?echo $data2['pf'];?></td>
        </tr>
        <tr>
            <td colspan="4">Address of employer</td>
            <td colspan="20"><b><?echo $data2['address'];?></b></td>
            <td colspan="10">ESIC Registration no.</td>
            <td colspan="11"><?echo $data2['esi'];?></td>
        </tr>
        <tr>
            <td colspan="4">Year</td>
            <td colspan="41"><b><?echo date("M-Y",strtotime($ym));?></b></td>
        </tr>
        
        <?  
            $i=1;
            
            $dateObj   = DateTime::createFromFormat('!m', $m);
            $month=$dateObj->format('F');
            ?>
            <tr>
                <td>#</td>
                <td>Emp code</td>
                <td>Name</td>
                <td>Fathe's Name</td>
                <td>Category</td>
                <td>Designation</td>
                <?
                    $a=1;
                    while($a<=31)
                    {
                        echo "<td align='center'>".$a."</td>";
                        $a++;
                    }
                ?>
                <td>P</td>
                <td>W</td>
                <td>CL</td>
                <td>EL</td>
                <td>SL</td>
                <td>HO</td>
                <td align='center'>Total</td>
                <td>OT</td>
            </tr>
            <?
            $sql="select * from employee where client_id='$clid'";
            if($e!="")
                $sql .=" and empcode='$e'";
            if($b!="")
                $sql .=" and location='$b'";
            $sql.="order by (emp_id) asc";
            $res=$con->query($sql);

            while($row=mysqli_fetch_array($res))
            {   
                extract($row);
                ?>
                <tr>
                    <td><?= $i++;?></td>
                    <td><?= $empcode;?></td>
                    <td><?= $name;?></td>
                    <td><?= $fname;?></td>
                    <td><?= $category;?></td>
                    <td><?= $designation;?></td>
                    <?
                        $a=1;
                        if($m<10)
                            $ya="0".$m;
                        else
                            $ya=$m;
                        while($a<=31)
                        {
                            if($a<10)
                                $dd=$ya."-0".$a;
                            else
                                $dd=$ya."-".$a;
                            $sql="SELECT * from attendance where emp_code='$empcode' and year='$y' and client_id='$clid' and atd_date like '%$dd'";
                            $at=$con->query($sql);
                            $atd=mysqli_fetch_array($at);
                            echo "<td align='center'>".$atd['atd']."</td>";
                            $a++;
                        }
                    ?>
                    <td><?echo $p=mysqli_num_rows($con->query("select * from attendance where year='$y' and month='$m' and client_id='$clid' and emp_code='$empcode' and atd='P'"));?></td>
                    <td><?echo $w=mysqli_num_rows($con->query("select * from attendance where year='$y' and month='$m' and client_id='$clid' and emp_code='$empcode' and atd='W'"));?></td>
                    <td><?echo $cl=mysqli_num_rows($con->query("select * from attendance where year='$y' and month='$m' and client_id='$clid' and emp_code='$empcode' and atd='CL'"));?></td>
                    <td><?echo $el=mysqli_num_rows($con->query("select * from attendance where year='$y' and month='$m' and client_id='$clid' and emp_code='$empcode' and atd='EL'"));?></td>
                    <td><?echo $sl=mysqli_num_rows($con->query("select * from attendance where year='$y' and month='$m' and client_id='$clid' and emp_code='$empcode' and atd='SL'"));?></td> 
                    <td><?echo $ho=mysqli_num_rows($con->query("select * from attendance where year='$y' and month='$m' and client_id='$clid' and emp_code='$empcode' and atd='HO'"));?></td>
                    <td><?echo $p+$w+$cl+$el+$sl+$ho;?></td>
                    <td><?$ot=mysqli_fetch_array($con->query("SELECT ot_hrs from salary where emp_code='$empcode' and year='$y' and month='$m' and client_id='$clid'")); echo $ot['ot_hrs'];?></td>
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
            filename: "Attendance Registor.xls"
        });
    });
</script>
</body>
</html>

