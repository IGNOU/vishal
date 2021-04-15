<!DOCTYPE html>
<html>
<head>
    <title>Monthly new staff</title>

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
<?php 
    include('../extra/connect.php');
    $m=$_REQUEST['m'];
    $y=$_REQUEST['y'];

    $cl=$_REQUEST['cl'];

    $ym=$y."-".$m;
    
    $sql="select * from employee where dol like '$ym%' and client_id='$cl' order by (emp_id) asc";
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
            <?php 
                $sql="SELECT * from allowance where type='Fix' and client_id='$cl' order by aid asc";
                $re=$con->query($sql);
                while($al=mysqli_fetch_array($re))
                {?>
                    <td><?php echo $al['allowance'];?></td>
                <?php }
            ?>
        </tr>
        <?php   
            $i=1;
            while($row=mysqli_fetch_array($res))
            {   extract($row);
                ?>
                <tr>
                    <td><?php = $i++;?></td>
                    <td><?php = $empcode;?></td>
                    <td><?php = $name;?></td>
                    <td><?php = $fname;?></td>
                    <td><?php = $relation;?></td>
                    <td><?php = date("d-m-Y",strtotime($dob));?></td>
                    <td><?php = $gender;?></td>
                    <td><?php = $marital;?></td>
                    <td><?php = $mobile;?></td>
                    <td><?php = $email;?></td>
                    <td><?php = $current_address;?></td>
                    <td><?php = $permanent_address;?></td>
                    <td><?php = $nationality;?></td>
                    <td><?php = $education;?></td>
                    <td>'<?php = $adhaar;?></td>
                    <td><?php = $city_type;?></td>
                    <td><?php = $bank;?></td>
                    <td>'<?php = $account;?></td>
                    <td><?php = $ifsc;?></td>
                    <td><?php = $branch;?></td>
                    <td><?php = $payment_mode;?></td>
                    <td><?php = $designation;?></td>
                    <td><?php = date("d-m-Y",strtotime($doj));?></td>
                    <td><?php = $department;?></td>
                    <td><?php = $category;?></td>
                    <td><?php = $religion;?></td>
                    <td><?php = $pan;?></td>
                    <td><?php = $location;?></td>
                    <td>'<?php = $uan;?></td>
                    <td><?php = $pf_code;?></td>
                    <td><?php = $esi_code;?></td>
                    <td><?php = $rep_manager;?></td>
                    <td><?php = $rmid;?></td>
                    <td><?php = $email_id;?></td>
                    <td><?php  if($dol!=""){date("d-m-Y", strtotime($dol));}?></td>
                    <td><?php = $field1;?></td>
                    <td><?php = $field2;?></td>
                    <td><?php = $field3;?></td>
                    <td><?php = $field4;?></td>
                    <td><?php = $field5;?></td>
                    <td><?php = $el;?></td>
                    <td><?php = $sl;?></td>
                    <td><?php = $cl;?></td>
                    <td><?php = $ho;?></td>
                    <td><?php = $pf;?></td>
                    <td><?php = $pension;?></td>
                    <td><?php = $esi;?></td>
                    <td><?php = $lwf;?></td>
                    <td><?php = $tds;?></td>
                    <td><?php = $pt;?></td>
                    <td><?php = $ot;?></td>
                    <td><?php = $bonus;?></td>
                    <td><?php = $gratuty;?></td>
                    <td><?php = $login;?></td>
                    <td><?php = $atd;?></td>
                    <td><?php = $work_hour;?></td>
                    <?php 
                        $sql="SELECT amount from allowance,employee_breakup where allowance=emp_allowance and emp_code='$empcode' and allowance.client_id='$cl' order by aid asc";
                        $re=$con->query($sql);
                        while($al=mysqli_fetch_array($re))
                        {?>
                            <td><?php echo $al['amount'];?></td>
                        <?php }
                    ?>
                </tr>
            <?php }
        ?>
    </table>
</div>


<script type="text/javascript" src="../js/jquery.min.js"></script>
<script src="../js/table2excel.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $("#report").table2excel({
            filename: "Monthly new staff.xls"
        });
    });
</script>
</body>
</html>

