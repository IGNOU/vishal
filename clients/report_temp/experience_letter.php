<?php
    $e=$_REQUEST['e'];
    $clid=$_REQUEST['cl'];
    include('../extra/connect.php');
    $row=mysqli_fetch_array($con->query("SELECT * from employee where empcode='$e' and client_id='$clid'"));
    extract($row);

    $data=mysqli_fetch_array($con->query("select * from company where client_id='$clid'"));


    header("Content-type: application/vnd.ms-word");  
    header("Content-Disposition: attachment;Filename=".$name."-".$empcode.".doc");  
    header("Pragma: no-cache");  
    header("Expires: 0"); 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Experience Letter</title>

    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap');
        table{
            width: 100%;
            font-family: 'Roboto', sans-serif;
            font-size: .9em;
        }
        td{
            padding: 5px;
        }
    </style>
</head>
<body>
<table>
    <tr>
        <td align="right" ><?echo date('d-M-Y');?></td>
    </tr>
    <tr>
        <td align="center" style="font-size: 1.5em; font-weight: bold;"><u><b>Experience Letter</b></u><br><br></td>
    </tr>
    <tr>
        <td>
            This is to certify that Mr/Ms. <b><?echo $name;?></b> has worked with our organization as a <b><?echo $designation;?></b> from <b><?echo date('d-M-Y',strtotime($doj));?></b> to <b><?if($dol!="") {echo date('d-M-Y',strtotime($dol));}?></b>.<br><br>

            During his/her service with us, we found  very hardworking, knowledgeable, effective and sincere. He/She carried out all duties entrusted to willingly, effectively and to our entire satisfaction. <br><br>

            He/She has resigned and left the organisation of his/her own accord.<br><br>
            We wish his/her to successful career.<br><br><br><br><br><br>


            <b>For <?echo $data['name'];?></b><br><br><br><br>


            Authorized Signatory

        </td>
    </tr>
</table>
</body>
</html>

