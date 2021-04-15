<!DOCTYPE html>
<html>
<head>
    <title>Gratuity Calculation</title>

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
    $e=$_REQUEST['e'];
    $b=$_REQUEST['b'];
    $clid=$_REQUEST['cl'];

    //$ym=substr($y,0,4)."-".$m;
    
    $sql="select * from employee where dol!='' and client_id='$clid'";

    if($e!="")
        $sql .=" and empcode='$e'";
    if($b!="")
        $sql .=" and location='$b'";

    $sql.=" order by (emp_id) asc";

    $res=$con->query($sql);
?>

<div id="report">
    <h2 align="center">Gratuity Calculation</h2>
    <table border="1"> 
        <tr>
            <td>#</td>
            <td>Emp code</td>
            <td>Name</td>
            <td align="center">Age</td>
            <td>DOJ</td>
            <td>DOL</td>
            <td>Branch</td>
            <td align="right">Last Drawn Salary (Basic & DA)</td>
            <td align="center">No Of Year</td>
            <td align="right">Gratuity</td>
        </tr>
        <?  
            $i=1;
            while($row=mysqli_fetch_array($res))
            {   extract($row);
                $diff = date_diff(date_create($doj), date_create($dol));
                $year=$diff->format('%y');

                if($year>=5)
                {
                    ?>
                    <tr>
                        <td><?= $i++;?></td>
                        <td><?= $empcode;?></td>
                        <td><?= $name;?></td>
                        <td align="center">
                            <?
                                $today = date("Y-m-d");
                                $diff = date_diff(date_create($dob), date_create($dol));
                                echo $diff->format('%y');
                            ?>
                        </td>
                        <td><?= date('d-M-Y', strtotime($doj));?></td>
                        <td><?= date('d-M-Y', strtotime($dol));?></td>
                        <td><?= $location;?></td>
                        <td align="right">
                            <?
                                $sql="SELECT alw,sum(amt),multiple,devided from salary_breakup_amt,com_gratuty,com_gratuty_allowance where com_gratuty.gid=com_gratuty_allowance.gid and alw=g_allowance and slid=(SELECT max(slid) from salary_breakup_amt where code='$empcode' and client_id='$clid')"; 
                                $gt=mysqli_fetch_array($con->query($sql));
                                echo number_format($gt['1'],2);
                            ?>
                        </td>
                        <td align="center"><?echo $year;?></td>
                        <td align="right"><?echo number_format($gt['1']/$gt['devided']*$gt['multiple']*$year,2);?></td>
                    </tr>
                <?}
            }
        ?>
    </table>
</div>




<script type="text/javascript" src="../js/jquery.min.js"></script>
<script src="../js/table2excel.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $("#report").table2excel({
            filename: "Gratuity Calculation.xls"
        });
    });
</script>
</body>
</html>

