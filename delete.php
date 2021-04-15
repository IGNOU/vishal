<?php
include('extra/connect.php');
$id=$_REQUEST['id'];
$tname=$_REQUEST['tname'];


if($tname=='plan')
{
	$con->query("delete from plan where pid='$id'");
	echo "<script>window.location.href='Plan';</script>";
}

if($tname=='client')
{
	$con->query("delete from client where cid='$id'");
	echo "<script>window.location.href='Client';</script>";
}



?>