<!DOCTYPE html>
<html>
<head>
    <title>Income Tax Upload Smaple Fromate List</title>

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
            <td>Other Salary</td>
            <td>HRA</td>
            <td>Standard deduction</td>
            <td>Reimbursment</td>
            <td>Professional Tax</td>
            <td>Deductions u/s 80 C </td>
            <td>Deductions u/s 80 CCD</td>
            <td>Deductions u/s 80 D (Inc. Spouse & Children)</td>
            <td>Deductions u/s 80 D (For Parents)</td>
            <td>Deductions u/s 80 G</td>
            <td>Deductions u/s 80 E</td>
            <td>Deductions u/s 80 TTA</td>
        </tr>
        <?  
            while($row=mysqli_fetch_array($res))
            {   $aa=1; $eid=$row['emp_id']; 
                ?>
                <tr>
                    <td><?echo $code=$row['empcode'];?></td>
                    <td><?echo $name=$row['name'];?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
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
            filename: "Income Tax Smaple Fromate.xls"
        });
    });
</script>
</body>
</html>

