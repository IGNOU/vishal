<!DOCTYPE html>
<html>
<head>
	<title>Employee Add Smaple Fromate</title>

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
	session_start();
    if(!$_SESSION['cu'])
        echo "<script>window.location.href='logout.php';</script>";

    $sesuser=$_SESSION['cu'];

	include('extra/connect.php');
	$data=mysqli_fetch_array($con->query("select * from client where email='$sesuser'"));
    $clientid=$data['cid'];

    $sql="SELECT * from allowance where type='Fix' and client_id='$clientid' order by aid asc";
    $re=$con->query($sql);
?>

<div id="report">
	<table>
		<tr>
			<td>EMP Code *</td>
			<td>EMP Name</td>
			<td>Father's Name</td>
			<td>Relation</td>
			<td>DOB(DD-MM-YYYY)</td>
			<td>Gender</td>
			<td>Marital Status</td>
			<td>Mobile *</td>
			<td>Email ID</td>
			<td>Current Address</td>
			<td>Permanent Address</td>
			<td>Nationality</td>
			<td>Education</td>
			<td>Adhaar No.</td>
			<td>City Type</td>
			<td>Religion</td>
			<td>Image</td>
			<td>Pan Card</td>
			<td>Bank Name</td>
			<td>Account No.</td>
			<td>IFSC</td>
			<td>Bank Branch</td>
			<td>Payment Mode</td>
			<td>Designation</td>
			<td>DOJ(DD-MM-YYYY)</td>
			<td>Department</td>
			<td>Category</td>
			<td>Job/Branch Location</td>
			<td>State</td>
			<td>UNA No.</td>
			<td>PF No.</td>
			<td>ESI No.</td>
			<td>Repoting Manager</td>
			<td>Manager Id</td>
			<td>Official Email Id</td>
			<td>DOL</td>
			<td>Field 1</td>
			<td>Field 2</td>
			<td>Field 3</td>
			<td>Field 4</td>
			<td>Field 5</td>
			<td>EL</td>
			<td>SL</td>
			<td>CL</td>
			<td>HO</td>
			<td>PF</td>
			<td>EPS</td>
			<td>ESI</td>
			<td>LWF</td>
			<td>TDS</td>
			<td>PT</td>
			<td>OT</td>
			<td>Bonus</td>
			<td>Gratuty</td>
			<td>EMP. Login</td>
			<td>Attendance Marking</td>
			<td>Work Hour</td>
			<td>RF-ID Card No.</td>
			<td>Password *</td>
			<?
				$a=0;
				while($al=mysqli_fetch_array($re))
			    { $a++;?>
			    	<td><?echo $al['allowance'];?></td>
			    <?}
			?>
		</tr>

		<?
			for ($i=0; $i < 10; $i++) 
			{ ?>
				<tr>
					<?
						$col=$a+59;
						for ($j=0; $j < $col ; $j++) { 
							echo "<td></td>";
						}
					?>
				</tr>
			<?}
		?>
	</table>
</td>


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="js/table2excel.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $("#report").table2excel({
            filename: "Employee Add Smaple Fromate.xls"
        });
    });
</script>
</body>
</html>