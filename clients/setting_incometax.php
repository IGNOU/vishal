<?include('extra/top.php');?>

<?include('extra/sidemenu.php');?>



<div class="main">
    <div class="page_details">
        <?
            $sql="SELECT * from com_incometax where client_id='$clientid'";
            $res=$con->query($sql);
            $row=mysqli_fetch_array($res);
            if(!$row)
            {
                $hra="";$std="";$reimbursment="";$prof_tax="";$deduction_80c="";$deduction_80ccd="";$deduction_80d="";
                $deduction_80d2="";$deduction_80g="";$deduction_80e="";$deduction_80tta="";

                $ss1=""; $ssto1=""; $slm1=""; $slf1=""; 
                $ss2=""; $ssto2=""; $slm2=""; $slf2=""; 
                $ss3=""; $ssto3=""; $slm3=""; $slf3=""; 
                $ss4=""; $ssto4=""; $slm4=""; $slf4="";
                $slm_metro="";$slf_metro="";$slm_nonmetro="";$slf_nonmetro="";
                $rebeat=""; $slm_rebeat="";$slf_rebeat="";
                $tax_sur1=""; $slm_tax1=""; $slf_tax1="";
                $tax_sur2=""; $slm_tax2=""; $slf_tax2="";
                $tax_sur3=""; $slm_tax3=""; $slf_tax3="";
                $tax_sur4=""; $slm_tax4=""; $slf_tax4="";
                $slm_edu="";$slf_edu="";
                $slm_rent="";$slf_rent="";
            }
            else
            {
                $id=$row['client_id'];
                $hra=$row['hra'];$std=$row['std'];$reimbursment=$row['reimbursment'];$prof_tax=$row['prof_tax'];
                $deduction_80c=$row['deduction_80c'];$deduction_80ccd=$row['deduction_80ccd'];$deduction_80d=$row['deduction_80d']; $deduction_80d2=$row['deduction_80d2'];$deduction_80g=$row['deduction_80g'];$deduction_80e=$row['deduction_80e']; $deduction_80tta=$row['deduction_80tta'];

                $ss1=$row['ss1']; $ssto1=$row['ssto1']; $slm1=$row['slm1']; $slf1=$row['slf1']; 
                $ss2=$row['ss2']; $ssto2=$row['ssto2']; $slm2=$row['slm2']; $slf2=$row['slf2']; 
                $ss3=$row['ss3']; $ssto3=$row['ssto3']; $slm3=$row['slm3']; $slf3=$row['slf3']; 
                $ss4=$row['ss4']; $ssto4=$row['ssto4']; $slm4=$row['slm4']; $slf4=$row['slf4']; 

                $slm_metro=$row['slm_metro'];$slf_metro=$row['slf_metro'];$slm_nonmetro=$row['slm_nonmetro'];
                $slf_nonmetro=$row['slf_nonmetro'];
                
                $rebeat=$row['rebeat']; $slm_rebeat=$row['slm_rebeat']; $slf_rebeat=$row['slf_rebeat'];
                $tax_sur1=$row['tax_sur1']; $slm_tax1=$row['slm_tax1']; $slf_tax1=$row['slf_tax1'];
                $tax_sur2=$row['tax_sur2']; $slm_tax2=$row['slm_tax2']; $slf_tax2=$row['slf_tax2'];
                $tax_sur3=$row['tax_sur3']; $slm_tax3=$row['slm_tax3']; $slf_tax3=$row['slf_tax3'];
                $tax_sur4=$row['tax_sur4']; $slm_tax4=$row['slm_tax4']; $slf_tax4=$row['slf_tax4'];

                $slm_edu=$row['slm_edu'];$slf_edu=$row['slf_edu'];
                $slm_rent=$row['slm_rent'];$slf_rent=$row['slf_rent'];

            }
        ?>
        <div class="col-sm-12 pad15_line">
            <div class="col-sm-6 pad0">
                <div class="headding">Income Tax Setting</div>
            </div>  
            <div class="col-sm-6 text-right pad0">
                <a href="incometax_upload?c=" class="batt btn">Upload Excel</a>
                <a href="create_company" class="batt btn">Back</a>
            </div>
        </div>
        <form class="form" role="form" method="post">
            <div class="col-sm-12">
                
            </div>
            <div class="col-sm-5 pad15">
                <table class="table table-bordered">
                    <tr>
                        <th>Deduction</th>
                        <th>Limit</th>
                    </tr>
            		<tr>
            			<td>HRA Exemptions limit</td>
            			<td><input type="text" name="hra" class="form-control" readonly value="<?echo $hra;?>"></td>
            		</tr>
            		<tr>
            			<td>Standard deduction</td>
            			<td><input type="text" name="std" class="form-control" value="<?echo $std;?>"></td>
            		</tr>
            		<tr>
            			<td>Reimbursment</td>
            			<td><input type="text" name="reimbursment" class="form-control" value="<?echo $reimbursment;?>"></td>
            		</tr>
            		<tr>
            			<td>Professional Tax</td>
            			<td><input type="text" name="prof_tax" class="form-control" value="<?echo $prof_tax;?>"></td>
            		</tr>
            		<tr>
            			<td>Deductions u/s 80 C</td>
            			<td><input type="text" name="deduction_80c" class="form-control" value="<?echo $deduction_80c;?>"></td>
            		</tr>
            		<tr>
            			<td>Deductions u/s 80 CCD</td>
            			<td><input type="text" name="deduction_80ccd" class="form-control" value="<?echo $deduction_80ccd;?>"></td>
            		</tr>
            		<tr>
            			<td>Deductions u/s 80 D (Inc. Spouse & Children)</td>
            			<td><input type="text" name="deduction_80d" class="form-control" value="<?echo $deduction_80d;?>"></td>
            		</tr>
            		<tr>
            			<td>Deductions u/s 80 D (For Parents)</td>
            			<td><input type="text" name="deduction_80d2" class="form-control" value="<?echo $deduction_80d;?>"></td>
            		</tr>
                    <tr>
                        <td>Deductions u/s 80 G</td>
                        <td><input type="text" name="deduction_80g" class="form-control" value="<?echo $deduction_80g;?>"></td>
                    </tr>
            		<tr>
            			<td>Deductions u/s 80 E</td>
            			<td><input type="text" name="deduction_80e" class="form-control" value="<?echo $deduction_80e;?>"></td>
            		</tr>
            		<tr>
            			<td>Deductions u/s 80 TTA</td>
            			<td><input type="text" name="deduction_80tta" class="form-control"  value="<?echo $deduction_80tta;?>"></td>
            		</tr>
            	</table>                   
            </div>
            <div class="col-sm-7 pad15" style="overflow: auto;">
	            <table class="table table-bordered">
                    <tr>
                        <th colspan="2">Salary Slab</th>
                        <th>Male</th>
                        <th>Female</th>
                    </tr>
                    <tr>
                        <td width="200"><input type="text" name="ss1" class="form-control" value="<?echo $ss1;?>"></td>
                        <td width="200"><input type="text" name="ssto1" class="form-control" value="<?echo $ssto1;?>"></td>
                        <td><input type="text" name="slm1" class="form-control" value="<?echo $slm1;?>"></td>
                        <td><input type="text" name="slf1" class="form-control" value="<?echo $slf1;?>"></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="ss2" class="form-control" value="<?echo $ss2;?>"></td>
                        <td><input type="text" name="ssto2" class="form-control" value="<?echo $ssto2;?>"></td>
                        <td><input type="text" name="slm2" class="form-control" value="<?echo $slm2;?>"></td>
                        <td><input type="text" name="slf2" class="form-control" value="<?echo $slf2;?>"></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="ss3" class="form-control" value="<?echo $ss3;?>"></td>
                        <td><input type="text" name="ssto3" class="form-control" value="<?echo $ssto3;?>"></td>
                        <td><input type="text" name="slm3" class="form-control" value="<?echo $slm3;?>"></td>
                        <td><input type="text" name="slf3" class="form-control" value="<?echo $slf3;?>"></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="ss4" class="form-control" value="<?echo $ss4;?>"></td>
                        <td><input type="text" name="ssto4" class="form-control" value="<?echo $ssto4;?>"></td>
                        <td><input type="text" name="slm4" class="form-control" value="<?echo $slm4;?>"></td>
                        <td><input type="text" name="slf4" class="form-control" value="<?echo $slf4;?>"></td>
                    </tr>
                    <tr>
                        <td colspan="2">Metro</td>
                        <td><input type="text" name="slm_metro" class="form-control" value="<?echo $slm_metro;?>"></td>
                        <td><input type="text" name="slf_metro" class="form-control" value="<?echo $slf_metro;?>"></td>
                    </tr>
                    <tr>
                        <td colspan="2">Non-metro</td>
                        <td><input type="text" name="slm_nonmetro" class="form-control" value="<?echo $slm_nonmetro;?>"></td>
                        <td><input type="text" name="slf_nonmetro" class="form-control" value="<?echo $slf_nonmetro;?>"></td>
                    </tr>
                    <tr>
                        <td>Rebeat u/s 87 A</td>
                        <td><input type="text" name="rebeat" class="form-control"></td>
                        <td><input type="text" name="slm_rebeat" class="form-control" value="<?echo $slm_rebeat;?>"></td>
                        <td><input type="text" name="slf_rebeat" class="form-control" value="<?echo $slf_rebeat;?>"></td>
                    </tr>
                    <tr>
                        <td rowspan="4">Tax Surcharge @ 10%/15%/25%/37% <br>(Income more than 50 Lakhs/1 cr/2 cr/5 cr respectively) (Budget 2019)</td>
                        <td><input type="text" name="tax_sur1" class="form-control" value="<?echo $tax_sur1;?>"></td>
                        <td><input type="text" name="slm_tax1" class="form-control" value="<?echo $slm_tax1;?>"></td>
                        <td><input type="text" name="slf_tax1" class="form-control" value="<?echo $slf_tax1;?>"></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="tax_sur2" class="form-control" value="<?echo $tax_sur2;?>"></td>
                        <td><input type="text" name="slm_tax2" class="form-control" value="<?echo $slm_tax2;?>"></td>
                        <td><input type="text" name="slf_tax2" class="form-control" value="<?echo $slf_tax2;?>"></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="tax_sur3" class="form-control" value="<?echo $tax_sur3;?>"></td>
                        <td><input type="text" name="slm_tax3" class="form-control" value="<?echo $slm_tax3;?>"></td>
                        <td><input type="text" name="slf_tax3" class="form-control" value="<?echo $slf_tax3;?>"></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="tax_sur4" class="form-control" value="<?echo $tax_sur4;?>"></td>
                        <td><input type="text" name="slm_tax4" class="form-control" value="<?echo $slm_tax4;?>"></td>
                        <td><input type="text" name="slf_tax4" class="form-control" value="<?echo $slf_tax4;?>"></td>
                    </tr>
                    <tr>
                        <td colspan="2">Education Cess</td>
                        <td><input type="text" name="slm_edu" class="form-control" value="<?echo $slm_edu;?>"></td>
                        <td><input type="text" name="slf_edu" class="form-control" value="<?echo $slf_edu;?>"></td>
                    </tr>
                    <tr>
                        <td colspan="2">Rent paid in excess of basic salary</td>
                        <td><input type="text" name="slm_rent" class="form-control" value="<?echo $slm_rent;?>"></td>
                        <td><input type="text" name="slf_rent" class="form-control" value="<?echo $slf_rent;?>"></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <select name="allowance[]" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" multiple="true">
                                <?
                                    $sql="select * from allowance where client_id='$clientid' order by allowance asc";
                                    $res=$con->query($sql);
                                    while($al=mysqli_fetch_array($res))
                                    {
                                        $alw=$al['allowance'];
                                        $s="select * from com_incometax_allowance where alw='$alw' and client_id='$clientid'";
                                        $alt=mysqli_fetch_array($con->query($s));
                                        if(!$alt)
                                        {?>
                                            <option><?echo $alw;?></option>
                                        <?}
                                        else
                                        {?>
                                            <option selected><?echo $alw;?></option>
                                        <?}
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
	            </table>
            </div>
            <div class="col-sm-12 form-group">
                <?
                    if(!$row)
                    {?>
                        <input type="submit" name="submit" value="Submit" class="batt btn">
                    <?}
                    else
                    {?>
                        <input type="submit" name="update" value="Update" class="batt btn">
                        <!-- <a href="#" onclick='JSconfirm(<?php echo $id;?>)' class="batt btn pull-right"><i class="fa fa-trash" style="color: #FFF;"></i> Remove TDS</a> -->
                    <?}
                ?>
            </div>
        </form>
        <?
            if(isset($_POST['submit']))
            {
                extract($_POST);
                $sql="insert into com_incometax values('','$hra','$std','$reimbursment','$prof_tax','$deduction_80c','$deduction_80ccd','$deduction_80d','$deduction_80d2','$deduction_80g','$deduction_80e','$deduction_80tta','$ss1','$ssto1','$slm1','$slf1','$ss2','$ssto2','$slm2','$slf2','$ss3','$ssto3','$slm3','$slf3','$ss4','$ssto4','$slm4','$slf4','$slm_metro','$slf_metro','$slm_nonmetro','$slf_nonmetro','$rebeat','$slm_rebeat','$slf_rebeat','$tax_sur1','$slm_tax1','$slf_tax1','$tax_sur2','$slm_tax2','$slf_tax2','$tax_sur3','$slm_tax3','$slf_tax3','$tax_sur4','$slm_tax4','$slf_tax4','$slm_edu','$slf_edu','$slm_rent','$slf_rent','$clientid')";

                //$sql="create table com_incometax (hra decimal(20,2), std decimal(20,2), reimbursment decimal(20,2), prof_tax decimal(20,2), deduction_80c decimal(20,2), deduction_80ccd decimal(20,2), deduction_80d decimal(20,2), deduction_80d2 decimal(20,2), deduction_80g decimal(20,2), deduction_80e decimal(20,2), deduction_80tta decimal(20,2), ss1 decimal(20,2), ssto1 decimal(20,2), slm1 decimal(20,2), slf1 decimal(20,2), ss2 decimal(20,2), ssto2 decimal(20,2), slm2 decimal(20,2), slf2 decimal(20,2), ss3 decimal(20,2), ssto3 decimal(20,2), slm3 decimal(20,2), slf3 decimal(20,2), ss4 decimal(20,2), ssto4 decimal(20,2), slm4 decimal(20,2), slf4 decimal(20,2), slm_metro decimal(20,2), slf_metro decimal(20,2), slm_nonmetro decimal(20,2), slf_nonmetro decimal(20,2), rebeat decimal(20,2), slm_rebeat decimal(20,2), slf_rebeat decimal(20,2), tax_sur1 decimal(20,2), slm_tax1 decimal(20,2), slf_tax1 decimal(20,2), tax_sur2 decimal(20,2), slm_tax2 decimal(20,2), slf_tax2 decimal(20,2), tax_sur3 decimal(20,2), slm_tax3 decimal(20,2), slf_tax3 decimal(20,2), tax_sur4 decimal(20,2), slm_tax4 decimal(20,2), slf_tax4 decimal(20,2), slm_edu decimal(20,2), slf_edu decimal(20,2), slm_rent decimal(20,2), slf_rent decimal(20,2))";


                $con->query($sql);

                $sql="select max(itid) from com_incometax where client_id='$clientid'";
                $row=mysqli_fetch_array($con->query($sql));
                $it=$row['0'];

                foreach($allowance as $key)
                {
                    $sql="insert into com_incometax_allowance values ('','$it','$key','$clientid')";
                    $con->query($sql);
                }

                echo "<script>window.location.href='setting_incometax';</script>";
            }

            if(isset($_POST['update']))
            {
                extract($_POST);
                $sql="update com_incometax set hra='$hra',std='$std',reimbursment='$reimbursment',prof_tax='$prof_tax',deduction_80c='$deduction_80c',deduction_80ccd='$deduction_80ccd',deduction_80d='$deduction_80d',deduction_80d2='$deduction_80d2',deduction_80g='$deduction_80g',deduction_80e='$deduction_80e',deduction_80tta='$deduction_80tta',ss1='$ss1',ssto1='$ssto1',slm1='$slm1',slf1='$slf1',ss2='$ss2',ssto2='$ssto2',slm2='$slm2',slf2='$slf2',ss3='$ss3',ssto3='$ssto3',slm1='$slm3',slf1='$slf3',ss4='$ss4',ssto4='$ssto4',slm4='$slm4',slf4='$slf4',slm_metro='$slm_metro',slf_metro='$slf_metro',slm_nonmetro='$slm_nonmetro',slf_nonmetro='$slf_nonmetro',slm_rebeat='$slm_rebeat',slf_rebeat='$slf_rebeat',slm_tax='$slm_tax',slf_tax='$slf_tax',slm_edu='$slm_edu',slf_edu='$slf_edu' where ci_id='$id'";
                $con->query($sql);

                echo "<script>window.location.href='setting_incometax';</script>";
            }
        ?>

        <div class="clear"></div>
    </div>
</div>











<script type="text/javascript">
function JSconfirm(delid){
    swal({ 
    title: "Do you want to delete it ?",   
    // text: "Redirect me to home page?",   
    type: "warning",   
    showCancelButton: true,   
    confirmButtonColor: "#DD6B55",   
    confirmButtonText: "Yes",   
    cancelButtonText: "No",   
    closeOnConfirm: false,   
    closeOnCancel: false }, 
    
    function(isConfirm){   
    if (isConfirm) 
    {   
        window.location = "delete.php?id="+delid+"&&tname=com_incometax";   
    } 
    else {     
        swal("Record Not Deleted.");   
        } });
}
</script>


<?include('extra/footer.php');?>