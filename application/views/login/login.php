<?php $this->load->view('common/head_tpl'); ?>
<div class="container">
  <div align="center" style="margain-top:20px">
    <br /><br />
    <a href=""  style="float:none; "  class=""><h3 style="color:black;"><span>CRAZY BILLY'S</span></h2></a>
  </div>
  
</div>

<form class="form-signin" action="<?=base_url()?>Login/check_creditional" method="POST" style="margin-top:30px">
  <h2 class="form-signin-heading">sign in now</h2>
  <div class="login-wrap">
    <?php if($this->session->flashdata('msg') != ''){ ?>
    <p style="color:red;"> <?php echo $this->session->flashdata('msg'); ?> </p>
    <?php } ?>
    <input type="text" class="form-control" name="usermail" placeholder="User Email" autofocus autocomplete="off">
    <input type="password" class="form-control" name="password" placeholder="Password">
    <button class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>
    <label class="checkbox">
      <span class="pull-right">
        <a data-toggle="modal" href="#myModal"> Forgot Password?</a>
      </span>
    </label>
  </div>
</form>

<div align="center">
  <br />
  &copy; 2019 Developed By JM Marketing Solutions Inc
</div>

</div>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h4 class="modal-title">Forgot Password ?</h4>
    </div>
    <form method="POST" action="<?=base_url()?>Login/forgotPassword">
      <div class="modal-body">
        <input type="text" name="email" placeholder="Enter your email to recover your password" autocomplete="off" class="form-control placeholder-no-fix">
      </div>
      <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
        <input type="submit" name="submit" class="btn btn-success" value="Recover">
      </div>
    </form>
  </div>
</div>
</div>