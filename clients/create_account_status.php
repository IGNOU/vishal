<?php

include('extra/connect.php');
$id=$_REQUEST['tid'];
$st=$_REQUEST['st'];


mysql_query("update user1 set status='$st' where userid='$id'");
echo "<script>window.location.href='create_account';</script>";


?>