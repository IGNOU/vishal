<?include('extra/top.php');?>

<?include('extra/sidemenu.php');?>

<div class="main">
    <?
        $sql="SELECT * FROM com_gratuty where client_id='$clientid'";
        $res=$con->query($sql);
        $row=mysqli_fetch_array($res);
        $id=$row['gid'];
        if(!$row)
        {?>
            <div class="page_details">
                <div class="col-sm-12 pad15_line">
                    <div class="col-sm-6 pad0">
                        <div class="headding">Gratuity Setting</div>
                    </div>  
                    <div class="col-sm-6 text-right pad0">
                        <a href="create_company" class="batt btn">Back</a>
                    </div>
                </div>
                <div class="col-sm-12 pad15">
                    <form class="form" role="form" method="post">
                        <table class="table table-bordered">
                            <tr>
                                <th>Allowance</th>
                                <th>Multiple</th>
                                <th>Divided</th>
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
                                <td><input type="text" name="gr_multi" class="form-control"></td>
                                <td><input type="text" name="gr_devi" class="form-control"></td>
                            </tr>
                        </table>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                            </div>
                        </div>
                    </form>
                    <?
                        if(isset($_POST['submit']))
                        {
                            extract($_POST);
                            $sql="insert into com_gratuty values ('','$gr_multi','$gr_devi','$clientid')";
                            $con->query($sql);

                            $sql="select max(gid) from com_gratuty where client_id='$clientid'";
                            $row=mysqli_fetch_array($con->query($sql));
                            $g=$row['0'];

                            foreach($allowance as $key)
                            {
                                $sql="insert into com_gratuty_allowance values ('','$g','$key','$clientid')";
                                $con->query($sql);
                            }
                            echo "<script>window.location.href='setting_gratuti';</script>";
                        }
                    ?>
                </div>
                <div class="clear"></div>
            </div>
        <?}
        else
        {?>
            <div class="page_details">
                <div class="col-sm-12 pad15_line">
                    <div class="col-sm-6 pad0">
                        <div class="headding">Gratuity Setting</div>
                    </div>  
                    <div class="col-sm-6 text-right pad0">
                        <a href="create_company" class="batt btn">Back</a>
                    </div>
                </div>
                <div class="col-sm-12 pad15">
                    <form class="form" role="form" method="post">
                        <table class="table table-bordered">
                            <tr>
                                <th>Allowance</th>
                                <th>Multiple</th>
                                <th>Divided</th>
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
                                                $s="select * from com_gratuty_allowance where g_allowance='$alw' and client_id='$clientid'";
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
                                <td><input type="text" name="gr_multi" class="form-control" value="<?echo $row['multiple'];?>"></td>
                                <td><input type="text" name="gr_devi" class="form-control" value="<?echo $row['devided'];?>"></td>
                            </tr>
                        </table>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="submit" name="update" class="btn btn-primary" value="Update">
                                <a href="#" onclick='JSconfirm(<?php echo $id;?>)' class="batt btn pull-right"><i class="fa fa-trash" style="color: #FFF;"></i> Remove Gratuity</a>
                            </div>
                        </div>
                    </form>
                    <?
                        if(isset($_POST['update']))
                        {
                            extract($_POST);
                            $sql="update com_gratuty set multiple='$gr_multi',devided='$gr_devi' where gid='$id'";
                            $con->query($sql);

                            $sql="delete from com_gratuty_allowance where gid='$id'";
                            $con->query($sql);

                            foreach($allowance as $key)
                            {
                                $sql="insert into com_gratuty_allowance values ('','$id','$key','$clientid')";
                                $con->query($sql);
                            }
                            echo "<script>window.location.href='setting_gratuti';</script>";
                        }
                    ?>
                </div>
                <div class="clear"></div>
            </div>
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
        window.location = "delete.php?id="+delid+"&&tname=com_gratuty";   
    } 
    else {     
        swal("Record Not Deleted.");   
        } });
}
</script>


<?include('extra/footer.php');?>