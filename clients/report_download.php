<?
    use Dompdf\Dompdf;
    require_once ('dompdf/autoload.inc.php');

    $val=$_REQUEST['val'];
    $y=$_REQUEST['y'];
    $m=$_REQUEST['m'];
    $e=$_REQUEST['e'];
    $b=$_REQUEST['b'];

    $ym=$y."-".$m;

    session_start();
    if(!$_SESSION['cu'])
        echo "<script>window.location.href='logout.php';</script>";

    $sesuser=$_SESSION['cu'];

    include('extra/connect.php');
    $data=mysqli_fetch_array($con->query("select * from client where email='$sesuser'"));
    $clientid=$data['cid'];
    $data2=mysqli_fetch_array($con->query("select * from company where client_id='$clientid'"));

    $dompdf = new Dompdf();

    ob_start();
    if ($val == 'salary-slip') {
        $row=mysqli_fetch_array($con->query("SELECT * from employee where empcode='$e' and client_id='$clientid'"));
        $code=$row['empcode'];
        $row2=mysqli_fetch_array($con->query("SELECT * from salary where client_id='$clientid' and emp_code='$code' and year='$y' and month='$m'"));

        require_once ('report_temp/salary_slip.php');
        $dompdf->setPaper('A4','');
    }
    if ($val == 'Appointment') {
        $row=mysqli_fetch_array($con->query("SELECT * from employee where empcode='$e' and client_id='$clientid'"));
        $apl=mysqli_fetch_array($con->query("SELECT * from appointment_letter where client_id='$clientid'"));

        $code=$row['empcode'];
        require_once ('report_temp/appointment.php');
        $dompdf->setPaper('A4','');
    }
    
    $template = ob_get_clean();

    $dompdf->loadHtml($template);
    $dompdf->render();

    $dompdf->stream('pdf-'.time(),array("Attachment" => 0));   
?>