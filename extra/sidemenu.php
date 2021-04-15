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
        <img src="img/<?php echo $pic;?>">
        <div><?php echo $data['name'];?></div>
    </div>
    <div class="side_bar">
        <ul id="mymenu">
            <li><a href="home"><i class="fa fa-dashboard"></i> Dashborad</a></li>
            <li><a href="Plan"><i class="fa fa-paper-plane-o"></i> Plan</a></li>
            <li><a href="Client"><i class="fa fa-user-plus"></i> Client</a></li>
            <li><a href="Payment"><i class="fa fa-inr"></i> Payment</a></li>

            <?php  if($sesuser=="santoo.gaya@gmail.com"){ ?>
            <li><a href="#!"><i class="fa fa-connectdevelop"></i> Developer Zoon <i class="fa fa-angle-down down" style="float: right;"></i></a>
                <ul id="down-menu">
                    <li><a href="d_setting"><i class="fa fa-cogs"></i> Setting</a></li>
                    <!-- <li><a href="d_settingshow"><i class="fa fa-eye"></i> Show Setting</a></li> -->
                </ul>
            </li>
            <?php  } ?>
        </ul>
    </div>
</div>