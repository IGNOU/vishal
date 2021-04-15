<!-- <div class="disign">
    <b>Powered By </b><button id="btn"><i class="fa fa-close"></i></button>
    <span><?echo $data2['developer'];?></span>
    <p>
        <b>For Support</b><br>
        <i class="fa fa-phone"></i><?echo $data2['contact'];?> &nbsp; &nbsp;<i class="fa fa-phone"></i><?echo $data2['contact2'];?> <br>
        <i class="fa fa-envelope-o"></i><?echo $data2['email'];?><br>
        <a href="<?echo $data2['url'];?>" target="_blank"><?echo $data2['url'];?></a>
    </p>
</div> -->






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