<!DOCTYPE html>
<html>
<head>
    <title>LWF Return</title>

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
    $f=$_REQUEST['f'];
    $t=$_REQUEST['t'];
    $e=$_REQUEST['e'];
    $b=$_REQUEST['b'];
    $clid=$_REQUEST['cl'];

    $sy=substr($f,0,4);
    $std="01-04-".$sy;
    $ltd="31-03-".($sy+1);
      
    $sql="select * from employee where pt='Y' and client_id='$clid'";
    if($e!="")
        $sql .=" and empcode='$e'";
    if($b!="")
        $sql .=" and location='$b'";
        
    $sql.="order by (emp_id) asc";

    $res=$con->query($sql);

    $data2=mysqli_fetch_array($con->query("select * from company where client_id='$clid'"));

?>

<div id="report">
    <table border="1"> 
        <tr>
            <td>#</td>
            <td>Emp code</td>
            <td>Name</td>
            <td>Branch</td>
            <td>Category</td>
            <td>State</td>
            <td>Salary</td>
            <td align='center'>EMP. P Tax</td>
            <td align='center'>Employer</td>
            <td align='center'>Total</td>
        </tr>
        <?  
            $i=1;
            while($row=mysqli_fetch_array($res))
            {   extract($row);
                ?>
                <tr>
                    <td><?= $i++;?></td>
                    <td><?= $empcode;?></td>
                    <td><?= $name;?></td>
                    <td><?= $location;?></td>
                    <td><?= $category;?></td>
                    <td><?= $state;?></td>
                    <?
                        $a=4; $aa=1; $ptalw=0; $ptax=0; $ertax=0;
                        while($a<=15)
                        {
                            if($a<13)
                            {
                                $ya=$sy;
                                $mm=$a;
                            }
                            else
                            {
                                $ya=($sy+1);
                                $mm=$aa++;
                            }
                            $sql="SELECT pt_alw_pay,pt,er_pt from salary where emp_code='$empcode' and year='$ya' and month='$mm' and client_id='$clid'";
                            $prow=mysqli_fetch_array($con->query($sql));
                            $ptalw+=$prow[0];
                            $ptax+=$prow[1];
                            $ertax+=$prow[2];

                            $a++;
                        }
                    ?>
                    <td align="center"><?echo $ptalw;?></td>
                    <td align="center"><?echo $ptax;?></td>
                    <td align="center"><?echo $ertax;?></td>
                    <td align="center"><?echo $ptax+$ertax;?></td>
                </tr>
            <?}
        ?>
    </table>
</div>




<script type="text/javascript" src="../js/jquery.min.js"></script>
<script src="../js/table2excel.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        // $("#report").table2excel({
        //     filename: "LWF Return.xls"
        // });
    });
</script>
</body>
</html>

