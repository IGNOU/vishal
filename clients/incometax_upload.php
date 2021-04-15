

<?include('extra/top.php');?>

<?include('extra/sidemenu.php');?>

<style type="text/css">
    .msg{
        background: #DDD;
        font-weight: bold;
        padding: 10px;
        margin-bottom: 10px;
    }
</style>


<div class="main">
    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="col-sm-6 pad0">
                <div class="headding">Income Tax Upload With Excel</div>
            </div>
            <div class="col-sm-6 pad0 text-right">
                <a target="_blank" href="incometax_excel?cl=<?echo $clientid;?>" class="batt btn">Download Excel Fromate</a>
            </div>
            <div class="clear"></div>
        </div>
        <div class="col-sm-12 pad15">
            <?
                $c=$_REQUEST['c'];
                if($c!="")
                    echo "<div class='msg'>You database has imported successfully. You have inserted " . $c . " recoreds</div>";
                else
                    echo "";
            ?>
            <form role="form" method="post" class="form" enctype="multipart/form-data">  
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Year *</label>
                        <input class="form-control" name="year" id="year" required value="<?echo date('Y');?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Month *</label>
                        <select name="month" class="form-control" id="month" required>
                            <option value="">--</option>
                            <option value="01">Jan</option>
                            <option value="02">Feb</option>
                            <option value="03">Mar</option>
                            <option value="04">Apr</option>
                            <option value="05">May</option>
                            <option value="06">Jun</option>
                            <option value="07">Jul</option>
                            <option value="08">Agu</option>
                            <option value="09">Sep</option>
                            <option value="10">Oct</option>
                            <option value="11">Nov</option>
                            <option value="12">Dev</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="photo">Choose Excel Sheet</label>
                    <input type="file" name="file" class="form-control" required/>
                </div>
                <div class="col-sm-4 form-group">
                    <div class="form-group">
                        <input type="submit" class="btn btn" name="upload" value="Upload">
                    </div>
                </div>
                <div class="col-sm-12" id="msg"></div>
            </form>
            <?
                require 'Classes/PHPExcel/IOFactory.php'; $c=0;
                if (isset($_POST["upload"])) 
                {
                    extract($_POST);
                    
                    if(!empty($clientid)) 
                    {
                        $filename = $_FILES["file"]["tmp_name"];
                        if ($_FILES["file"]["size"] > 0) 
                        {
                            $inputfilename = $filename = $_FILES["file"]["tmp_name"];
                            $exceldata = array();
                            try {
                                $inputfiletype = PHPExcel_IOFactory::identify($inputfilename);
                                $objReader = PHPExcel_IOFactory::createReader($inputfiletype);
                                $objPHPExcel = $objReader->load($inputfilename);
                            } catch (Exception $e) {
                                die('Error loading file "' . pathinfo($inputfilename, PATHINFO_BASENAME) . '": ' . $e->getMessage());
                            }

                            $sheet = $objPHPExcel->getSheet(0);
                            $highestRow = $sheet->getHighestRow();

                            $highestColumn = $sheet->getHighestColumn();

                            for ($row = 2; $row <= $highestRow; $row++) {
                                //  Read a row of data into an array
                                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
                                $empcode            = $rowData[0][0];
                                $other              = $rowData[0][2];
                                $hra                = $rowData[0][3];
                                $std                = $rowData[0][4];
                                $reimbursment       = $rowData[0][5];
                                $prof_tax           = $rowData[0][6];
                                $deduction_80c      = $rowData[0][7];
                                $deduction_80ccd    = $rowData[0][8];
                                $deduction_80d      = $rowData[0][9];
                                $deduction_80d2     = $rowData[0][10];
                                $deduction_80g      = $rowData[0][11];
                                $deduction_80e      = $rowData[0][12];
                                $deduction_80tta    = $rowData[0][13];

                                if($empcode!="")
                                {
                                    $cie=mysqli_fetch_array($con->query("select * from com_incometax_emp where emp_code='$empcode' and client_id='$clientid'"));

                                    if(!$cie)
                                    {
                                        echo "<br>".$s="insert into com_incometax_emp values('','$empcode','$other','$hra','$std','$reimbursment','$prof_tax','$deduction_80c','$deduction_80ccd','$deduction_80d','$deduction_80d2','$deduction_80g','$deduction_80e','$deduction_80tta','$clientid','$year','$month')";
                                    }
                                    else
                                    {
                                        echo "<br>".$s="update com_incometax_emp set other='$other',hra='$hra',std='$std',reimbursment='$reimbursment',prof_tax='$prof_tax',deduction_80c='$deduction_80c',deduction_80ccd='$deduction_80ccd',deduction_80d2='$deduction_80d',deduction_80d2='$deduction_80d2',deduction_80g='$deduction_80g',deduction_80e='$deduction_80e',deduction_80tta='$deduction_80tta' where emp_code='$empcode' and year='$year'";
                                    }

                                    $sql=$con->query($s);                        
                                    $c = $c + 1;
                                }
                                
                                if ($highestRow == $row && $empcode!="") {
                                    break;
                                    echo "<script>window.location.href='incometax_upload?c=".$c."';</script>";
                                }
                            }
                        }?>
                        <div class="col-sm-12">
                            <?
                                if($sql) {
                                    echo "<script>window.location.href='incometax_upload?c=".$c."';</script>";
                                } else {
                                    echo "<script>window.location.href='incometax_upload?c=0';</script>";
                                }
                            ?>
                        </div>
                    <?}
                    else
                    {
                        echo "<div class='col-sm-12'><div class='msg'>Client Not Active. Please login again </div></div>";
                    }
                }
            ?>
        </div>
        <div class="clear"></div>
    </div>
</div>






<?include('extra/footer.php');?>