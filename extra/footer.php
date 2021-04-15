<?php 
    
    $foot=mysqli_fetch_array($con->query("select * from setting"));

    if($foot['sett']=="ON")
    {?>
        <div class="disign">
            <b>Powered By </b><button id="btn"><i class="fa fa-close"></i></button>
            <span><?php echo $data2['developer'];?></span>
            <p>
                <b>For Support</b><br>
                <i class="fa fa-phone"></i><?php echo $data2['contact'];?> &nbsp; &nbsp;<i class="fa fa-phone"></i><?php echo $data2['contact2'];?> <br>
                <i class="fa fa-envelope-o"></i><?php echo $data2['email'];?><br>
                <a href="<?php echo $data2['url'];?>" target="_blank"><?php echo $data2['url'];?></a>
            </p>
        </div>
    <?php }
?>





<script src="js/jquery.min.js"></script>
<script src="js/dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/app.js"></script>
<script src="js/custom.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>


</body>
</html>