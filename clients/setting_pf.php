<?include('extra/top.php');?>

<?include('extra/sidemenu.php');?>

<div class="main">
    <?
        $sql="SELECT * FROM com_pf where client_id='$clientid'";
        $res=$con->query($sql);
        $row=mysqli_fetch_array($res);
        $id=$row['pfid'];
        if(!$row)
        {?>
            <div class="page_details">
                <div class="col-sm-12 pad15_line">
                    <div class="col-sm-6 pad0">
                        <div class="headding">PF Setting</div>
                    </div>  
                    <div class="col-sm-6 text-right">
                        <a href="create_company" class="batt btn">Back</a>
                    </div>
                </div>
                <div class="col-sm-12 pad15">
                    <form class="form" role="form" method="post">
                        <table class="table table-bordered" id="pfnew">
                            <tr>
                                <th>Select Allowance</th>
                                <th>PF Limit</th>
                                <th>Pension Limit</th>
                                <th>EE PF</th>
                                <th>ER PF</th>
                                <th>ER EPS</th>
                                <th>Admin</th>
                                <th>EDLI AC/21</th>
                                <th>EDLI AC/22</th>
                            </tr>
                            <tr>
                                <td width="200">
                                    <select name="allowance[]" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" multiple>
                                        <?
                                            $sql="select * from allowance where client_id='$clientid' order by allowance asc";
                                            $res=$con->query($sql);
                                            while($al=mysqli_fetch_array($res))
                                                echo "<option>".$al['allowance']."</option>";
                                        ?>
                                    </select>
                                </td>
                                <td><input type="text" name="pf_limit" class="form-control"></td>
                                <td><input type="text" name="pension_limit" class="form-control"></td>
                                <td><input type="text" name="ee_pf" class="form-control"></td>
                                <td><input type="text" name="er_pf" class="form-control"></td>
                                <td><input type="text" name="er_eps" class="form-control"></td>
                                <td><input type="text" name="admin" class="form-control"></td>
                                <td><input type="text" name="edli21" class="form-control"></td>
                                <td><input type="text" name="edli22" class="form-control"></td>
                            </tr>
                        </table>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="submit" name="pf_submit" class="btn btn-primary" value="Submit">
                            </div>
                        </div>
                    </form>
                    <?
                        if(isset($_POST['pf_submit']))
                        {
                            extract($_POST);

                            $sql="insert into com_pf values ('','$pf_limit','$pension_limit','$ee_pf','$er_pf','$er_eps','$admin','$edli21','$edli22','$clientid')";
                            $con->query($sql);

                            $sql="select max(pfid) from com_pf where client_id='$clientid'";
                            $row=mysqli_fetch_array($con->query($sql));
                            $pf=$row['0'];

                            foreach($allowance as $key)
                            {
                                $sql="insert into com_pf_allowance values ('','$pf','$key','$clientid')";
                                $con->query($sql);
                            }

                           echo "<script>window.location.href='setting_pf';</script>";
                        }
                    ?>
                </div>
                <div class="clear"></div>
            </div><br>
        <?}
        else
        {?>
            <div class="page_details">
                <div class="col-sm-12 pad15_line">
                    <div class="col-sm-6 pad0">
                        <div class="headding">PF Setting</div>
                    </div>  
                    <div class="col-sm-6 text-right">
                        <a href="create_company" class="batt btn">Back</a>
                    </div>
                </div>
                <div class="col-sm-12 pad15">
                    <form class="form" role="form" method="post">
                        <table class="table table-bordered" id="pfnew">
                            <tr>
                                <th>Select Allowance</th>
                                <th>PF Limit</th>
                                <th>Pension Limit</th>
                                <th>EE PF</th>
                                <th>ER PF</th>
                                <th>ER EPS</th>
                                <th>Admin</th>
                                <th>EDLI AC/21</th>
                                <th>EDLI AC/22</th>
                            </tr>
                            <tr>
                                <td width="200">
                                    <select name="allowance[]" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" multiple>
                                        <?
                                            $sql="select * from allowance where client_id='$clientid' order by allowance asc";
                                            $res=$con->query($sql);
                                            while($al=mysqli_fetch_array($res))
                                            {
                                                $alw=$al['allowance'];
                                                $s="select * from com_pf_allowance where pf_allowance='$alw' and client_id='$clientid'";
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
                                <td><input type="text" name="pf_limit" class="form-control" value="<?echo $row['pf_limit'];?>"></td>
                                <td><input type="text" name="pension_limit" class="form-control" value="<?echo $row['person_limit'];?>"></td>
                                <td><input type="text" name="ee_pf" class="form-control" value="<?echo $row['ee_pf'];?>"></td>
                                <td><input type="text" name="er_pf" class="form-control" value="<?echo $row['er_pf'];?>"></td>
                                <td><input type="text" name="er_eps" class="form-control" value="<?echo $row['er_eps'];?>"></td>
                                <td><input type="text" name="admin" class="form-control" value="<?echo $row['admin'];?>"></td>
                                <td><input type="text" name="edli21" class="form-control" value="<?echo $row['edli21'];?>"></td>
                                <td><input type="text" name="edli22" class="form-control" value="<?echo $row['edli22'];?>"></td>
                            </tr>
                        </table>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="submit" name="pf_submit" class="btn btn-primary" value="Update">
                                <a href="#" onclick='JSconfirm(<?php echo $id;?>)' class="batt btn pull-right"><i class="fa fa-trash" style="color: #FFF;"></i> Remove PF</a>
                            </div>
                        </div>
                    </form>
                    <?
                        if(isset($_POST['pf_submit']))
                        {
                            extract($_POST);

                            $sql="update com_pf set pf_limit='$pf_limit',person_limit='$pension_limit',ee_pf='$ee_pf',er_pf='$er_pf',er_eps='$er_eps',admin='$admin',edli21='$edli21',edli22='$edli22' where pfid='$id'";
                            $con->query($sql);

                            $sql="delete from com_pf_allowance where pf_id='$id'";
                            $con->query($sql);

                            foreach($allowance as $key)
                            {
                                $sql="insert into com_pf_allowance values ('','$id','$key','$clientid')";
                                $con->query($sql);
                            }

                           echo "<script>window.location.href='setting_pf';</script>";
                        }
                    ?>
                </div>
                <div class="clear"></div>
            </div><br>
        <?}
    ?>
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
        window.location = "delete.php?id="+delid+"&&tname=com_pf";   
    } 
    else {     
        swal("Record Not Deleted.");   
        } });
}
</script>


<?include('extra/footer.php');?>