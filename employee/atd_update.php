<?
	include('extra/connect.php');

	$input = filter_input_array(INPUT_POST);
	if ($input['action'] == 'edit') 
	{
		if(isset($input['intime'])) {
			$intime=mysqli_real_escape_string($con,$input['intime']);
			$sql_query = "UPDATE attendance SET intime='$intime' WHERE atdid='" . $input['id'] . "'";
			$con->query($sql_query);
		}
		if(isset($input['outtime'])) {
			$intime=mysqli_real_escape_string($con,$input['outtime']);
			echo $sql_query = "UPDATE attendance SET outtime='$intime' WHERE atdid='" . $input['id'] . "'";
			$con->query($sql_query);
		}
		if(isset($input['atd'])) {
			$intime=mysqli_real_escape_string($con,$input['atd']);
			$sql_query = "UPDATE attendance SET atd='$intime' WHERE atdid='" . $input['id'] . "'";
			$con->query($sql_query);
		}
		if(isset($input['oth'])) {
			$intime=mysqli_real_escape_string($con,$input['oth']);
			$sql_query = "UPDATE attendance SET oth='$intime' WHERE atdid='" . $input['id'] . "'";
			$con->query($sql_query);
		}
	}
?>