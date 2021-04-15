

<?include('extra/top.php');?>

<?include('extra/sidemenu.php');?>
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Months', 'Employee'],
          ['Jan-16',  10],
          ['Feb-16',  20],
          ['Mar-16',  30],
          ['Apr-16',  40],
          ['May-16',  50],
          ['jun-16',  30],
          ['Aug-16',  70],
          ['Sep-16',  50]
        ]);

        var options = {
          title: 'Employee Count',
          // hAxis: {title: 'Months',  titleTextStyle: {color: '#333'}},
          // vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>


 <div class="main">
    <div class="page_details" style="background: none; border: none;">
        <div class="col-sm-12 pad15">
            <div class="col-sm-8 graph">
                <div id="chart_div" style="min-height: 500px;"></div>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-12 graph_side">
                    <table class="table">
                        <tr>
                            <td colspan ="3" align="center"><b>Attendance</b></td>
                        </tr>
                        <tr>
                            <td>Present</td>
                            <td align="right"><? echo $p=mysqli_num_rows($con->query("select * from attendance where client_id='$clientid' and atd='P' and atd_date='$dt'"));?></td>
                        </tr>
                        <tr>
                            <td>Absent</td>
                            <td align="right"><? 
                                    $ta=mysqli_num_rows($con->query("select * from employee where client_id='$clientid' and dol=''"));
                                    echo $ta-$p;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td align="right"><? echo $ta;?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-12 graph_side" style="height: 320px;">
                    <table class="table">
                        <tr>
                            <td colspan ="3" align="center"><b>Birth Day</b></td>
                        </tr>
                        <?
                            $res=$con->query("select * from employee where client_id='$clientid' and dol='' and dob<'$dt'");
                            while($row=mysqli_fetch_array($res))
                            {?>
                                <tr>
                                    <td><?echo $row['empcode'];?></td>
                                    <td><?echo $row['name'];?></td>
                                </tr>
                            <?}
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>	









<?include('extra/footer.php');?>