

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
                <div class="headding">Salary Upload With Excel</div>
            </div>
            <div class="col-sm-6 pad0 text-right">
                <a target="_blank" href="salary_excel?cl=<?echo $clientid;?>" class="batt btn">Download Excel Sample</a>
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
                        <label>Financial Year *</label>
                        <input type="text" name="year" id="year" class="form-control" value="<?echo date('Y');?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Month *</label>
                        <select name="month" class="form-control" required>
                            <option value="">--</option>
                            <option value="01">Jan</option>
                            <option value="02">Feb</option>
                            <option value="03">Mar</option>
                            <option value="04">Apr</option>
                            <option value="05">May</option>
                            <option value="06">Jun</option>
                            <option value="07">Jul</option>
                            <option value="08">Aug</option>
                            <option value="09">Sep</option>
                            <option value="10">Oct</option>
                            <option value="11">Nov</option>
                            <option value="12">Dec</option>
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
            </form>
            <?
                require 'Classes/PHPExcel/IOFactory.php'; $c=0;
                if (isset($_POST["upload"])) 
                {
                    extract($_POST);
                    $date=date('Y-m-d');
                    $sb=mysqli_num_rows($con->query("select * from salary_breakup where year='$year' and month='$month' and client_id='$clientid'"));

                    if($sb==0) 
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
                                $empcode  = $rowData[0][0];

                                if($empcode!="")
                                {
                                    $sql="SELECT * from allowance where type='Variable' order by aid asc";
                                    $re=$con->query($sql); $i=6;
                                    while($al=mysqli_fetch_array($re))
                                    {
                                        $alw=$al['allowance'];
                                        $sall=$rowData[0][$i];
                                        $s="insert into salary_breakup values('','$year','$month','$empcode','$alw','$sall','$clientid','$date')";
                                        $sql = $con->query($s);
                                        $i++;
                                    }
                                
                                    $sql="SELECT * from deduction where client_id='$clientid'";
                                    $re=$con->query($sql);
                                    while($dec=mysqli_fetch_array($re))
                                    {
                                        $dect=$dec['deduction'];
                                        $sall=$rowData[0][$i];
                                        $s="insert into salary_breakup values('','$year','$month','$empcode','$dect','$sall','$clientid','$date')";
                                        $sql = $con->query($s);
                                        $i++;
                                    }

                                    $c = $c + 1;
                                }
                                
                                if ($highestRow == $row && $empcode!="") {
                                    break;
                                    //echo "<script>window.location.href='salary_update?c=".$c."';</script>";
                                }
                            }
                        }?>
                        <!-- <div class="col-sm-12">
                            <?
                                if($sql) {
                                    echo "<script>window.location.href='salary_update?c=".$c."';</script>";
                                } else {
                                    echo "<script>window.location.href='salary_update?c=0';</script>";
                                }
                            ?>
                        </div> -->
                    <?}
                    else
                    {
                        echo "<div class='col-sm-12'><div class='msg'>Salary exit in this month</div></div>";
                    }
                }
            ?>
        </div>
        <div class="clear"></div>
    </div>
</div>





<?include('extra/footer.php');?>