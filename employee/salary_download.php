<?
    use Dompdf\Dompdf;
    require_once ('../clients/dompdf/autoload.inc.php');

    session_start();
    if(!$_SESSION['emp'])
        echo "<script>window.location.href='logout.php';</script>";

    $sesuser=$_SESSION['emp'];

    include('extra/connect.php');
    $data=mysqli_fetch_array($con->query("select * from employee where mobile='$sesuser'"));
    $clientid=$data['client_id'];
    $data2=mysqli_fetch_array($con->query("select * from company where client_id='$clientid'"));
    
    $id=base64_decode($_REQUEST['id']);

    // $row=mysqli_fetch_array($con->query("SELECT * from employee where mobile='$sesuser'"));
    $row2=mysqli_fetch_array($con->query("SELECT * from salary where slid='$id'"));
    $y=$row2['year'];
    $m=$row2['month'];
    $ym=$row2['year']."-".$row2['month'];

    $dompdf = new Dompdf();

    ob_start();
    require_once ('temp/salary_slip.php');
    $dompdf->setPaper('A4','');
    
    $template = ob_get_clean();


    $dompdf->loadHtml($template);
    $dompdf->render();

    $dompdf->stream('pdf-'.time(),array("Attachment" => 0));
        
?>