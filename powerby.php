<?php

include('extra/connect.php');
$val=$_REQUEST['find'];



$con->query("update setting set sett='$val' where sid='1'");
echo "<script>window.location.href='setting';</script>";


?>