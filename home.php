

<?php include('extra/top.php');?>

<?php include('extra/sidemenu.php');?>

<div class="main">
    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="headding">Dashboard</div>
        </div>
        <div class="col-sm-12 pad15">
            <div class="col-sm-3 pad15">
                <div class="box bgcolor3">
                    <div class="col-sm-4 col-xs-4 dicon bgcolord3">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="col-sm-8 col-xs-8 ddata">
                        <span>Total Clients</span><br>
                        <b><?php echo mysqli_num_rows($con->query("select * from client"));?></b>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="col-sm-3 pad15">
                <div class="box bgcolor4">
                    <div class="col-sm-4 col-xs-4 dicon bgcolord4">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="col-sm-8 col-xs-8 ddata">
                        <span>Total Active Client</span><br>
                        <b><?php echo mysqli_num_rows($con->query("select * from client where status='Active'"));?></b>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            
        </div>
        <div class="clear"></div>
    </div><br>

    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="headding">Renewal Clients</div>
        </div>
        <div class="col-sm-12 pad15">
            
        </div>
        <div class="clear"></div>
    </div><br>

    
</div>

	









<?php include('extra/footer.php');?>