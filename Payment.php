
<?php include('extra/top.php');?>

<?php include('extra/sidemenu.php');?>

<div class="main">
    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="col-sm-6 pad0">
                <div class="headding">Payment</div>
            </div>  
        </div>
        <div class="col-sm-12 pad15">
            <form method="POST" class="form" enctype="multipart/form-data">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Client Name *</label>
                        <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="client" required onchange="payment(this.value)">
                            <option value="">--</option>
                            <?php 
                                $pl=$con->query("select * from client order by name asc");
                                while($plr=mysqli_fetch_array($pl))
                                {?>
                                    <option value="<?php echo $plr['cid'];?>">
                                        <?php echo $plr['name'];?>
                                    </option>
                                <?php }
                            ?>
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div class="clear"></div>
    </div><br>

    <div id="data">
        <div class="page_details">
            <div class="col-sm-12 pad15_line">
                <div class="col-sm-8 col-xs-12 pad0">
                    <div class="headding">Client List</div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="col-sm-12 pad15">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <td width="30">#</td>
                            <td>Client</td>
                            <td>Mobile</td>
                            <td>Plan</td>
                            <td>Amount</td>
                            <td>Paid</td>
                            <td>Date</td>
                            <td width="80" align="center">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sql="SELECT ppid,name,mobile,deal,plan.plan,payment,pay_date from client,plan,plan_payment where client.plan=pid and cid=clid";
                            $res=$con->query($sql); $i=0;
                            while($row=mysqli_fetch_array($res))
                            {   $id=$row['ppid']; ++$i;
                            ?>
                                <tr>
                                    <td><?php echo $i;?></td>
                                    <td><?php echo $row['name'];?></td>
                                    <td><?php echo $row['mobile'];?></td>
                                    <td><?php echo $row['plan'];?></td>
                                    <td><?php echo $row['deal'];?></td>
                                    <td><?php echo $row['payment'];?></td>
                                    <td><?php echo date('d-m-Y',strtotime($row['pay_date']));?></td>
                                    <td align="center">
                                        <a href="#" onclick='JSconfirm(<?php php echo $id;?>)'><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="clear"></div>
        </div><br>
    </div>
</div>

<?php 
    if(isset($_POST['save']))
    {
        extract($_POST);

        if(isset($sms))
            $sms=$_POST['sms'];
        else
            $sms="No";
        if($mode=='Cheque')
        {
            $sql="insert into plan_payment values('','$clid','$plid','$bank_name','$cheque_no','$cheque_date','$paid','$date','$sms')";
        }
        if($mode=='Card')
        {
            $sql="insert into plan_payment values('','$clid','$plid','$bank_name','','','$paid','$date','$sms')";
        }
        if($mode=='Cash' || $mode=='Paytm' || $mode=='PhonePe' || $mode=='GooglePay')
        {
            $sql="insert into plan_payment values('','$clid','$plid','','','','$paid','$date','$sms')";
        }
        $con->query($sql);

        echo "<script>window.location.href='Payment';</script>";
    }
?>

    



<script type="text/javascript">
    function payment(val)
    {
        xmlhttp=new XMLHttpRequest();
        xmlhttp.open("GET","payment_form.php?find="+val,false);
        xmlhttp.send(null);
        document.getElementById('data').innerHTML=xmlhttp.responseText;
    }

    function discount_amount(val)
        {
            var discount=val;
            var total=document.getElementById('total').value
            document.getElementById('net').value=total-discount;
        }

        function paid_amount()
        {
            var paid=parseInt(document.getElementById('paid').value)
            var net=parseInt(document.getElementById('net').value)

            if(net>=paid)
            {
                document.getElementById('submit').disabled=false;
                document.getElementById('paid').style="border:1px solid #DDD;";
                document.getElementById('paid2').innerHTML="";
            }
            else if(net<paid)
            {
                document.getElementById('submit').disabled=true;
                document.getElementById('paid').style="border:1px solid red;";
                document.getElementById('paid2').innerHTML="Paid amount over net amount";
            }
            else if(paid=="")
            {
                document.getElementById('submit').disabled=true;
                document.getElementById('paid').style="border:1px solid red;";
                document.getElementById('paid2').innerHTML="Paid amount not blank";
            }
            else
            {
                document.getElementById('submit').disabled=true;
                document.getElementById('paid').style="border:1px solid red;";
                document.getElementById('paid2').innerHTML="Paid amount not blank";
            }
        }

        function pay_mode(val)
        {
            xmlhttp=new XMLHttpRequest();
            xmlhttp.open("GET","payment_modform?find="+val,false);
            xmlhttp.send(null);
            document.getElementById('mode_data').innerHTML=xmlhttp.responseText;
        }
</script>

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
        window.location = "delete.php?id="+delid+"&&tname=client";   
    } 
    else {     
        swal("Record Not Deleted.");   
        } });
}
</script>


<?php include('extra/footer.php');?>