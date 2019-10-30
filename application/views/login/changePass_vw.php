<?php 
    $this->load->view('common/head_tpl');
    $id = $this->uri->segment(3);
?>
<div class="container">

      <form class="form-signin" action="<?=base_url()?>Login/newPass" method="POST">
        <h2 class="form-signin-heading">Update Password</h2>
        <div class="login-wrap">
            <input type="hidden" name = "userid" id="userid" value="<?php echo $this->uri->segment(3); ?>" >
            <input type="password" class="form-control" name="oldPass" id ="oldPass" placeholder="Old Password" autofocus autocomplete="off" required>
            <input type="password" class="form-control" name="password" id = "pass" placeholder="New Password" required>
            <input type="password" class="form-control" name="confirm" id = "confirmPass" placeholder="Confirm New Password" required>
            <button class="btn btn-lg btn-login btn-block" type="submit">Update</button>            
        </div>
    </form>
</div>
<script type ="text/javascript">
    $(document).ready(function(){
        $('#oldPass').focusout(function(){
            var oldPass = $('#oldPass').val();
            var u_id = $('#userid').val();
            console.log(u_id);
            $.ajax({
            url:'<?=base_url()?>Login/checkoldPass',
            data:{'u_id':u_id,'oldPass':oldPass},
            type:'post',
            success:function(res){
                if(res == 0){
                    alert('Password not match!');
                    $('#oldPass').val('');
                }
              }
          });
        });
        $('#confirmPass').focusout(function(){
          var pass = $('#pass').val();
          var confirm = $('#confirmPass').val();
          if (confirm != pass) {
            alert('Password not match!');
            $('#confirmPass').val('');
          }
        });
    });
</script>