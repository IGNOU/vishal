
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
            <div class="col-sm-6 pad0"><div class="headding">Employee List Upload To Excel</div></div>
            <div class="col-sm-6 pad0 text-right">
                <a href="emp_sample" target="_blank" class="batt btn">Download Sample</a>
            </div>
        </div>
        <div class="col-sm-12 pad15">
            <div class="col-sm-12">
                <?
                    $c=$_REQUEST['c'];
                    if($c!="")
                        echo "<div class='msg'>You database has imported successfully. You have inserted " . $c . " recoreds</div>";
                    else
                        echo "";
                ?>
            </div>
            <form role="form" action="#" method="post" class="form" enctype="multipart/form-data">				
                <div class="col-md-6 pad0">
                    <div class="col-sm-12 form-group">
                        <label for="photo">Choose Excel Sheet</label>
                        <input type="file" name="file" class="form-control" required/>
                    </div>
                    <div class="col-sm-12 form-group">
                        <label for="name"></label>
                        <input type="submit" class="btn btn-primary" name="upload" value="Upload">
                    </div>
                </div>
                <div class="col-md-6 pad0" style="overflow: auto;">
                    Sample 
                    <img src="img/sample.jpg">
                </div>
                
			</form>
			<?
				require 'Classes/PHPExcel/IOFactory.php'; $c=0;
                if (isset($_POST["upload"])) 
                {
                    $sql="SELECT * from allowance where type='Fix' and client_id='$clientid' order by aid asc";
                    $re=$con->query($sql);
                    while($al=mysqli_fetch_array($re))
                    {
                        $break[]=$al['allowance'];
                    }

                    if (!empty($clientid)) 
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

                                $empcode    = $rowData[0][0];
                                $name       = $rowData[0][1];
                                $fname      = $rowData[0][2];
                                $relation   = $rowData[0][3];
                                $dob        = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($rowData[0][4]));
                                $gender     = $rowData[0][5];
                                $marital    = $rowData[0][6];
                                $mobile     = $rowData[0][7];
                                $email      = $rowData[0][8];
                                $caddress   = $rowData[0][9];
                                $paddress   = $rowData[0][10];
                                $nationality= $rowData[0][11];
                                $education  = $rowData[0][12];
                                $adhaar     = $rowData[0][13];
                                $city_type  = $rowData[0][14];
                                $religion   = $rowData[0][15];
                                $img        = $rowData[0][16];
                                $pan        = $rowData[0][17];
                                $bank       = $rowData[0][18];
                                $account    = $rowData[0][19];
                                $ifsc       = $rowData[0][20];
                                $branch     = $rowData[0][21];
                                $mode       = $rowData[0][22];
                                $designation= $rowData[0][23];
                                $doj        = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($rowData[0][24]));
                                $department = $rowData[0][25];
                                $category   = $rowData[0][26];
                                $location   = $rowData[0][27];
                                $state      = $rowData[0][28];
                                $uan        = $rowData[0][29];
                                $pf_code    = $rowData[0][30];
                                $esi_code   = $rowData[0][31];
                                $rep_manager= $rowData[0][32];
                                $rmid       = $rowData[0][33];
                                $official_email= $rowData[0][34];
                                $dol        = $rowData[0][35];
                                $field1     = $rowData[0][36];
                                $field2     = $rowData[0][37];
                                $field3     = $rowData[0][38];
                                $field4     = $rowData[0][39];
                                $field5     = $rowData[0][40];
                                $el         = $rowData[0][41];
                                $sl         = $rowData[0][42];
                                $cl         = $rowData[0][43];
                                $ho         = $rowData[0][44];
                                $pf         = $rowData[0][45];
                                $pension    = $rowData[0][46];
                                $esi        = $rowData[0][47];
                                $lwf        = $rowData[0][48];
                                $tds        = $rowData[0][49];
                                $pt         = $rowData[0][50];
                                $ot         = $rowData[0][51];
                                $bonus      = $rowData[0][52];
                                $gratuty    = $rowData[0][53];
                                $login      = $rowData[0][54];
                                $atd        = $rowData[0][55];
                                $work_hour  = $rowData[0][56];
                                $card       = $rowData[0][57];
                                $password   = $rowData[0][58];

                                $data3=mysqli_fetch_array($con->query("select * from employee where empcode='$empcode' and client_id='$clientid'"));

                                
                                if($empcode!="" && $data3=="")
                                {
                                    echo "<br>".$s="insert into employee values('','$empcode','$name','$fname','$relation','$dob','$gender','$marital','$mobile','$email','$caddress','$paddress','$nationality','$education','$adhaar','$city_type','$religion','$img','$pan','$bank','$account','$ifsc','$branch','$mode','$designation','$doj','$department','$category','$location','$state','$uan','$pf_code','$esi_code','$rep_manager','$rmid','$official_email','$dol','$field1','$field2','$field3','$field4','$field5','$el','$sl','$cl','$ho','$pf','$pension','$esi','$lwf','$tds','$pt','$ot','$bonus','$gratuty','$login','$atd','$work_hour','$card','','$clientid','$password')";
                                    $sql = $con->query($s);

                                    if($sql){
                                        $i=59;
                                        foreach($break as $value)
                                        {
                                            $salary = $rowData[0][$i];
                                            $qry="insert into employee_breakup values('','$value','$salary','$empcode','$clientid')";
                                            $con->query($qry);

                                            $i++;
                                        }
                                        $c = $c + 1;
                                    }
                                }
                                

                                
                                if ($highestRow == $row && $empcode!="") {
                                    break;
                                    echo "<script>window.location.href='employee_upload?c=".$c."';</script>";
                                }
                            }
                        }
                    } ?>
                    <div class="col-sm-12">
                        <?
                            if($sql) {
                                echo "<script>window.location.href='employee_upload?c=".$c."';</script>";
                            } else {
                                echo "Sorry! There is some problem.";
                            }
                        ?>
                    </div>
                <?}
            ?>
       	</div>
       	<div class="clear"></div>
    </div><br>

</div>







<?include('extra/footer.php');?>
