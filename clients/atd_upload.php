

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
                <div class="headding">Attendance Upload With Excel</div>
            </div>
            <div class="col-sm-6 pad0 text-right">
                <a class="batt btn" onclick="sample()">Download Excel Sample</a>
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
                        <input type="text" name="year" id="year" class="form-control" value="<?echo date('Y');?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Month *</label>
                        <select name="month" class="form-control" required id="month">
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
                <div class="col-sm-3 form-group">
                    <div class="form-group">
                        <input type="submit" class="btn btn" name="upload" value="Upload">
                    </div>
                </div>
                <div class="col-sm-12" id="error"></div>
            </form>
            <?
                require 'Classes/PHPExcel/IOFactory.php'; $c=0;
                if (isset($_POST["upload"])) 
                {
                    extract($_POST);
                    $d=cal_days_in_month(CAL_GREGORIAN,$month,$year);
                    $ym=$year."-".$month;
                    
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

                        for ($row = 4; $row <= $highestRow; $row++) {
                            //  Read a row of data into an array
                            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
                            $empcode  = $rowData[0][1];
                            
                            if($empcode!="")
                            {
                                $em=mysqli_fetch_array($con->query("SELECT emp_id from employee where empcode='$empcode'"));
                                $empid=$em['0'];

                                $aa=1; $i=4;
                                while($aa<=$d)
                                {   
                                    if($aa<10)
                                        $dd=$year."-".$month."-".$aa;
                                    else
                                        $dd=$year."-".$month."-".$aa;
                                    
                                    $day=$rowData[0][$i];
                                    $s="SELECT * from attendance where atd_date='$dd' and emp_code='$empcode' and client_id='$clientid' and year='$year' and month='$month'";
                                    $at=mysqli_fetch_array($con->query($s));
                                    if(!$at && $day!="")
                                    {
                                        $s="insert into attendance values('','$dd','','','$day','','','$empid','$empcode','$clientid','$year','$month')";
                                    }
                                    else
                                        $s="UPDATE attendance set atd='$day' where atd_date='$dd' and emp_code='$empcode' and client_id='$clientid'";
                                    $sql = $con->query($s);

                                    $aa++; $i++;
                                }

                                // Over time
                                $aa=1; $i=$i+8;
                                while($aa<=$d)
                                {   
                                    if($aa<10)
                                        $dd=$year."-".$month."-".$aa;
                                    else
                                        $dd=$year."-".$month."-".$aa;
                                    
                                    $day=$rowData[0][$i];
                                    if($day!="")
                                    {
                                        $s="UPDATE attendance set oth='$day' where atd_date='$dd' and emp_code='$empcode' and client_id='$clientid'";
                                        $sql = $con->query($s);
                                    }                                        

                                    $aa++; $i++;
                                }

                                $c = $c + 1;
                            }
                            
                            if ($highestRow == $row && $empcode!="") {
                                break;
                                echo "<script>window.location.href='atd_upload?c=".$c."';</script>";
                            }
                        }
                    }?>
                    <div class="col-sm-12">
                        <?
                            if($sql) {
                                echo "<script>window.location.href='atd_upload?c=".$c."';</script>";
                            } else {
                                echo "<script>window.location.href='atd_upload?c=0';</script>";
                            }
                        ?>
                    </div>
                <?}
            ?>
        </div>
        <div class="clear"></div>
    </div>
</div>




<script type="text/javascript">
    function sample()
    {
        var y=document.getElementById('year').value;
        var m=document.getElementById('month').value;
        if(y!="" && m!="")
        {
            window.open("atd_sample.php?y="+y+"&m="+m);
        }
        else
        {
            document.getElementById('error').innerHTML="Not empty year & month filed !";
            error.style.color="red";
        }
    }
</script>



<?include('extra/footer.php');?>