<?php
    if(!$data['img'])
    {
        if($data['gender']=='M')
            $pic="male.jpg";
        else
            $pic="female.jpg";
    }
    else
        $pic=$data['image'];
?>
<div class="mobile-menu-left-overlay"></div>
<div class="side-menu">
    <div class="userbox">
        <img src="img/<?echo $pic;?>">
        <div><?echo $data['name'];?></div>
    </div>
    <div class="side_bar">
        <ul id="mymenu">
            <li><a href="home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#!"><i class="fa fa-paper-plane-o"></i> Head Create <i class="fa fa-angle-down down" style="float: right;"></i></a>
                <ul id="down-menu">
                    <!-- <li><a href="session"><i class="fa fa-plus"></i> Session</a></li> -->
                    <li><a href="Designation"><i class="fa fa-plus"></i> Designation</a></li>
                    <li><a href="Department"><i class="fa fa-plus"></i> Department</a></li>
                    <li><a href="Branch"><i class="fa fa-plus"></i> Branch</a></li>
                    <li><a href="Categary"><i class="fa fa-plus"></i> Category</a></li>
                    <li><a href="Allowance"><i class="fa fa-plus"></i> Allowance</a></li>
                    <li><a href="Deduction"><i class="fa fa-plus"></i> Deduction</a></li>
                    <!-- <li><a href="appointment?id="><i class="fa fa-plus"></i> Appointment Letter</a></li> -->
                </ul>
            </li>
            <li><a href="create_company"><i class="fa fa-cog"></i> Setting</a></li>
            <li><a href="#!"><i class="fa fa-users"></i> Employee <i class="fa fa-angle-down down" style="float: right;"></i></a>
                <ul id="down-menu">
                    <li><a href="employee_add"><i class="fa fa-user"></i> Add Employee</a></li>
                    <li><a href="employee_show"><i class="fa fa-eye"></i> Show Employee</a></li>
                    <li><a href="employee_upload?c="><i class="fa fa-file"></i> EMP Bulk Upload</a></li>
                </ul>
            </li>
            <li><a href="#!"><i class="fa fa-calendar"></i> Attendance <i class="fa fa-angle-down down" style="float: right;"></i></a>
                <ul id="down-menu">
                    <li><a href="attendance"><i class="fa fa-calendar"></i> Attendance</a></li>
                    <li><a href="atd_upload?c="><i class="fa fa-calendar"></i> Attendance Upload</a></li>
                    <!-- <li><a href="attendance_live" target="_blank"><i class="fa fa-calendar"></i> Attendance Live</a></li> -->
                </ul>
            </li>

            <li><a href="sallary"><i class="fa fa-inr"></i> Salary</a></li>
            <li><a href="report"><i class="fa fa-bar-chart"></i> Report</a></li>
        </ul>
    </div>
</div>