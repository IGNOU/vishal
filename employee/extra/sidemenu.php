<?php
    if(!$data['image'])
    {
        if($data['gender']=='M')
            $pic="img/male.jpg";
        else
            $pic="img/female.jpg";
    }
    else
        $pic="../clients/emp_img/".$data['image'];
?>
<div class="mobile-menu-left-overlay"></div>
<div class="side-menu">
    <div class="userbox">
        <img src="<?echo $pic;?>">
        <div><?echo $data['name'];?></div>
    </div>
    <div class="side_bar">
        <ul id="mymenu">
            <li><a href="home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="attendance"><i class="fa fa-calendar-plus-o"></i> Manual Attendance</a></li>
            <li><a href="attendance_history"><i class="fa fa-calendar-check-o"></i> Attendance History</a></li>
            <li><a href="attendance_approval"><i class="fa fa-calculator"></i> Attendance Approval</a></li>
            <li><a href="salary_slip"><i class="fa fa-calculator"></i> Salay Slip</a></li>
            
        </ul>
    </div>
</div>