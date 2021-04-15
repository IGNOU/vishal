<!DOCTYPE html>
<html>
<head>
    <title>Salary Upload Smaple Fromate List</title>

    <style type="text/css">
        table{
            border: 1px solid #333;
            width: 110%;
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
    include('extra/connect.php');
    $clientid=$_REQUEST['cl'];
    
    $sql="select * from employee where dol='' and client_id='$clientid' order by (emp_id) asc";
    $res=$con->query($sql);
?>

<div id="report">
    <table border="1"> 
        <tr>
            <td>Emp Id</td>
            <td>Name</td>
            <td>Designation</td>
            <td>DOJ</td>
            <td>Department</td>
            <td>Branch</td>
            <?
                $sql="SELECT * from allowance where type='Variable' order by aid asc";
                $re=$con->query($sql);
                while($al=mysqli_fetch_array($re))
                {?>
                    <td align="right" style="text-transform: capitalize;"><?echo $al['allowance'];?></td>
                <?}
            
                $sql="SELECT * from deduction where client_id='$clientid'";
                $re=$con->query($sql);
                while($dec=mysqli_fetch_array($re))
                {?>
                    <td><?echo $dec['deduction'];?></td>
                <?}
            ?>
        </tr>
        <?  
            while($row=mysqli_fetch_array($res))
            {   $aa=1; $eid=$row['emp_id']; 
                ?>
                <tr>
                    <td><?echo $code=$row['empcode'];?></td>
                    <td><?echo $name=$row['name'];?></td>
                    <td><?echo $name=$row['designation'];?></td>
                    <td><?echo date('d-m-Y', strtotime($name=$row['doj']));?></td>
                    <td><?echo $name=$row['department'];?></td>
                    <td><?echo $name=$row['location'];?></td>
                    <?
                        $sql="SELECT * from allowance where type='Variable' order by aid asc";
                        $re=$con->query($sql);
                        while($al=mysqli_fetch_array($re))
                        {?>
                            <td></td>
                        <?}
                    
                        $sql="SELECT * from deduction where client_id='$clientid'";
                        $re=$con->query($sql);
                        while($dec=mysqli_fetch_array($re))
                        {?>
                            <td></td>
                        <?}
                    ?>
                </tr>

            <?}
        ?>
    </table>
</div>


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="js/table2excel.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $("#report").table2excel({
            filename: "Salary Smaple Fromate.xls"
        });
    });
</script>
</body>
</html>

