<?include('extra/top.php');?>

<?include('extra/sidemenu.php');?>

<?
    $f=$_REQUEST['f'];
    $ee_share="";
    $er_share="";
    $state="";
    if($f!=0)
    {
        $sql="SELECT * FROM com_lwf where lwf_id='$f'";
        $res=$con->query($sql);
        $row=mysqli_fetch_array($res);

        $lid=$row['lwf_id'];
        $ee_share=$row['ee_share'];
        $er_share=$row['er_share'];
        $state=$row['state'];
    }
?>

<div class="main">
    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="col-sm-6 pad0">
                <div class="headding">LWF Setting</div>
            </div>  
            <div class="col-sm-6 text-right pad0">
                <a href="setting_lwf?f=0" class="batt btn">Add New</a>
                <a href="create_company" class="batt btn">Back</a>
            </div>
        </div>
        <div class="col-sm-12 pad15">
            <form class="form" role="form" method="post">
                <table class="table table-bordered">
                    <tr>
                        <th>Select Month</th>
                        <!-- <th>Limit</th> -->
                        <th>EE Share</th>
                        <th>ER Share</th>
                        <th>State</th>
                    </tr>
                    <tr>
                        <td>
                            <select name="month[]" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" multiple="true" required>
                                <?
                                    $month_a=array('01','02','03','04','05','06','07','08','09','10','11','12');
                                    foreach($month_a as $v)
                                    {
                                        $alt=0;
                                        $ym=date("Y")."-".$v;
                                        if($f!=0)
                                        {
                                            $s="select * from com_lwf_allowance where lwf_allowance='$v' and lwf_id='$lid'";
                                            $alt=mysqli_fetch_array($con->query($s));
                                        }
                                        if(!$alt)
                                        {?>
                                            <option value="<?echo $v;?>"><?echo date("M",strtotime($ym));?></option>
                                        <?}
                                        else
                                        {?>
                                            <option value="<?echo $v;?>" selected><?echo date("M",strtotime($ym));?></option>
                                        <?}
                                    }
                                ?>
                            </select>
                        </td>
                        <td><input type="text" name="ee_share" class="form-control" value="<?echo $ee_share;?>"></td>
                        <td><input type="text" name="er_share" class="form-control" value="<?echo $er_share;?>"></td>
                        <td>
                            <select name="state" class="form-control">
                                <option value="">--</option>
                                <?
                                    $sql="select distinct state from employee where client_id='$clientid' order by state asc";
                                    $res=$con->query($sql);
                                    while($al=mysqli_fetch_array($res))
                                    {?>
                                       <option <?if($state==$al['state']) echo "Selected";?>><?echo $al['state'];?></option>
                                    <?}
                                ?>
                            </select>
                        </td>
                    </tr>
                </table>
                <div class="col-sm-12">
                    <div class="form-group">
                        <?
                            if($f==0){?>
                                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                            <?}
                            else{?>
                                <input type="submit" name="update" class="btn btn-primary" value="Update">
                            <?}
                        ?>
                    </div>
                </div>
            </form>
            <?
                if(isset($_POST['submit']))
                {
                    extract($_POST);
                    $sql="insert into com_lwf values ('','$ee_share','$er_share','$state','$clientid')";
                    $con->query($sql);

                    $sql="select max(lwf_id) from com_lwf where client_id='$clientid'";
                    $res=$con->query($sql);
                    $row=mysqli_fetch_array($res);
                    $lwf_id=$row[0];


                    foreach($month as $key)
                    {
                        $sql="insert into com_lwf_allowance values ('','$lwf_id','$key','$clientid')";
                        $con->query($sql);
                    }
                    echo "<script>window.location.href='setting_lwf?f=0';</script>";
                }

                if(isset($_POST['update']))
                {
                    extract($_POST);
                    $sql="update com_lwf set ee_share='$ee_share',er_share='$er_share',state='$state' where lwf_id='$lid'";
                    $con->query($sql);

                    $sql="delete from com_lwf_allowance where lwf_id='$lid'";
                    $res=$con->query($sql);

                    foreach($month as $key)
                    {
                        $sql="insert into com_lwf_allowance values ('','$lid','$key','$clientid')";
                        $con->query($sql);
                    }
                    echo "<script>window.location.href='setting_lwf?f=0';</script>";
                }
            ?>
        </div>
        <div class="clear"></div>
    </div><br>

    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="col-sm-8 col-xs-12 pad0">
                <div class="headding">LWF Setting List</div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="col-sm-12 pad15">
            <table id="example" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Month</th>
                        <!-- <th>Limit</th> -->
                        <th>EE Share</th>
                        <th>ER Share</th>
                        <th>State</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?
                        $sql="SELECT * FROM com_lwf where client_id='$clientid' order by(lwf_id) asc";
                        $res=$con->query($sql); $i=0;
                        while($row=mysqli_fetch_array($res))
                        {   $id=$row['lwf_id']; ++$i;
                        ?>
                            <tr>
                                <td><?echo $i;?></td>
                                <td>
                                    <?
                                        $alt=$con->query("Select * from com_lwf_allowance where lwf_id='$id'");
                                        while($al=mysqli_fetch_array($alt))
                                        {
                                            $ym=date("Y")."-".$al['lwf_allowance'];
                                            echo date("M",strtotime($ym)).", ";
                                        }
                                    ?>
                                </td>
                                <!-- <td><?echo $row['lwf_limit'];?></td> -->
                                <td><?echo $row['ee_share'];?></td>
                                <td><?echo $row['er_share'];?></td>
                                <td><?echo $row['state'];?></td>
                                <td align="center">
                                    <a href="setting_lwf?f=<?echo $id;?>"><i class="fa fa-edit"></i></a>
                                    <a href="#" onclick='JSconfirm(<?php echo $id;?>)'><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?}
                    ?>
                </tbody>
            </table>
        </div>
        <div class="clear"></div>
    </div><br>
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
        window.location = "delete.php?id="+delid+"&&tname=com_lwf";   
    } 
    else {     
        swal("Record Not Deleted.");   
        } });
}
</script>


<?include('extra/footer.php');?>