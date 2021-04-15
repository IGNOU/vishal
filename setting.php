
<?php include('extra/top.php');?>

<?php include('extra/sidemenu.php');?>
<style>
  .switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 20px;
  }

  .switch input { 
    opacity: 0;
    width: 0;
    height: 0;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 18px;
    width: 18px;
    left: 4px;
    bottom: 1px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }

  input:checked + .slider {
    background-color: #2196F3;
  }

  input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }

  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  }
</style>

<div class="main">
    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="col-sm-6 pad0">
                <div class="headding">Setting</div>
            </div>  
        </div>
        <div class="col-sm-12 pad15">
            <?php 
              $row=mysqli_fetch_array($con->query("select * from setting"));
              if($row['sett']=="ON")
              { ?>
                <label>Powered By Display or not in your web panel. Powered By Display only dashborad in your web panel.(ON/OFF)</label>
                <label class="switch">
                  <input type="checkbox" checked value="OFF" onclick="powerby(this.value)">
                  <span class="slider round"></span>
                </label>
              <?php }
              else{?>
                <label>Powered By Display or not in your web panel. Powered By Display only dashborad in your web panel.(ON/OFF)</label>
                <label class="switch">
                  <input type="checkbox" value="ON" onclick="powerby(this.value)">
                  <span class="slider round"></span>
                </label>
              <?php }
            ?>            
        </div>
        <div class="clear"></div>
    </div><br>

</div>

	




<script type="text/javascript">
    function powerby(val)
    {
      window.location.href='powerby.php?find='+val;
    }
</script>

<?php include('extra/footer.php');?>