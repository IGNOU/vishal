<?php 
	include('extra/connect.php');
	$id=$_REQUEST['find'];
    
    $sql="select * from client where cid='$id'";
    $row=mysqli_fetch_array($con->query($sql));

    $pid=$row['plan'];
    $sql2="select * from plan where pid='$pid'";
    $prow=mysqli_fetch_array($con->query($sql2));

    $pid=$row['plan'];
    $sql3="select sum(payment) from plan_payment where plid='$pid' and clid='$id'";
    $pprow=mysqli_fetch_array($con->query($sql3));



    if($id!="")
    {
        ?>
        <div class="page_details">
            <div class="col-sm-12 pad15_line">
                <div class="headding">Make Payment</div>
            </div>
            <div class="col-sm-12 pad15">
                <form method="POST" class="form">
                    <div class="col-sm-6">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Payment Date</label>
                                <input type="date" name="date" class="form-control" required value="<?php echo date("Y-m-d");?>">
                                <input type="hidden" name="clid" class="form-control" required value="<?php echo $id;?>">
                                <input type="hidden" name="plid" class="form-control" required value="<?php echo $pid;?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" readonly value="<?php echo $row['name'];?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Plan</label>
                                <input type="text" name="plan" class="form-control" readonly value="<?php echo $prow['plan'];?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Validity</label>
                                <input type="text" name="plan" class="form-control" readonly value="<?php echo $prow['validity'];?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Plan Start</label>
                                <input type="text" name="plan_start" class="form-control" value="<?php echo date('d-m-Y',strtotime($row['plan_start']));?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Plan End</label>
                                <input type="text" name="plan_end" class="form-control" value="<?php echo date('d-m-Y',strtotime($row['plan_end']));?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Payment Mode</label>
                                <select name="mode" class="form-control" onchange="pay_mode(this.value)">
                                    <option>Cash</option>
                                    <option>Cheque</option>
                                    <option>Card</option>
                                    <option>Paytm</option>
                                    <option>PhonePe</option>
                                    <option>GooglePay</option>
                                </select>
                            </div>
                        </div>
                        <div id="mode_data"></div>
                    </div>

                    <div class="col-sm-6" style="background: #ddd; padding: 20px;">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Total Amount</label>
                                <input type="text" name="total" class="form-control" readonly value="<?php echo $row['deal'];?>">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Collect Amount</label>
                                <input type="text" name="collect" class="form-control" readonly value="<?php echo $pprow[0];?>">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Net Amount</label>
                                <input type="text" name="net" class="form-control" id="net" readonly value="<?php echo $row['deal']-$pprow['0'];?>">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Paid Amount *</label>
                                <input type="text" name="paid" class="form-control" id="paid" onkeyup="paid_amount()" required style="background: #FFF;" value="0.00">
                                <span id="paid2" style="color: red"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 form-group">
                        <div class="col-sm-12 form-group">
                            <br>
                            <label style="font-size: 1.2em; cursor: pointer;">
                                <input type="checkbox" name="sms" value="Yes" style="width: 18px; height: 18px;"> 
                                Sent SMS
                            </label>
                        </div>
                        <br><br>
                        <input type="submit" class="btn btn-primary" name="save" value="Submit" id="submit" disabled>
                    </div>
                </form>
            </div>
            <div class="clear"></div>
        </div><br>
    <?php }
    else
    { ?>
        <div class="page_details">
            <div class="col-sm-12 pad15_line">
                <div class="headding">Fee Deposit</div>
            </div>
            <div class="col-sm-12 pad15">
                <span style="display: block; text-align: center; font-size: 1.5em; font-weight: 300; color: red;">All Ready Pay Full Payment !</span>
            </div>
            <div class="clear"></div>
        </div>
    <?php }
?>