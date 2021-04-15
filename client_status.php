<?php

include('extra/connect.php');
$id=$_REQUEST['tid'];
$st=$_REQUEST['st'];


$s="update client set status='$st' where cid='$id'";
$con->query($s);
echo "<script>window.location.href='Client';</script>";


?>