<?php
    $session = $this->session->userdata('U_SESS_DATA');
    $selected_study = $this->session->userdata('SELECTED_STUDY');
    $sess_zero_index = $selected_study['project_id'];
    $study = $this->session->userdata('STUDY');
    $CI =& get_instance();
    $CI->load->model('UserModel');
    $CI->load->model('PreferenceModel');
?>
<section id="main-content">
  <section class="wrapper">
    <!-- page start-->
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
            <span style="display:inline-block;">
             Preferences Details
            </span>
            &nbsp;&nbsp;&nbsp;&nbsp; 
            <span style="display:inline-block;">  
              <select class="form-control" id="Preferences" style="color: #4a4a4a !important;height: 37px;width: 300px;">
                <?php for ($i=0; $i < count($study); $i++) { ?>
                <?php $name = $CI->UserModel->get_project_name($study[$i]); ?>  
                <option value="<?php echo $study[$i]; ?>" 
                  <?php if($study[$i] == $sess_zero_index){ echo "selected"; } ?> > 
                  <?php echo $name['project_title']; ?>
                </option>
                <?php } ?>
              </select>
            </span>
          </header>
        </section>
      </div>
      <?php if($this->session->flashdata("update") != ''){ ?>
      <div class="col-lg-12 message-box">
        <section class="panel panel-success">
          <header class="panel-heading">
            <p> <?php echo $this->session->flashdata("update"); ?> </p>
          </header>
        </section>
      </div>
      <?php } ?>
      <div class="col-lg-12">
         <div class="panel panel-primary">
          <div class="panel-heading">Update Preferences </div>
          <div class="panel-body">
              <form action="<?=base_url()?>Preferences/insertPreferences" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" id = "userForm" autocomplete="off">
                <div class="modal-body">
                  <div class="panel-body">
                      <div class="form-group">
                        <div class="col-sm-6">
                          <label>
                            Reverify After
                          </label>
                        </div>
                        <div class="col-sm-6">
                          <input type="text" name="reverify_after" class="form-control" value="<?php echo $reverify_after; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-6">
                          <label>
                            Reverify Percent
                          </label>
                        </div>
                        <div class="col-sm-6">
                          <input type="text" name="reverify_percent" class="form-control" value="<?php echo $reverify_percent; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-6">
                          <label>
                            Copyright Text
                          </label>
                        </div>
                        <div class="col-sm-6">
                          <input type="text" name="no_of_graders" class="form-control" value="<?php echo $no_of_graders; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-6">
                          <label>
                            Slack channel
                          </label>
                        </div>
                        <div class="col-sm-6">
                          <input type="text" name="slack_channel" class="form-control" value="<?php echo $slack_channel; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-6">
                          <label>
                            Gmail Email
                          </label>
                        </div>
                        <div class="col-sm-6">
                          <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-6">
                          <label>
                            Reply Email
                          </label>
                        </div>
                        <div class="col-sm-6">
                          <input type="text" name="reply_email" class="form-control" value="<?php echo $reply_email; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-6">
                          <label>
                            Gmail Pasword
                          </label>
                        </div>
                        <div class="col-sm-6">
                          <input type="Password" name="password" class="form-control" value="<?php echo $password; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-6">
                          <label>
                            Study Type
                          </label>
                        </div>
                        <div class="col-sm-6">
                          <select name="study_type" id="study_type" class="form-control" onchange="set_study_type(this.value)">
                            <option value="normal" <?php if($study_type =='normal') echo "selected"; ?>>Normal</option>
                            <option value="dependent_on_enrollment_data" <?php if($study_type =='dependent_on_enrollment_data') echo "selected"; ?>>Dependent on enroll</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-6">
                          <label>
                            Study eye
                          </label>
                        </div>
                        <div class="col-sm-6">
                          <select name="study_eye" id="study_eye" class="form-control">
                            <option value="inactive" <?php if($study_eye =='inactive') echo "selected"; ?>>inactive</option>
                            <option value="active" <?php if($study_eye =='active') echo "selected"; ?>>Active</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group hide_diseases_visit">
                        <div class="col-sm-6">
                          <label>
                            Study Diseases
                          </label>
                        </div>
                        <div class="col-sm-6">
                          <textarea name="study_diseases" id="study_diseases" rows="2" class="form-control"><?php echo $study_diseases; ?></textarea>
                        </div>
                      </div>
                      <div class="form-group hide_diseases_visit">
                        <div class="col-sm-6">
                          <label>
                            Qc Ou Visits
                          </label>
                        </div>
                        <div class="col-sm-6">
                          <textarea name="QC_OU_visits" id="QC_OU_visits" rows="2" class="form-control"><?php echo $QC_OU_visits; ?></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-6">
                          <label>
                            Cc Emails To
                          </label>
                        </div>
                        <div class="col-sm-6">
                          <textarea name="cc_emails" id="cc_emails" rows="2" class="form-control"><?php echo $cc_emails; ?></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-6">
                          <label>
                            QCO Form Types
                          </label>
                        </div>
                        <div class="col-sm-6">
                          <?php $qco_types=explode(',', $qco_forms);
                           $grader_types=explode(',', $graders_forms);
                          ?>
                        CFP Form <input type="checkbox" name="study_forms[]" value="qco_cfp" <?php if(in_array('qco_cfp',$qco_types)){echo "checked";}?>>
                        OCT Form <input type="checkbox" name="study_forms[]" value="qco_oct" <?php if(in_array('qco_oct',$qco_types)){echo "checked";}?>>
                        FA Form <input type="checkbox" name="study_forms[]" value="qco_fa" <?php if(in_array('qco_fa',$qco_types)){echo "checked";}?>>
                        OCTA Form <input type="checkbox" name="study_forms[]" value="qco_octa" <?php if(in_array('qco_octa',$qco_types)){echo "checked";}?>>
                        
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-6">
                          <label>
                            Grader Form Types
                          </label>
                        </div>
                        <div class="col-sm-6">
                        CFP Form <input type="checkbox" name="study_grading_forms[]" value="grader_cfp" <?php if(in_array('grader_cfp',$grader_types)){echo "checked";}?>>
                        OCT Form <input type="checkbox" name="study_grading_forms[]" value="grader_oct" <?php if(in_array('grader_oct',$grader_types)){echo "checked";}?>>
                        FA Form <input type="checkbox" name="study_grading_forms[]" value="grader_fa" <?php if(in_array('grader_fa',$grader_types)){echo "checked";}?>>
                        OCTA Form <input type="checkbox" name="study_grading_forms[]" value="grader_octa" <?php if(in_array('grader_octa',$grader_types)){echo "checked";}?>>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-success" type="submit"> Update Preferences</button>
                </div>
              </form>
          </div>
        </div>
      </div>
    </div>  
</section>
</section>
<script type="text/javascript">
  	function set_study_type(studyType){
			if(studyType =='normal'){
			  $('.hide_diseases_visit').hide();
			}
			if(studyType =='dependent_on_enrollment_data'){
			  $('.hide_diseases_visit').show();
			}
	}
$(document).ready(function(){
  var studyType = $('#study_preferences').attr("data-study_type");
  if(studyType =='normal'){
    $('.hide_diseases_visit').hide();
  }
  if(studyType =='dependent_on_enrollment_data'){
    $('.hide_diseases_visit').show();
  }
  

  //////
  $('#Preferences').on('change', function(){
    var study_id = $('#Preferences').val();
    $.ajax({
    url:'<?=base_url()?>ProjectManager/changeStudy',
    data:{'study_id':study_id},
    type:'post',
    success:function(res){
        window.location.reload();
      }
    });
  });
});
</script>