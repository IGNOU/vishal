<?
    include('extra/top.php');
?>

<?include('extra/sidemenu.php');?>

<div class="main">
    <div class="page_details">
        <div class="col-sm-12 pad15_line">
            <div class="col-sm-10 pad0"><div class="headding">Salary Slip</div></div>
        </div>
        <div class="col-sm-12 pad15">
            <table class="table table-bordered">
                <tr style="font-weight: bold; background: #eee;">
                    <td>#</td>
                    <td>Report</td>
                    <td>Year</td>
                    <td>Month</td>
                    <td>EMP ID</td>
                    <td>Branch</td>
                    <td align="center">Download</td>
                </tr>
                <tr style="background: yellow;">
                    <td>1</td>
                    <td>Appointment Letter</td>
                    <td></td>
                    <td></td>
                    <td><input type="text" class="form-control" name="aempid" id="aempid"></td>
                    <td></td>
                    <td align="center">
                        <a target="_blabk" style="cursor: pointer;" onclick="Appointment()"><i class="fa fa-download"></i></a>
                        <a target="_blabk" style="cursor: pointer;" onclick="Appointment_word()"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                <tr style="background: yellow;">
                    <td>2</td>
                    <td>Salary Slip</td>
                    <td>
                        <select class="form-control" name="syear" id="syear">
                            <?
                                $res=$con->query("SELECT distinct year from salary where client_id='$clientid' order by year desc");
                                while($y=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $y['year'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" name="smonth" id="smonth">
                            <?
                                $res=$con->query("SELECT distinct month from salary where client_id='$clientid' order by month desc");
                                while($m=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $m['month'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td><input type="text" class="form-control" name="sempid" id="sempid"></td>
                    <td></td>
                    <td align="center"><a target="_blabk" style="cursor: pointer;" onclick="salary_slip()"><i class="fa fa-download"></i></a></td>
                </tr>
                <tr style="background: yellow;">
                    <td>3</td>
                    <td>Emp. Master data</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td align="center"><a target="_blabk" href="report_temp/empmaster_data?cl=<?echo $clientid;?>"><i class="fa fa-download"></i></a></td>
                </tr>
                <tr style="background: yellow;">
                    <td>4</td>
                    <td>Experience Letter</td>
                    <td></td>
                    <td></td>
                    <td><input type="text" class="form-control" name="eempid" id="eempid"></td>
                    <td></td>
                    <td align="center"><a target="_blabk" style="cursor: pointer;" onclick="Experience()"><i class="fa fa-download"></i></a></td>
                </tr>
                <tr style="background: yellow;">
                    <td>5</td>
                    <td>Monthly New Staff</td>
                    <td>
                        <select class="form-control" name="snyear" id="snyear">
                            <?
                                $res=$con->query("SELECT distinct year from salary where client_id='$clientid' order by year desc");
                                while($y=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $y['year'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" name="snmonth" id="snmonth">
                            <?
                                $res=$con->query("SELECT distinct month from salary where client_id='$clientid' order by month desc");
                                while($m=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $m['month'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td></td>
                    <td></td>
                    <td align="center"><a target="_blabk" style="cursor: pointer;" onclick="new_staff()"><i class="fa fa-download"></i></a></td>
                </tr>
                <tr style="background: yellow;">
                    <td>6</td>
                    <td>Monthly Left Staff</td>
                    <td>
                        <select class="form-control" name="slyear" id="slyear">
                            <?
                                $res=$con->query("SELECT distinct year from salary where client_id='$clientid' order by year desc");
                                while($y=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $y['year'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" name="slmonth" id="slmonth">
                            <?
                                $res=$con->query("SELECT distinct month from salary where client_id='$clientid' order by month desc");
                                while($m=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $m['month'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td></td>
                    <td></td>
                    <td align="center"><a target="_blabk" style="cursor: pointer;" onclick="left_staff()"><i class="fa fa-download"></i></a></td>
                </tr>
                <tr style="background: yellow;">
                    <td>7</td>
                    <td>Salary Disbursement Sheet</td>
                    <td>
                        <select class="form-control" name="sldyear" id="sldyear">
                            <?
                                $res=$con->query("SELECT distinct year from salary where client_id='$clientid' order by year desc");
                                while($y=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $y['year'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" name="sldmonth" id="sldmonth">
                            <?
                                $res=$con->query("SELECT distinct month from salary where client_id='$clientid' order by month desc");
                                while($m=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $m['month'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" name="sldcat" id="sldcat">
                            <option value="">--</option>
                            <?
                                $res=$con->query("SELECT * from categary where client_id='$clientid'");
                                while($m=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $m['categary'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" name="sldbranch" id="sldbranch">
                            <option value="">--</option>
                            <?
                                $res=$con->query("SELECT distinct branch from branch where client_id='$clientid' order by branch desc");
                                while($m=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $m['branch'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td align="center"><a target="_blabk" style="cursor: pointer;" onclick="Salary_Disbursement()"><i class="fa fa-download"></i></a></td>
                </tr>
                <tr style="background: yellow;">
                    <td>8</td>
                    <td>Gratuity Calculation</td>
                    <td></td>
                    <td></td>
                    <td><input type="text" class="form-control" name="gempid" id="gempid"></td>
                    <td>
                        <select class="form-control" name="gbranch" id="gbranch">
                            <option value="">--</option>
                            <?
                                $res=$con->query("SELECT distinct branch from branch where client_id='$clientid' order by branch desc");
                                while($m=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $m['branch'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td align="center"><a target="_blabk" style="cursor: pointer;" onclick="Gratuity_Calculation()"><i class="fa fa-download"></i></a></td>
                </tr>
                <tr style="background: yellow;">
                    <td>9</td>
                    <td>LWF Return</td>
                    <td><input type="date" name="fromdate" id="fromdateLWF" class="form-control" value="<?echo date('Y-m-d');?>"></td>
                    <td><input type="date" name="todate" id="todateLWF" class="form-control" value="<?echo date('Y-m-d');?>"></td>
                    <td><input type="text" class="form-control" name="lempid" id="lempid"></td>
                    <td>
                        <select class="form-control" name="lbranch" id="lbranch">
                            <option value="">--</option>
                            <?
                                $res=$con->query("SELECT distinct branch from branch where client_id='$clientid' order by branch desc");
                                while($m=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $m['branch'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td align="center"><a target="_blabk" style="cursor: pointer;" onclick="LWF_Return()"><i class="fa fa-download"></i></a></td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>P Tax Annual Return</td>
                    <td><input type="date" name="fromdate" id="fromdatePT" class="form-control" value="<?echo date('Y-m-d');?>"></td>
                    <td><input type="date" name="todate" id="todatePT" class="form-control" value="<?echo date('Y-m-d');?>"></td>
                    <td></td>
                    <td>
                        <select class="form-control" name="ptbranch" id="ptbranch">
                            <option value="">--</option>
                            <?
                                $res=$con->query("SELECT distinct branch from branch where client_id='$clientid' order by branch desc");
                                while($m=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $m['branch'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td align="center"><a target="_blabk" style="cursor: pointer;" onclick="ptax_Calculation()"><i class="fa fa-download"></i></a></td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>P Tax Monthaly Return</td>
                    <td>
                        <select class="form-control" name="ptmyear" id="ptmyear">
                            <?
                                $res=$con->query("SELECT distinct year from salary where client_id='$clientid' order by year desc");
                                while($y=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $y['year'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" name="ptmmonth" id="ptmmonth">
                            <?
                                $res=$con->query("SELECT distinct month from salary where client_id='$clientid' order by month desc");
                                while($m=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $m['month'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td><input type="text" class="form-control" name="ptmempid" id="ptmempid"></td>
                    <td>
                        <select class="form-control" name="ptbranch" id="ptmbranch">
                            <option value="">--</option>
                            <?
                                $res=$con->query("SELECT distinct branch from branch where client_id='$clientid' order by branch desc");
                                while($m=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $m['branch'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td align="center"><a target="_blabk" style="cursor: pointer;" onclick="ptax_Calculation_monthaly()"><i class="fa fa-download"></i></a></td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>TDS Calculation</td>
                    <td>
                        <select class="form-control" name="tdsyear" id="tdsyear">
                            <?
                                $res=$con->query("SELECT distinct year from salary where client_id='$clientid' order by year desc");
                                while($y=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $y['year'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td>
                        <!-- <select class="form-control" name="ptmonth" id="ptmonth">
                            <?
                                $res=$con->query("SELECT distinct month from salary where client_id='$clientid' order by month desc");
                                while($m=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $m['month'];?></option>
                                <?}
                            ?>
                        </select> -->
                    </td>
                    <td><input type="text" class="form-control" name="tdsempid" id="tdsempid"></td>
                    <td>
                        <select class="form-control" name="tdsbranch" id="tdsbranch">
                            <option value="">--</option>
                            <?
                                $res=$con->query("SELECT distinct branch from branch where client_id='$clientid' order by branch desc");
                                while($m=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $m['branch'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td align="center"><a target="_blabk" style="cursor: pointer;" onclick="tds_Calculation()"><i class="fa fa-download"></i></a></td>
                </tr>
                <tr>
                    <td>12</td>
                    <td>Bonus Calculation</td>
                    <td><input type="date" name="fromdate" id="fromdateB" class="form-control" value="<?echo date('Y-m-d');?>"></td>
                    <td><input type="date" name="todate" id="todateB" class="form-control" value="<?echo date('Y-m-d');?>"></td>
                    <td><input type="text" class="form-control" name="tdsempid" id="tdsempid"></td>
                    <td>
                        <select class="form-control" name="tdsbranch" id="tdsbranch">
                            <option value="">--</option>
                            <?
                                $res=$con->query("SELECT distinct branch from branch where client_id='$clientid' order by branch desc");
                                while($m=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $m['branch'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td align="center"><a target="_blabk" style="cursor: pointer;" onclick="tds_Calculation()"><i class="fa fa-download"></i></a></td>
                </tr>
                <tr>
                    <td>13</td>
                    <td>Bonus Register C</td>
                    <td><input type="date" name="fromdate" id="fromdateBC" class="form-control" value="<?echo date('Y-m-d');?>"></td>
                    <td><input type="date" name="todate" id="todateBC" class="form-control" value="<?echo date('Y-m-d');?>"></td>
                    <td><input type="text" class="form-control" name="tdsempid" id="tdsempid"></td>
                    <td>
                        <select class="form-control" name="tdsbranch" id="tdsbranch">
                            <option value="">--</option>
                            <?
                                $res=$con->query("SELECT distinct branch from branch where client_id='$clientid' order by branch desc");
                                while($m=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $m['branch'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td align="center"><a target="_blabk" style="cursor: pointer;" onclick="tds_Calculation()"><i class="fa fa-download"></i></a></td>
                </tr>
                <tr>
                    <td>14</td>
                    <td>Bonus Register D</td>
                    <td><input type="date" name="fromdate" id="fromdateBD" class="form-control" value="<?echo date('Y-m-d');?>"></td>
                    <td><input type="date" name="todate" id="todateBD" class="form-control" value="<?echo date('Y-m-d');?>"></td>
                    <td><input type="text" class="form-control" name="tdsempid" id="tdsempid"></td>
                    <td>
                        <select class="form-control" name="tdsbranch" id="tdsbranch">
                            <option value="">--</option>
                            <?
                                $res=$con->query("SELECT distinct branch from branch where client_id='$clientid' order by branch desc");
                                while($m=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $m['branch'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td align="center"><a target="_blabk" style="cursor: pointer;" onclick="tds_Calculation()"><i class="fa fa-download"></i></a></td>
                </tr>
                <tr style="background: yellow;">
                    <td>15</td>
                    <td>Advance Register</td>
                    <td>
                        <select class="form-control" name="adyear" id="adyear">
                            <?
                                $res=$con->query("SELECT distinct year from salary where client_id='$clientid' order by year desc");
                                while($y=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $y['year'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" name="admonth" id="admonth">
                            <option value="">--</option>
                            <?
                                $res=$con->query("SELECT distinct month from salary where client_id='$clientid' order by month desc");
                                while($m=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $m['month'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td><input type="text" class="form-control" name="adempid" id="adempid"></td>
                    <td>
                        <select class="form-control" name="adbranch" id="adbranch">
                            <option value="">--</option>
                            <?
                                $res=$con->query("SELECT distinct branch from branch where client_id='$clientid' order by branch desc");
                                while($m=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $m['branch'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td align="center"><a target="_blabk" style="cursor: pointer;" onclick="adv_Registor()"><i class="fa fa-download"></i></a></td>
                </tr>
                <tr style="background: yellow;">
                    <td>16</td>
                    <td>Over Time Register</td>
                    <td>
                        <select class="form-control" name="otyear" id="otyear">
                            <?
                                $res=$con->query("SELECT distinct year from salary where client_id='$clientid' order by year desc");
                                while($y=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $y['year'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" name="otmonth" id="otmonth">
                            <option value="">--</option>
                            <?
                                $res=$con->query("SELECT distinct month from salary where client_id='$clientid' order by month desc");
                                while($m=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $m['month'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td><input type="text" class="form-control" name="otempid" id="otempid"></td>
                    <td>
                        <select class="form-control" name="otbranch" id="otbranch">
                            <option value="">--</option>
                            <?
                                $res=$con->query("SELECT distinct branch from branch where client_id='$clientid' order by branch desc");
                                while($m=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $m['branch'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td align="center"><a target="_blabk" style="cursor: pointer;" onclick="overtime_Registor()"><i class="fa fa-download"></i></a></td>
                </tr>
                <tr style="background: yellow;">
                    <td>17</td>
                    <td>Leave Register</td>
                    <td>
                        <select class="form-control" name="lvyear" id="lvyear">
                            <?
                                $res=$con->query("SELECT distinct year from salary where client_id='$clientid' order by year desc");
                                while($y=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $y['year'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" name="lvmonth" id="lvmonth">
                            <option value="">--</option>
                            <?
                                $res=$con->query("SELECT distinct month from salary where client_id='$clientid' order by month desc");
                                while($m=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $m['month'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td><input type="text" class="form-control" name="lvempid" id="lvempid"></td>
                    <td>
                        <select class="form-control" name="lvbranch" id="lvbranch">
                            <option value="">--</option>
                            <?
                                $res=$con->query("SELECT distinct branch from branch where client_id='$clientid' order by branch desc");
                                while($m=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $m['branch'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td align="center"><a target="_blabk" style="cursor: pointer;" onclick="Leave_Registor()"><i class="fa fa-download"></i></a></td>
                </tr>
                <tr style="background: yellow;">
                    <td>18</td>
                    <td>Attendance Register</td>
                    <td>
                        <select class="form-control" name="atdyear" id="atdyear">
                            <?
                                $res=$con->query("SELECT distinct year from salary where client_id='$clientid' order by year desc");
                                while($y=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $y['year'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" name="atdmonth" id="atdmonth">
                            <option value="">--</option>
                            <?
                                $res=$con->query("SELECT distinct month from salary where client_id='$clientid' order by month desc");
                                while($m=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $m['month'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td><input type="text" class="form-control" name="atdempid" id="atdempid"></td>
                    <td>
                        <select class="form-control" name="atdbranch" id="atdbranch">
                            <option value="">--</option>
                            <?
                                $res=$con->query("SELECT distinct branch from branch where client_id='$clientid' order by branch desc");
                                while($m=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $m['branch'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td align="center"><a target="_blabk" style="cursor: pointer;" onclick="atd_Registor()"><i class="fa fa-download"></i></a></td>
                </tr>
                <tr style="background: yellow;">
                    <td>19</td>
                    <td>Salary Register</td>
                    <td>
                        <select class="form-control" name="slyear" id="slyear">
                            <?
                                $res=$con->query("SELECT distinct year from salary where client_id='$clientid' order by year desc");
                                while($y=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $y['year'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" name="slmonth" id="slmonth">
                            <option value="">--</option>
                            <?
                                $res=$con->query("SELECT distinct month from salary where client_id='$clientid' order by month desc");
                                while($m=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $m['month'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td><input type="text" class="form-control" name="slempid" id="slempid"></td>
                    <td>
                        <select class="form-control" name="slbranch" id="slbranch">
                            <option value="">--</option>
                            <?
                                $res=$con->query("SELECT distinct branch from branch where client_id='$clientid' order by branch desc");
                                while($m=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $m['branch'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td align="center"><a target="_blabk" style="cursor: pointer;" onclick="salary_register()"><i class="fa fa-download"></i></a></td>
                </tr>
                <tr style="background: yellow;">
                    <td>20</td>
                    <td>PF Challan</td>
                    <td>
                        <select class="form-control" name="pfcyear" id="pfcyear">
                            <?
                                $res=$con->query("SELECT distinct year from salary where client_id='$clientid' order by year desc");
                                while($y=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $y['year'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" name="pfcmonth" id="pfcmonth">
                            <option value="">--</option>
                            <?
                                $res=$con->query("SELECT distinct month from salary where client_id='$clientid' order by month desc");
                                while($m=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $m['month'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td></td>
                    <td></td>
                    <td align="center"><a target="_blabk" style="cursor: pointer;" onclick="PF_Calculation()"><i class="fa fa-download"></i></a></td>
                </tr>
                <tr style="background: yellow">
                    <td>21</td>
                    <td>PF ECR</td>
                    <td>
                        <select class="form-control" name="pfecr_year" id="pfecr_year">
                            <?
                                $res=$con->query("SELECT distinct year from salary where client_id='$clientid' order by year desc");
                                while($y=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $y['year'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" name="pfecr_month" id="pfecr_month">
                            <option value="">--</option>
                            <?
                                $res=$con->query("SELECT distinct month from salary where client_id='$clientid' order by month desc");
                                while($m=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $m['month'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td></td>
                    <td></td>
                    <td align="center"><a target="_blabk" style="cursor: pointer;" onclick="PF_ECR()"><i class="fa fa-download"></i></a></td>
                </tr>
                <tr style="background: yellow;">
                    <td>22</td>
                    <td>ESI Calculation</td>
                    <td>
                        <select class="form-control" name="atdyear" id="esiyear">
                            <?
                                $res=$con->query("SELECT distinct year from salary where client_id='$clientid' order by year desc");
                                while($y=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $y['year'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" name="atdmonth" id="esimonth">
                            <option value="">--</option>
                            <?
                                $res=$con->query("SELECT distinct month from salary where client_id='$clientid' order by month desc");
                                while($m=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $m['month'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td><input type="text" class="form-control" name="atdempid" id="esiempid"></td>
                    <td>
                        <select class="form-control" name="atdbranch" id="esibranch">
                            <option value="">--</option>
                            <?
                                $res=$con->query("SELECT distinct branch from branch where client_id='$clientid' order by branch desc");
                                while($m=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $m['branch'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td align="center"><a target="_blabk" style="cursor: pointer;" onclick="ESI_Calculation()"><i class="fa fa-download"></i></a></td>
                </tr>
                <tr style="background: yellow;">
                    <td>23</td>
                    <td>ESI upload</td>
                    <td>
                        <select class="form-control" name="atdyear" id="esiuyear">
                            <?
                                $res=$con->query("SELECT distinct year from salary where client_id='$clientid' order by year desc");
                                while($y=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $y['year'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" name="atdmonth" id="esiumonth">
                            <option value="">--</option>
                            <?
                                $res=$con->query("SELECT distinct month from salary where client_id='$clientid' order by month desc");
                                while($m=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $m['month'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td><input type="text" class="form-control" name="atdempid" id="esiuempid"></td>
                    <td>
                        <select class="form-control" name="atdbranch" id="esiubranch">
                            <option value="">--</option>
                            <?
                                $res=$con->query("SELECT distinct branch from branch where client_id='$clientid' order by branch desc");
                                while($m=mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $m['branch'];?></option>
                                <?}
                            ?>
                        </select>
                    </td>
                    <td align="center"><a target="_blabk" style="cursor: pointer;" onclick="ESI_Upload()"><i class="fa fa-download"></i></a></td>
                </tr>
            </table>
        </div>
        <div class="clear"></div>
    </div>
</div>




<script type="text/javascript">
    function Appointment()
    {
        var e=document.getElementById('aempid').value;
        window.open("report_download?y=&m=&e="+e+"&b=&val=Appointment");
    }

    function Appointment_word()
    {
        var e=document.getElementById('aempid').value;
        window.open("report_temp/appointment_word?e="+e);
    }

    function salary_slip()
    {
        var y=document.getElementById('syear').value;
        var m=document.getElementById('smonth').value;
        var e=document.getElementById('sempid').value
        window.open("report_download?y="+y+"&m="+m+"&e="+e+"&b=&val=salary-slip");
    }

    function Experience()
    {
        var e=document.getElementById('eempid').value;
        window.open("report_temp/experience_letter?e="+e+"&cl=<?echo $clientid;?>");
    }

    function new_staff()
    {
        var y=document.getElementById('snyear').value;
        var m=document.getElementById('snmonth').value;
        window.open("report_temp/emp_new_staff?y="+y+"&m="+m+"&cl=<?echo $clientid;?>");
    }
    function left_staff()
    {
        var y=document.getElementById('slyear').value;
        var m=document.getElementById('slmonth').value;
        window.open("report_temp/emp_left_staff?y="+y+"&m="+m+"&cl=<?echo $clientid;?>");
    }
    function Salary_Disbursement()
    {
        var y=document.getElementById('sldyear').value;
        var m=document.getElementById('sldmonth').value;
        var c=document.getElementById('sldcat').value;
        var b=document.getElementById('sldbranch').value;
        window.open("report_temp/salary_disbursement_sheet?y="+y+"&m="+m+"&c="+c+"&b="+b+"&cl=<?echo $clientid;?>");
    }
    function Gratuity_Calculation()
    {
        var e=document.getElementById('gempid').value;
        var b=document.getElementById('gbranch').value;
        window.open("report_temp/gratuity_calculation?e="+e+"&b="+b+"&cl=<?echo $clientid;?>");
    }
    function LWF_Return()
    {
        var f=document.getElementById('fromdateLWF').value;
        var t=document.getElementById('todateLWF').value;
        var e=document.getElementById('lempid').value;
        var b=document.getElementById('lbranch').value;
        window.open("report_temp/lwf_return?f="+f+"&t="+t+"&e="+e+"&b="+b+"&cl=<?echo $clientid;?>");
    }
    function ptax_Calculation()
    {
        var f=document.getElementById('fromdatePT').value;
        var t=document.getElementById('todatePT').value;
        var b=document.getElementById('ptbranch').value;
        window.open("report_temp/ptax_annual?f="+f+"&t="+t+"&e=&b="+b+"&cl=<?echo $clientid;?>");
    }
    function ptax_Calculation_monthaly()
    {
        var y=document.getElementById('ptmyear').value;
        var m=document.getElementById('ptmmonth').value;
        var e=document.getElementById('ptmempid').value;
        var b=document.getElementById('ptmbranch').value;
        window.open("report_temp/ptax_monthaly?y="+y+"&m="+m+"&e="+e+"&b="+b+"&cl=<?echo $clientid;?>");
    }
    function tds_Calculation()
    {
        var y=document.getElementById('tdsyear').value;
        // var m=document.getElementById('ptmonth').value;
        var e=document.getElementById('tdsempid').value;
        var b=document.getElementById('tdsbranch').value;
        window.open("report_temp/tds_calculation?y="+y+"&m=&e="+e+"&b="+b+"&cl=<?echo $clientid;?>");
    }


    function adv_Registor()
    {
        var y=document.getElementById('adyear').value;
        var m=document.getElementById('admonth').value;
        var e=document.getElementById('adempid').value;
        var b=document.getElementById('adbranch').value;
        window.open("report_temp/adv_registor?y="+y+"&m="+m+"&e="+e+"&b="+b+"&cl=<?echo $clientid;?>");
    }
    function overtime_Registor()
    {
        var y=document.getElementById('otyear').value;
        var m=document.getElementById('otmonth').value;
        var e=document.getElementById('otempid').value;
        var b=document.getElementById('otbranch').value;
        window.open("report_temp/overtime_registor?y="+y+"&m="+m+"&e="+e+"&b="+b+"&cl=<?echo $clientid;?>");
    }

    function Leave_Registor()
    {
        var y=document.getElementById('lvyear').value;
        var m=document.getElementById('lvmonth').value;
        var e=document.getElementById('lvempid').value;
        var b=document.getElementById('lvbranch').value;
        window.open("report_temp/leave_registor?y="+y+"&m="+m+"&e="+e+"&b="+b+"&cl=<?echo $clientid;?>");
    }

    function atd_Registor()
    {
        var y=document.getElementById('atdyear').value;
        var m=document.getElementById('atdmonth').value;
        var e=document.getElementById('atdempid').value;
        var b=document.getElementById('atdbranch').value;
        window.open("report_temp/atd_registor?y="+y+"&m="+m+"&e="+e+"&b="+b+"&cl=<?echo $clientid;?>");
    }

    function salary_register()
    {
        var y=document.getElementById('slyear').value;
        var m=document.getElementById('slmonth').value;
        var e=document.getElementById('slempid').value;
        var b=document.getElementById('slbranch').value;
        window.open("report_temp/salary_registor?y="+y+"&m="+m+"&e="+e+"&b="+b+"&cl=<?echo $clientid;?>");
    }

    function PF_Calculation()
    {
        var y=document.getElementById('pfcyear').value;
        var m=document.getElementById('pfcmonth').value;
        window.open("report_temp/PF_Calculation?y="+y+"&m="+m+"&e=&b=&cl=<?echo $clientid;?>");
    }

    function PF_ECR()
    {
        var y=document.getElementById('pfecr_year').value;
        var m=document.getElementById('pfecr_month').value;
        window.open("report_temp/pf_ecr?y="+y+"&m="+m+"&e=&b=&cl=<?echo $clientid;?>");
    }


    function ESI_Calculation()
    {
        var y=document.getElementById('esiyear').value;
        var m=document.getElementById('esimonth').value;
        var e=document.getElementById('esiempid').value;
        var b=document.getElementById('esibranch').value;
        window.open("report_temp/esi_calculation?y="+y+"&m="+m+"&e="+e+"&b="+b+"&cl=<?echo $clientid;?>");
    }

    function ESI_Upload()
    {
        var y=document.getElementById('esiuyear').value;
        var m=document.getElementById('esiumonth').value;
        var e=document.getElementById('esiuempid').value;
        var b=document.getElementById('esiubranch').value;
        window.open("report_temp/esi_upload?y="+y+"&m="+m+"&e="+e+"&b="+b+"&cl=<?echo $clientid;?>");
    }
</script>







<?include('extra/footer.php');?>