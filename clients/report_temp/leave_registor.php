<!DOCTYPE html>
<html>
<head>
    <title>Leave Registor</title>

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
            <td colspan="38" align="center">
                <h2>Leave & Holidays Register</h2>                                                         
                <b>FORM J (Rule 14)</b>
            </td>
        </tr>
        <tr>
            <td colspan="3">Name of Establishment</td>
            <td colspan="17"><b><?echo $data2['name'];?></b></td>
        </tr>
        <tr>
            <td colspan="3">Address of employer</td>
            <td colspan="17"><b><?echo $data2['address'];?></b></td>
        </tr>
        <tr>
            <td colspan="3">Salary for the Month </td>
            <td colspan="17"><b><?echo date("M-Y",strtotime($ym));?></b></td>
        </tr>
        <tr>
            <td colspan="7"></td>
            <td colspan="3" align="center">CL</td>
            <td colspan="3" align="center">SL</td>
            <td colspan="3" align="center">EL</td>
            <td colspan="3" align="center">HO</td>
            <td></td>
        </tr>
        <tr>
            <td>#</td>
            <td>Emp Id</td>
            <td>Name</td>
            <td>Designation</td>
            <td>DOJ</td>
            <td>Category</td>
            <td>Branch</td>
            <td>Opening</td>
            <td>Availed</td>
            <td>Balance</td>
            <td>Opening</td>
            <td>Availed</td>
            <td>Balance</td>
            <td>Opening</td>
            <td>Availed</td>
            <td>Balance</td>
            <td>Opening</td>
            <td>Availed</td>
            <td>Balance</td>
            <td>Remarks</td>
        </tr>
        <?
            $sql="SELECT empcode,name,designation,doj,category,location,leave_update.el,el_l,leave_update.sl,sl_l,leave_update.cl,cl_l,leave_update.ho,ho_l from leave_update,employee where emp_code=empcode and leave_update.client_id='$clid' and year='$y' and month='$m'";
            if($e!="")
                $sql.=" and emp_code='$e'";
            if($b!="")
                $sql.=" and location='$b'";
            $res=$con->query($sql); $i=1;
            while($row=mysqli_fetch_array($res)) 
            { 
            ?>
                <tr>
                    <td><?echo $i++;?></td>
                    <td><?echo $code=$row['empcode'];?></td>
                    <td><?echo $row['name'];?></td>
                    <td><?echo $row['designation'];?></td>
                    <td><?echo date('d-m-Y', strtotime($name=$row['doj']));?></td>
                    <td><?echo $row['category'];?></td>
                    <td><?echo $row['location'];?></td>
                    <td align="center"><?echo $row['cl'];?></td>
                    <td align="center"><?echo $row['cl_l'];?></td>
                    <td align="center"><?echo $row['cl']-$row['cl_l'];?></td>
                    <td align="center"><?echo $row['sl'];?></td>
                    <td align="center"><?echo $row['sl_l'];?></td>
                    <td align="center"><?echo $row['sl']-$row['sl_l'];?></td>
                    <td align="center"><?echo $row['el'];?></td>
                    <td align="center"><?echo $row['el_l'];?></td>
                    <td align="center"><?echo $row['el']-$row['el_l'];?></td>
                    <td align="center"><?echo $row['ho'];?></td>
                    <td align="center"><?echo $row['ho_l'];?></td>
                    <td align="center"><?echo $row['ho']-$row['ho_l'];?></td>
                    <td></td>
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
            filename: "Leave Registor.xls"
        });
    });
</script>
</body>
</html>

