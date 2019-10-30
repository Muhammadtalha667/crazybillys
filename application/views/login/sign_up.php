<?php $this->load->view('common/head_tpl'); ?>
<div class="container">

      <form class="form-signin" action="<?=base_url()?>Login/insertUser" method="POST"  enctype="multipart/form-data">
        <h2 class="form-signin-heading">User Registration </h2>
        <div class="login-wrap">
            <input type="text" class="form-control" name="fullname" placeholder="Full Name" autofocus autocomplete="off">
            <input type="text" class="form-control" name="usermail" placeholder="Email Address" autofocus autocomplete="off">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            <input type="password" class="form-control" name="confirmpass" id="confirmpass" placeholder="Retype Password">
            <button class="btn btn-lg btn-login btn-block" type="submit">Creat Your Account</button>            
        </div>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#confirmpass').focusout(function(){
            var pass = $('#password').val();
            var confirmpass = $('#confirmpass').val();
            if(pass != confirmpass){
                alert('password is not match');
                
            }
        });
    });
</script>
