<!DOCTYPE html>
<html>
<head>
    <title>Employee Master Data</title>

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
    $clientid=$_REQUEST['cl'];
    
    $sql="select * from employee where client_id='$clientid' order by (emp_id) asc";
    $res=$con->query($sql);
?>

<div id="report">
    <table border="1"> 
        <tr>
            <td>#</td>
            <td>Emp code</td>
            <td>Name*</td>
            <td>Father's/Spouse Name*</td>
            <td>Relation*</td>
            <td>DOB*</td>
            <td>Gender*</td>
            <td>Marital Status</td>
            <td>Mob No</td>
            <td>Personal Email ID</td>
            <td>Current Address</td>
            <td>Permanent Address</td>
            <td>Nationality</td>
            <td>Education</td>
            <td>Adhaar no</td>
            <td>City Type</td>
            <td>Bank Name</td>
            <td>Account No.</td>
            <td>IFSC code </td>
            <td>Bank Branch</td>
            <td>Payment mode</td>
            <td>Designation</td>
            <td>DOJ</td></td>
            <td>Department</td>
            <td>Categary </td>
            <td>Religion</td>
            <td>Pan card No</td>
            <td>Job Location</td>
            <td>UAN number</td>
            <td>PF code</td>
            <td>ESI number</td>
            <td>Reporting Manager</td>
            <td>RM Emp ID</td>
            <td>Official Email ID</td>
            <td>DOL </td>
            <td>Field 1 </td>
            <td>Field 2</td>
            <td>Field 3</td>
            <td>Field 4</td>
            <td>Field 5</td>
            <td>EL</td>
            <td>SL</td>
            <td>CL</td>
            <td>HO</td>
            <td>PF</td>
            <td>Pension</td>
            <td>ESI</td>
            <td>LWF</td>
            <td>TDS</td>
            <td>PT</td>
            <td>OT</td>
            <td>Bonus</td>
            <td>Gratuity</td>
            <td>EMP. Login</td> 
            <td>Attendance Marking</td>
            <td>Working hour</td>
            <?
                $sql="SELECT * from allowance where type='Fix' and client_id='$clientid' order by aid asc";
                $re=$con->query($sql);
                while($al=mysqli_fetch_array($re))
                {?>
                    <td><?echo $al['allowance'];?></td>
                <?}
            ?>
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
                    <td><?= $fname;?></td>
                    <td><?= $relation;?></td>
                    <td><?= date("d-m-Y",strtotime($dob));?></td>
                    <td><?= $gender;?></td>
                    <td><?= $marital;?></td>
                    <td><?= $mobile;?></td>
                    <td><?= $email;?></td>
                    <td><?= $current_address;?></td>
                    <td><?= $permanent_address;?></td>
                    <td><?= $nationality;?></td>
                    <td><?= $education;?></td>
                    <td>'<?= $adhaar;?></td>
                    <td><?= $city_type;?></td>
                    <td><?= $bank;?></td>
                    <td>'<?= $account;?></td>
                    <td><?= $ifsc;?></td>
                    <td><?= $branch;?></td>
                    <td><?= $payment_mode;?></td>
                    <td><?= $designation;?></td>
                    <td><?= date("d-m-Y",strtotime($doj));?></td>
                    <td><?= $department;?></td>
                    <td><?= $category;?></td>
                    <td><?= $religion;?></td>
                    <td><?= $pan;?></td>
                    <td><?= $location;?></td>
                    <td>'<?= $uan;?></td>
                    <td><?= $pf_code;?></td>
                    <td><?= $esi_code;?></td>
                    <td><?= $rep_manager;?></td>
                    <td><?= $rmid;?></td>
                    <td><?= $email_id;?></td>
                    <td><? if($dol!=""){date("d-m-Y", strtotime($dol));}?></td>
                    <td><?= $field1;?></td>
                    <td><?= $field2;?></td>
                    <td><?= $field3;?></td>
                    <td><?= $field4;?></td>
                    <td><?= $field5;?></td>
                    <td><?= $el;?></td>
                    <td><?= $sl;?></td>
                    <td><?= $cl;?></td>
                    <td><?= $ho;?></td>
                    <td><?= $pf;?></td>
                    <td><?= $pension;?></td>
                    <td><?= $esi;?></td>
                    <td><?= $lwf;?></td>
                    <td><?= $tds;?></td>
                    <td><?= $pt;?></td>
                    <td><?= $ot;?></td>
                    <td><?= $bonus;?></td>
                    <td><?= $gratuty;?></td>
                    <td><?= $login;?></td>
                    <td><?= $atd;?></td>
                    <td><?= $work_hour;?></td>
                    <?
                        $sql="SELECT amount from allowance,employee_breakup where allowance=emp_allowance and emp_code='$empcode' and allowance.client_id='$clientid' order by aid asc";
                        $re=$con->query($sql);
                        while($al=mysqli_fetch_array($re))
                        {?>
                            <td><?echo $al['amount'];?></td>
                        <?}
                    ?>
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
            filename: "Employee Master data.xls"
        });
    });
</script>
</body>
</html>

