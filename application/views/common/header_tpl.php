<?php
$session = $this->session->userdata('USER_SESSION');
?>
<section id="container" style="overflow: hidden;">
  <!--header start-->
  <header class="header white-bg">
    <div class="sidebar-toggle-box">
      <!-- <i class="fa fa-bars"></i> -->
      <span>
        <img src="<?=base_url()?>asset/img/Logo.gif" style="width: 50px;cursor: pointer;">
      </span>
    </div>
    <!--logo start-->
    <a href="<?php echo base_url();?>" class="logo">CRAZY BILLY'S</font></sub> </a>
    <!--logo end-->
    <div class="nav notify-row" id="top_menu">
    </div>
    <div class="top-nav ">
      <!--search & user info start-->
      <ul class="nav pull-right top-menu">
        <li class="dropdown">
          <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            <span class="username"><?php echo $session['name'];?></span>
            <b class="caret"></b>
          </a>
          <ul class="dropdown-menu logout status_list" style="width: 155px !important;">
            <div class="log-arrow-up"></div>
            <li><a href="<?=base_url()?>Login/changePass/<?php echo $session['userId'] ?>"><i class="fa fa-user">&nbsp;</i>Change Password</a></li>
            <li><a href="<?=base_url()?>Login/logout"><i class="fa fa-key"></i> Log Out</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </header>
  <!--header end-->
</section>