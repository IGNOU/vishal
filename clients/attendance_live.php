
<!DOCTYPE html>
<html>
<head>
    <title>Payroll</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />        
    <link href="css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/slidemenu.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" href="js/sweetalert.css">
    <script src="js/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.min.css">

    <link rel="stylesheet" href="js/jquery-ui.css">
    
<style>
    .due{
        background: red;
        text-align: center;
        font-size: 2em;
        font-weight: bold;
        padding: 10px;
        color: #FFF;
        letter-spacing: 3px;
        font-family: Renfew;
    }
    .welcome{
        background: #00a2d3;
        text-align: center;
        font-size: 2em;
        font-weight: bold;
        padding: 10px;
        color: #FFF;
        letter-spacing: 3px;
        font-family: Renfew;
    }
    table{
        width: 100%;
        font-size: 1.2em;
        font-weight: bold;
    }
    td{
        padding: 8px 5px;
    }
    input{
        /*border: none;*/
        color: #f5f5f5;
        width: 100%;
        outline: none;
    }
    input:focus{
        border: none;
        outline: none;
    }
    .panel-default{
        height: 400px;
    }
    .panel-body{padding-top: 40px;}
</style>

<!-- <script type='text/javascript'>
  $("#body").on("keydown keypress keyup", false);
</script> -->

</head>

<body style="background: #e2f2fc;" onclick="openFullscreen()">

<div class="container-fluid pad0">
    <div class="col-sm-12" style="background: #e2f2fc; padding: 10px 0px;" align="center">
        <!-- <img src="img/form.jpg" width="100%" height="150"> -->
        <span style="font-size: 4em;">Payroll Attendance System</span>
    </div>
    <div class="page_details">
        <div class="col-sm-12 pad15">
        	<!-- <form> -->
	            <input type="text" name="id" id="id" autofocus onkeyup="find()" autocomplete="off">
	        <!-- </form> -->

            <div id="data">
                <div class="col-sm-3"></div>
                <div class="col-sm-6 pad0">
                    <div class="panel panel-default">
                        <div class="panel-heading">Employee Details</div>
                        <div class="panel-body">
                            <div class="col-sm-8 pad0">
                                <table>
                                    <tr>
                                        <td>Emp ID</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Card Number</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Name</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Father's Name</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>DOB</td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-sm-4">
                                <img src="img/male.jpg" class="img-responsive">
                            </div>
                        </div>
                    </div>
                </div>
             
            </div>
        </div>
        <div class="clear"></div>
    </div><br>
</div>






<script type="text/javascript">
    function find()
    {
        var id=document.getElementById('id').value;
        if(id.length==10)
        {
            //alert(id);
            xmlhttp=new XMLHttpRequest();
            xmlhttp.open("GET","attendance_live_data.php?id="+id,false);
            xmlhttp.send(null);
            document.getElementById('data').innerHTML=xmlhttp.responseText;
            document.getElementById('id').value="";
            document.getElementById('id').focus();

        }
        

    }
</script>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- <script type="text/javascript">
    var elem = document.documentElement;
    function openFullscreen() {
      if (elem.requestFullscreen) {
        elem.requestFullscreen();
      } else if (elem.mozRequestFullScreen) { 
        elem.mozRequestFullScreen();
      } else if (elem.webkitRequestFullscreen) { 
        elem.webkitRequestFullscreen();
      } else if (elem.msRequestFullscreen) { 
        elem.msRequestFullscreen();
      }
    }
</script> -->
</body>
</html>