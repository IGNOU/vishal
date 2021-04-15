<?php
include('extra/connect.php');
$id=$_REQUEST['id'];
$tname=$_REQUEST['tname'];


if($tname=='company')
{
	$q=mysqli_fetch_array($con->query("select * from company where cmid='$id'"));
	$im=$q['logo'];
	unlink("img/$im");
	$con->query("delete from company where cmid='$id'");
	echo "<script>window.location.href='create_company';</script>";
}

if($tname=='designation')
{
	$con->query("delete from designation where des_id='$id'");
	echo "<script>window.location.href='Designation';</script>";
}

if($tname=='department')
{
	$con->query("delete from department where depid='$id'");
	echo "<script>window.location.href='Department';</script>";
}


if($tname=='sessions')
{
	$con->query("delete from sessions where sid='$id'");
	echo "<script>window.location.href='session';</script>";
}

if($tname=='branch')
{
	$con->query("delete from branch where bid='$id'");
	echo "<script>window.location.href='Branch';</script>";
}

if($tname=='categary')
{
	$con->query("delete from categary where ctid='$id'");
	echo "<script>window.location.href='Categary';</script>";
}

if($tname=='Allowance')
{
	$con->query("delete from allowance where aid='$id'");
	echo "<script>window.location.href='Allowance';</script>";
}

if($tname=='com_pf')
{
	$con->query("delete from com_pf where pfid='$id'");
	$con->query("delete from com_pf_allowance where pf_id='$id'");
	echo "<script>window.location.href='setting_pf';</script>";
}

if($tname=='com_esi')
{
	$con->query("delete from com_esi where esi_id='$id'");
	$con->query("delete from com_esi_allowance where esi_id='$id'");
	echo "<script>window.location.href='setting_esi';</script>";
}

if($tname=='com_lwf')
{
	$con->query("delete from com_lwf where lwf_id='$id'");
	$con->query("delete from com_lwf_allowance where lwf_id='$id'");
	echo "<script>window.location.href='setting_lwf?f=0';</script>";
}

if($tname=='com_pt')
{
	$con->query("delete from com_pt where pt_id='$id'");
	$con->query("delete from com_pt_allowance where pt_id='$id'");
	echo "<script>window.location.href='setting_pt?f=0';</script>";
}

if($tname=='com_overtime')
{
	$con->query("delete from com_overtime where ov_id='$id'");
	$con->query("delete from com_overtime_allowance where ov_id='$id'");
	echo "<script>window.location.href='setting_overtime';</script>";
}

if($tname=='com_bonus')
{
	$con->query("delete from com_bonus where bid='$id'");
	$con->query("delete from com_bonus_allowance where bid='$id'");
	echo "<script>window.location.href='setting_bonus?f=0';</script>";
}

if($tname=='com_gratuty')
{
	$con->query("delete from com_gratuty where gid='$id'");
	$con->query("delete from com_gratuty_allowance where gid='$id'");
	echo "<script>window.location.href='setting_gratuti';</script>";
}

if($tname=='appointment_letter')
{
	$con->query("delete from appointment_letter where client_id='$id'");
	echo "<script>window.location.href='appointment';</script>";
}

if($tname=='com_abm')
{
	$con->query("delete from com_abm where abmid='$id'");
	echo "<script>window.location.href='setting_abs';</script>";
}

if($tname=='com_notice')
{
	$con->query("delete from com_notice where nid='$id'");
	$con->query("delete from com_notice_details where nid='$id'");
	echo "<script>window.location.href='setting_notice';</script>";
}

if($tname=='com_wap')
{
	$con->query("delete from com_wap where wid='$id'");
	echo "<script>window.location.href='setting_wap';</script>";
}

if($tname=='com_week')
{
	$con->query("delete from com_week where client_id='$id'");
	echo "<script>window.location.href='setting_week';</script>";
}

if($tname=='com_shift')
{
	$con->query("delete from com_shift where csid='$id'");
	echo "<script>window.location.href='setting_shift';</script>";
}

if($tname=='com_incometax')
{
	$con->query("delete from com_incometax where ci_id='$id'");
	echo "<script>window.location.href='setting_incometax';</script>";
}

if($tname=='com_leave')
{
	$con->query("delete from com_leave where lid='$id'");
	$con->query("delete from com_leave_allowance where l_id='$id'");
	echo "<script>window.location.href='setting_leave';</script>";
}

if($tname=='com_shift')
{
	$con->query("delete from com_shift where csid='$id'");
	echo "<script>window.location.href='setting_shift';</script>";
}


if($tname=='salary')
{
	$m=$_REQUEST['m'];
	$clid=$_REQUEST['cl'];

	$con->query("delete from salary where year='$id' and month='$m' and client_id='$clid'");
    $con->query("delete from salary_breakup_amt where year='$id' and month='$m' and client_id='$clid'");
    $con->query("delete from salary_breakup where year='$id' and month='$m' and client_id='$clid'");
	$res=$con->query("SELECT * from leave_update where year='$id' and month='$m' and client_id='$clid'");
    while($row=mysqli_fetch_array($res))
	{
		extract($row);
		$sql="UPDATE employee set el='$el',sl='$sl',cl='$cl',ho='$ho' where empcode='$emp_code' and client_id='$clid'";
    	$con->query($sql);
    }
    $con->query("delete from leave_update where year='$id' and month='$m' and client_id='$clid'");
	echo "<script>window.location.href='sallary';</script>";
}

if($tname=='attendance')
{
	$m=$_REQUEST['m'];
	$cl=$_REQUEST['cl'];

	$con->query("delete from attendance where year='$id' and month='$m' and client_id='$cl'");
    $con->query("delete from over_time where year='$id' and month='$m' and client_id='$cl'");

	echo "<script>window.location.href='attendance';</script>";
}

if($tname=='all_employee')
{
	$clid=$_REQUEST['cl'];

	$con->query("delete from employee where client_id='$clid'");
    $con->query("delete from employee_breakup where client_id='$clid'");
	$con->query("delete from attendance where client_id='$clid'");
	$con->query("delete from salary where client_id='$clid'");
    $con->query("delete from salary_breakup_amt where client_id='$clid'");
    $con->query("delete from salary_breakup where client_id='$clid'");
    $con->query("delete from leave_update where client_id='$clid'");

	echo "<script>window.location.href='employee_show';</script>";
}


?>