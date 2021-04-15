

<?include('extra/top.php');?>

<?include('extra/sidemenu.php');?>

<?
    $m=date("m");
    $y=date("Y");
    $ym=$y."-".$m;
    $d=cal_days_in_month(CAL_GREGORIAN,$m,$y);
    $a=1;
    
    $sql="select * from employee where client_id='$clientid' order by (emp_id) asc";
    $res=$con->query($sql);

    $count=0;
?>

<div class="main">
    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="col-sm-6 pad0">
                <div class="headding">Attendance</div>
            </div>
            <div class="col-sm-6 text-right">
                <input name="text" id="txt_searchall" placeholder="Type to search..." oninput="this.value = this.value" style="width: 180px; padding: 4px 5px; border-radius: 2px; border: 1px solid #ddd;">
                
                <a id="ExportExcel" class="batt btn">Export In Excel</a>
                <button onclick='JSconfirm()' title="Delete Record" class="batt btn"><i class="fa fa-trash" style="color: #FFF;"></i> Delete</button>
            </div>
            <div class="clear"></div>
        </div>
        <div class="col-sm-12 pad15">
            <form role="form" method="post" class="form" enctype="multipart/form-data"> 
                <div id="msg"></div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Year *</label>
                        <input type="text" name="year" id="year" class="form-control" value="<?echo date('Y');?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Month *</label>
                        <select name="month" class="form-control" id="month">
                            <option value="">--</option>
                            <option value="01">Jan</option>
                            <option value="02">Feb</option>
                            <option value="03">Mar</option>
                            <option value="04">Apr</option>
                            <option value="05">May</option>
                            <option value="06">Jun</option>
                            <option value="07">Jul</option>
                            <option value="08">Aug</option>
                            <option value="09">Sep</option>
                            <option value="10">Oct</option>
                            <option value="11">Nov</option>
                            <option value="12">Dec</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4 form-group">
                    <div class="form-group"><br>
                        <input type="button" class="btn btn-primary" name="update" id="attendance" value="OK">
                    </div>
                </div>
            </form>        
        </div>
        <div class="clear"></div>
    </div><br>

    <div id="data">
        
    </div>
</div>








<?include('extra/footer.php');?>

<script type="text/javascript">
    $(document).ready(function(){

        // Search all columns
        $('#txt_searchall').keyup(function(){
            // Search Text
            var search = $(this).val();

            // Hide all table tbody rows
            $('#data table tbody tr').hide();

            // Count total search result
            var len = $('#data table tbody tr:not(.notfound) td:contains("'+search+'")').length;

            if(len > 0){
              // Searching text in columns and show match row
              $('#data table tbody tr:not(.notfound) td:contains("'+search+'")').each(function(){
                  $(this).closest('tr').show();
              });
            }else{
              $('.notfound').show();
            }
            
        });
       
    });

    $(document).ready(function(){
        $(document).ajaxSend(function(){
            $("#overlay").fadeIn(300);
        });
            
        $('#attendance').click(function(){
            var year=document.getElementById('year').value;
            var month=document.getElementById('month').value;

            if(year!="" && month!="")
            {
                $.ajax({
                    type: 'GET',
                    url : 'attendance_list.php', //Here you will fetch records 
                    data : {year : year, month : month, cl : '<?echo $clientid;?>'}, //Pass $id
                    success: function(data){
                        $('#msg').html('');
                        $('#data').html(data);
                    }
                }).done(function() {
                    setTimeout(function(){
                        $("#overlay").fadeOut(300);
                    },500);
                });

            }
            else
            {
                document.getElementById('msg').innerHTML="Complete Year & Month Box.";
                msg.style.color="red";
            }
        });
    });
</script>

<script src="js/table2excel.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $("#ExportExcel").click(function () {
            var d=new Date();
            var dd=d.getDate();
            var mm=d.getMonth()+1;
            var yy=d.getFullYear();
            var tdate=dd+"-"+mm+"-"+yy;
            $("#data").table2excel({
                filename: "Attendance & Over Time List.xls"
            });
        });
    });
</script>
<script type="text/javascript">
function JSconfirm(){
    var y=document.getElementById('y').value;
    var m=document.getElementById('m').value;
    if(y!="" && m!="")
    {
        swal({ 
            title: "Do you want to delete it ?",   
            // text: "Redirect me to home page?",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes",   
            cancelButtonText: "No",   
            closeOnConfirm: false,   
            closeOnCancel: false 
        }, 
        
        function(isConfirm){   
            if(isConfirm) 
            {   
                window.location = "delete.php?id="+y+"&&m="+m+"&&tname=attendance"+"&&cl=<?echo $clientid;?>";   
            } 
            else {     
                swal("Record Not Deleted.");   
                } 
        });
    }
    
}
</script>

