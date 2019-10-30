<div class="container">
    <div class="col-lg-offset-3 col-lg-6 col-xs-12" style="background-color: white;margin-top: 40px;">
    <div class="panel panel-login">
    <div class="panel-heading" style="background-color: #E4482A;">
        <div class="row">
            <div class="col-xs-6">
                <a href="#" class="active" id="login-form-link" style="color: white;">Login</a>
            </div>
            <div class="col-xs-6">
                <a href="#" id="register-form-link" style="color: white;">Register</a>
            </div>
        </div>
        <hr>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <p style="color: red;"><?php echo $this->session->flashdata('msg'); ?></p>
                <form id="login-form" action="<?=base_url()?>U_login/loginUser" method="post" role="form" style="display: block;">
                    <?php $id = $this->uri->segment(3); ?>
                    <input type="hidden" name="infoId" value="<?php echo $id ?>">
                    <div class="form-group">
                        <input type="text" name="user_log" id="user_log" tabindex="1" class="form-control" placeholder="Username" value="">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_log" id="password_log" tabindex="2" class="form-control" placeholder="Password">
                    </div>
                   
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                            </div>
                        </div>
                    </div>
                </form>
                <form id="register-form" action="<?=base_url()?>U_login/UserSignUp" method="post" role="form" style="display: none;">
                    <?php $id = $this->uri->segment(3); ?>
                    <input type="hidden" name="infoId" value="<?php echo $id ?>">
                    <div class="form-group">
                        <input type="text" name="username" id="username_reg" tabindex="1" class="form-control" placeholder="User Name" value="" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="contact" id="contact" tabindex="1" class="form-control" placeholder="Enter Your Contact" value="" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password_reg" tabindex="2" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password" required>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>
</div>
</div>
<script type="text/javascript">
    $(function() {
    $('#confirm-password').focusout(function(){
    var pass = $('#password_reg').val();
    var confirm = $('#confirm-password').val();
    if (confirm != pass) {
    alert('Password not match!');
        $('#confirm-password').val('');
        }
    });
    $('#login-form-link').click(function(e) {
        $("#login-form").delay(100).fadeIn(100);
        $("#register-form").fadeOut(100);
        $('#register-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });
    $('#register-form-link').click(function(e) {
        $("#register-form").delay(100).fadeIn(100);
        $("#login-form").fadeOut(100);
        $('#login-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });
});
</script>