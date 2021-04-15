
<?
    include('extra/connect.php');
    $id=$_REQUEST['find'];
    $sql="select * from employee where emp_id='$id'";
    $res=$con->query($sql);
    $row=mysqli_fetch_array($res);
    echo $row['empcode'];
?>