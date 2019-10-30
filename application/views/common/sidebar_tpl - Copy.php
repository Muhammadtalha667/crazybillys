  <!--sidebar start-->
 <?php
 error_reporting(1); 
    $method = $this->router->fetch_method();
    $controller = $this->router->fetch_class();
    $session = $this->session->userdata('U_SESS_DATA');
    $this->session_role = $session['role'];
    $selected_study = $this->session->userdata('SELECTED_STUDY');
    $sess_zero_index = $selected_study['project_id']; 
    $study = $this->session->userdata('STUDY');
    $CI =& get_instance();
    $CI->load->model('UserModel');
    $CI->load->model('PreferenceModel');
    $CI->load->model('QueryModel');
    $CI->load->model('GeneralModel');
    $CI->load->model('AclModel');
    $PermissionsList = $CI->AclModel->PermissionList();
    $forms_to_load = $CI->PreferenceModel->get_value('study_grading_forms',$this->project);
    $forms_to_load = explode(',',$forms_to_load);
    // get oirrc id
    $where_project = array('project_id' => $sess_zero_index);
    $project_oirrc_id = $CI->GeneralModel->get_column('project',$where_project,'oirrc_id');

    $where = array('is_read' => 'no','StudyI_ID'=>$project_oirrc_id);
    // get total unreaded transmission 
    $transmission_count = $CI->PreferenceModel->get('transmissions',$where);
    $total_transmission_Unread = sizeof($transmission_count);
    // get total unread queries
    if($this->session_role =='5' || $this->session_role=='7' || $this->session_role=='8'){
   // $queries_count = $CI->PreferenceModel->get('queries',$where,'query_id');
    $total_quries_Unread = $CI->QueryModel->commemtsPM();} else 
    {
      $total_quries_Unread = $CI->QueryModel->UnreadComments(); 
    }
?>  
 <aside>
  <div id="sidebar"  class="nav-collapse ">
    <ul class="sidebar-menu" id="nav-accordion">
      <?php if($session['role'] =='7'){ ?>
      <li class="sub-menu">
        <a href="<?=base_url()?>ProjectManager" class="<?php if($method =='index'){ echo 'active'; }else{} ?>">
          <i class="fa fa-dashboard"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <?php } else if($session['role'] =='5'){ ?>
      <li class="sub-menu">
        <a href="<?=base_url()?>qco" class="<?php if($method =='index'){ echo 'active'; }else{} ?>">
          <i class="fa fa-dashboard"></i>
          <span>Dashboard</span>
        </a>
      </li> 
      <?php } else if($session['role'] =='4'){ ?>
      <li class="sub-menu">
        <a href="<?=base_url()?>Adjudicator" class="<?php if($method =='index'){ echo 'active'; }else{} ?>">
          <i class="fa fa-dashboard"></i>
          <span>Dashboard</span>
        </a>
      </li> <?php } else if($session['role'] =='8'){ ?>
      <li class="sub-menu">
        <a href="<?=base_url()?>Guest" class="<?php if($method =='index'){ echo 'active'; }else{} ?>">
          <i class="fa fa-dashboard"></i>
          <span>Dashboard</span>
        </a>
      </li> <?php } else {?>
    <li>
        <a href="<?=base_url()?>Admin" class="<?php if($method =='index'){ echo 'active'; }else{} ?>">
          <i class="fa fa-dashboard"></i>
          <span>Dashboard</span>
        </a>
    </li>
    <?php  }?>

      <?php if($session['role'] =='1' || $session['role'] =='7'){ ?>   
      <li class="sub-menu dcjq-parent-li"> 
        <a href="javascript:;" class="dcjq-parent <?php if( $controller=='PrincipalInvestigators' || $controller=='coordinators' || $controller =='Site' || $controller=='photographers' || $controller=='devices' || $controller=='otherstaff'|| $controller=='assignSite'){ echo 'active'; }else{} ?>">
          <i class="fa fa-th"></i><span>Sites Management</span><span class="dcjq-icon"></span>
        </a>
        <ul class="sub" style="display:none;">
          <li> 
            <a href="<?=base_url()?>PrincipalInvestigators" class="<?php if($controller =='PrincipalInvestigators'){ echo 'active'; }else{} ?>"> <i class="fa fa-bar-chart-o"></i> <span>Principal Investigators</span> 
            </a> 
          </li>
          <li> 
            <a href="<?=base_url()?>coordinators" class="<?php if($controller =='coordinators'){ echo 'active'; }else{} ?>"> 
              <i class="fa fa-bar-chart-o"></i> <span>Coordinators</span>
            </a> 
          </li>
          
          <?php if($session['role'] == '7'){ ?>
          <li> <a href="<?=base_url()?>otherstaff" class="<?php if($controller =='otherstaff'){ echo 'active'; }else{} ?>"> <i class="fa fa-bar-chart-o"></i> <span>Other Staff</span> </a> </li>
          <li> <a href="<?=base_url()?>photographers" class="<?php if($controller =='photographers'){ echo 'active'; }else{} ?>"> <i class="fa fa-bar-chart-o"></i> <span>Photographers</span> </a> </li>
          <li> <a href="<?=base_url()?>devices" class="<?php if($controller =='devices'){ echo 'active'; }else{} ?>"> <i class="fa fa-bar-chart-o"></i> <span>Devices</span> </a> </li>
          <?php } ?>
          <li> 
            <a href="<?=base_url()?>Site/Sites" class="<?php if($controller =='Site' && $method == "Sites"){ echo 'active'; }else{} ?>">
              <i class="fa fa-plus-square"></i> <span>Sites</span>
            </a>
          </li>
           <li> 
            <a href="<?=base_url()?>Site/assignSite" class="<?php if($controller =='Site' && $method == "assignSite"){ echo 'active'; }else{} ?>">
              <i class="fa fa-plus-square"></i> <span>Assign Sites</span>
            </a>
          </li>    
        </ul>
      </li> 
      <?php } ?>

      <?php if($session['role'] == '1'){ ?>   
      <li class="sub-menu dcjq-parent-li"> 
        <a href="javascript:;" class="dcjq-parent <?php if(($controller=='Site' && $method == 'assignSite') || $controller=='projects' || $controller=='Section' || $controller=='Studies' || $controller=='Visits' || $controller=='preferences' ){ echo 'active'; }else{} ?>">
          <i class="fa fa-th"></i><span>Build/Edit Study</span><span class="dcjq-icon"></span>
        </a>
        <ul class="sub" style="display:none;">
          <li> 
            <a href="<?=base_url()?>Studies" class="<?php if($method =='projects'){ echo 'active'; }else{} ?>">
           <i class="fa fa-tasks"></i> <span>Create/Edit Study</span> 
        </a> 
      </li>
      <li class="sub-menu dcjq-parent-li"> 
        <a href="javascript:;" class="dcjq-parent <?php if($controller =='Section' ){ echo 'active'; }else{} ?>">
            <i class="fa fa-th"></i><span>Form Management</span><span class="dcjq-icon"></span>
          </a>
        <ul class="sub" style="display:none;">
          <li style="display: none;">
            <a href="<?=base_url()?>Section/forms" class="<?php if($method =='forms'){ echo 'active'; }else{} ?>">
              <i class="fa fa-indent"></i>
              <span>Manage Form</span>
            </a>
          </li>
          <li>
            <a href="<?=base_url()?>Section/sectionQuestion" class="<?php if($method =='sectionQuestion'){ echo 'active'; }else{} ?>">
              <i class="fa fa-minus-square-o"></i>
              <span>Manage Section</span>
            </a>
          </li>
          <li>
            <a href="<?=base_url()?>Section/QuestionDescription" class="<?php if($method =='QuestionDescription'){ echo 'active'; }else{} ?>">
              <i class="fa fa-question-circle"></i>
              <span>Manage Question</span>
            </a>
          </li>
        </ul>
      </li>
      <li>
        <a href="<?=base_url()?>Visits/main" class="<?php if($method =='main'){ echo 'active'; }else{} ?>">
          <i class="fa fa-moon-o"></i>
          <span>Study Schedule</span>
        </a>
      </li>
      <li> 
        <a href="<?=base_url()?>Site/assignSite" class="<?php if($controller =='Site' && $method == "assignSite"){ echo 'active'; }else{} ?>">
          <i class="fa fa-plus-square"></i> <span>Assign Sites</span>
        </a>
      </li>
      <!-- preferences here -->
      <li> 
        <a href="<?=base_url()?>preferences" class="<?php if($controller =='preferences'){ echo 'active'; }else{} ?>">
        <i class="fa fa-crop"></i> <span>Study/Preferences</span> </a>
      </li>
      
      
              
        </ul>
      </li>
      
      <li class="sub-menu dcjq-parent-li">
        <a href="javascript:;" class="<?php if($method =='adminUser' || $method =='Role' || $method =='Modules' || $method =='Permissions'){ echo 'active'; }?> dcjq-parent ">
          <i class="fa fa-users"></i><span>Users Management</span><span class="dcjq-icon"></span>
        </a>
        <ul class="sub" style="display:none;">
          <li class="sub-menu">
            <a href="<?=base_url()?>Admin/adminUser" class="<?php if($method =='adminUser'){ echo 'active'; }else{} ?>">
              <i class="fa fa-users"></i>
              <span>Users</span>
            </a>
          </li>
          <li>
            <a href="<?=base_url()?>Admin/Role" class="<?php if($method =='Role'){ echo 'active'; }else{} ?>">
              <i class="fa fa-check-square"></i>
              <span>Role</span>
            </a>
          </li>
           <li class="sub-menu">
            <a href="<?=base_url()?>Acl/Modules" class="<?php if($method =='modules'){ echo 'active'; }else{} ?>">
              <i class="fa fa-users"></i>
              <span>Modules</span>
            </a>
          </li>
          <li>
            <a href="<?=base_url()?>Acl/Permissions" class="<?php if($method =='Permissions'){ echo 'active'; }else{} ?>">
              <i class="fa fa-check-square"></i>
              <span>Permissions</span>
            </a>
          </li>
          
        </ul>
      </li>
    
      <?php } ?>
      <!-- Project Manager  -->
      <?php if($session['role'] =='7'){ ?>
        
      <li class="sub-menu">
        <a href="<?=base_url()?>Subject/Subject" class="<?php if($method =='Subject'){ echo 'active'; }else{} ?>">
          <i class="fa fa-hospital-o"></i>
          <span>Subject Management</span>
        </a>
      </li>
 
        <li class="sub-menu">
          <a href="javascript:;" class="dcjq-parent <?php if($controller =='xml' || $method =='main_query' || $controller =='Qco' ){ echo "active"; }else{} ?>">
            <i class="fa fa-sitemap"></i>
              <span>Quality Control</span>
                  </a>
                  <ul class="sub">
                      <li class="sub-menu">
                          <a  href="javascript:;" class="<?php if($controller =='xml' ){ echo "active"; }else{} ?>" >Tramsmissions <?php if($total_transmission_Unread>0){?>
                             <span class="badge badge-success" style="margin-left: 10px; background: red;"><?=$total_transmission_Unread;?></span><?php }?></a>
                              <ul class="sub">
                                  <li> <a href="<?=base_url()?>xml/index" class="<?php if($method =='index' && $controller =='xml'){ echo 'active'; }else{} ?>">Update List</a></li>
                                  <li><a href="<?=base_url()?>xml/list_transmission" class="<?php if($method =='main' && $controller =='XML'){ echo 'active'; } else {} ?>">Process List<span class="badge badge-success" style="margin-left: 10px; background: red;"><?php if($total_transmission_Unread>0){echo $total_transmission_Unread;}?></span> </a></li>
                  </ul>
                      </li>
                      <li>
                        <a href="<?=base_url()?>Qco/main" class="<?php if($method =='main'){ echo 'active'; }else{} ?>"> QC List
                        </a>
                      </li>
                      <li>
                        <a href="<?=base_url()?>Qco/WorkList" class="<?php if($method =='WorkList'){ echo 'active'; }else{} ?>"> Work List
                        </a>
                      </li>
                     <li> <a href="<?=base_url()?>Query/main_query" class="<?php if($method =='main_query'){ echo 'active'; }else{} ?>">Query Managment<?php if($total_quries_Unread>0){?><span class="badge badge-success" style="margin-left: 10px; background: red;"><?=$total_quries_Unread;?></span> <?php } ?></a></li>
                      </ul>
                  </li>

        <li> <a href="<?=base_url()?>ProjectManager/visitReport" class="<?php if($method =='visitReport'){ echo 'active'; }else{} ?>"> <i class="fa fa-bar-chart-o"></i> <span>Grading Status</span> </a> </li>
        <li>

        <a href="<?=base_url()?>ProjectManager/finalData" class="<?php if($method =='finalData'){ echo 'active'; }else{} ?>">
            <i class="fa fa-bar-chart-o"></i>
            <span>Data Sets</span>
        </a>
      </li>
      <!-- <li>
        <a href="<?=base_url()?>ProjectManager/activities" class="<?php if($method =='activities'){ echo 'active'; }else{} ?>">
            <i class="fa fa-bar-chart-o"></i>
            <span>Activity Log</span>
        </a>
      </li> -->
      <?php } ?>
      <?php if($session['role'] =='5'){ ?>
      <li class="sub-menu">
        <a href="<?=base_url()?>Qco/main" class="<?php if($method =='main'){ echo 'active'; }else{} ?>">
          <i class="fa fa-moon-o"></i>
          <span>Qco</span>
        </a>
      </li>
        <li> 
        <a href="<?=base_url()?>Query/main_query" class="<?php if($method =='main_query'){ echo 'active'; }else{} ?>"> 
          <i class="fa fa-tasks"></i> <span>Query</span> <span>Manage </span><?php if($total_quries_Unread>0){?><span class="badge badge-success" style="margin-left: 10px; background: red;"><?=$total_quries_Unread;?></span> <?php } ?>
        </a>
      </li> 
      <?php } ?>
      <?php if($session['role'] =='2'){ ?>
      <li class="sub-menu">
        <a href="<?=base_url()?>Grader" class="<?php if($method =='grader'){ echo 'active'; }else{} ?>">
          <i class="fa fa-moon-o"></i>
          <span>Grading Forms </span>
        </a>
      </li>
      <li class="sub-menu">
        <a href="<?=base_url()?>Grader/cfp_details" class="<?php if($method =='cfp_details'){ echo 'active'; }else{} ?>">
          <i class="fa fa-bars"></i>
          <span>CFP Data</span>
        </a>
      </li>
      <li class="sub-menu">
        <a href="<?=base_url()?>Grader/oct_details" class="<?php if($method =='oct_details'){ echo 'active'; }else{} ?>">
          <i class="fa fa-bars"></i>
          <span>OCT Data</span>
        </a>
      </li>
       <?php if(in_array('grader_fa',$forms_to_load)){ ?>
        <li class="sub-menu">
        <a href="<?=base_url()?>Grader/fa_details" class="<?php if($method =='fa_details'){ echo 'active'; }else{} ?>">
          <i class="fa fa-bars"></i>
          <span>FA Data</span>
        </a>
      </li>
      <?php }
         if(in_array('grader_octa',$forms_to_load)){ ?>
        <li class="sub-menu">
        <a href="<?=base_url()?>Grader/octa_details" class="<?php if($method =='octa_details'){ echo 'active'; }else{} ?>">
          <i class="fa fa-bars"></i>
          <span>OCTA Data</span>
        </a>
      </li>

      <?php } ?>
      <li> 
        <a href="<?=base_url()?>Query/main_query" class="<?php if($method =='main_query'){ echo 'active'; }else{} ?>"> 
          <i class="fa fa-tasks"></i> <span>Adjudicator's</span> <span>Feedback </span><?php if($total_quries_Unread>0){?><span class="badge badge-success" style="margin-left: 10px; background: red;"><?=$total_quries_Unread;?></span> <?php } ?>
        </a>
      </li> 
       <li class="sub-menu">
        <a href="<?=base_url()?>Grader/WorkList" class="<?php if($method =='WorkList'){ echo 'active'; }else{} ?>">
          <i class="fa fa-cog"></i>
          <span>WorkList</span>
        </a>
      </li> 
      <?php   }
         
        ?>
      <!--Grader menu end-->
      <!--Setting menu start-->
      <?php
        if (!empty($permission_lists)){
            
         if (in_array("Query", $permission_lists)) 
         {
        ?>
      <?php }
        } ?>
       <?php if($session['role'] =='4'){ ?>
      <li class="sub-menu">
        <a href="<?=base_url()?>Adjudicator/Main" class="<?php if($method =='main'){ echo 'active'; }else{} ?>">
          <i class="fa fa-moon-o"></i>
          <span>Adjudication List </span>
        </a>
      </li>
    <li class="sub-menu">
        <a href="<?=base_url()?>Adjudicator/WorkList" class="<?php if($method =='WorkList'){ echo 'active'; }else{} ?>">
          <i class="fa fa-cog"></i>
          <span>WorkList</span>
        </a>
      </li> 
      <!-- <li class="sub-menu">
        <a href="<?=base_url()?>Adjudicator/VerificationDetails" class="<?php if($method =='VerificationDetails'){ echo 'active'; }else{} ?>">
          <i class="fa fa-cog"></i>
          <span>Reverified Data</span>
        </a>
      </li> -->
       <li> 
        <a href="<?=base_url()?>Query/main_query" class="<?php if($method =='main_query'){ echo 'active'; }else{} ?>"> 
          <i class="fa fa-tasks"></i> <span>Graders</span> <span>Feedback </span><?php if($total_quries_Unread>0){?><span class="badge badge-success" style="margin-left: 10px; background: red;"><?=$total_quries_Unread;?></span> <?php } ?>
        </a>
      </li> 
     
      <?php } ?>
    
      <li>   
        <a href="<?=base_url()?>Login/changePass/<?php echo $session['userId'] ?>">
            <i class="fa fa-user"></i>
            <span>Change Password</span>
        </a>
      </li>
      <li>   
        <a href="<?=base_url()?>Login/logout">
            <i class="fa fa-key"></i>
            <span>Log Out</span>
        </a>
      </li>
      <!-- dynamic menu generation -->
        <?php if($session['role'] =='1'){ 
          foreach($session['permissions'] as $value){
            
           if($value['parent_menu']==0 && $value['controller']=='' && $value['action']==''){ ?>
            <li class="sub-menu dcjq-parent-li">
              <a href="javascript:;" class="<?php if($method =='Permissions'){ echo 'active'; }?> dcjq-parent ">
                <i class="fa <?php echo $value['icon']; ?>"></i><span><?php echo $value['name']; ?></span><span class="dcjq-icon"></span>
              </a>
              <ul class="sub" style="display:none;">
                <?php 
                  foreach($session['permissions'] as $sub_menu){
                    if($sub_menu['parent_menu']!=0 && $sub_menu['parent_menu']==$value['id']){

                          if($sub_menu['controller']=='' && $sub_menu['action']==''){ ?> 
                          <!-- here -->
                           <li class="sub-menu dcjq-parent-li"> 
                              <a href="javascript:;" class="dcjq-parent <?php if($controller =='Section' ){ echo 'active'; }else{} ?>">
                                  <i class="fa <?php echo $sub_menu['icon']; ?>"></i><span><?php echo $sub_menu['name']; ?></span><span class="dcjq-icon"></span>
                                </a>
                              <ul class="sub" style="display:none;">
                                <?php
                                  foreach($session['permissions'] as $child){ 
                                  if($child['parent_menu']!=0 && $child['parent_menu']==$sub_menu['id']){
                                    ?>
                                <li>
                                  <a href="<?=base_url()?><?php echo $child['controller']?>/<?php echo $child['action']?>" class="<?php if($method == $child['action']){ echo 'active'; }else{} ?>">
                                    <i class="fa <?php echo $child['icon']; ?>"></i>
                                    <span><?php echo $child['name']; ?></span>
                                  </a>
                                </li>
                                <?php 
                              } } ?>
                              </ul>
                            </li>
                          <?php }else{ ?>
                          <li class="sub-menu">
                            <a href="<?=base_url()?><?php echo $sub_menu['controller']?>/<?php echo $sub_menu['action']?>" class="<?php if($method ==$sub_menu['action'] ){ echo 'active'; }else{} ?>">
                              <i class="fa <?php echo $sub_menu['icon']; ?>"></i>
                              <span><?php echo $sub_menu['name']; ?></span>
                            </a>
                          </li>
                        <?php } 
                      }
              } ?>
              </ul>
            </li>
           <?php }else if($value['parent_menu']==0 && $value['controller']!=''){?>
                  <li class="sub-menu dcjq-parent-li">
              <a href="<?php echo base_url();?><?php echo $value['controller']?>/<?php echo $value['action']?>" class="<?php if($method =='Permissions'){ echo 'active'; }?> dcjq-parent ">
                <i class="fa <?php echo $value['icon']; ?>"></i><span><?php echo $value['name']; ?></span>
              </a>
            </li>
           <?php } ?>
        <?php }  } ?>  
      <!-- dynamic menu generation -->
    </ul>
<!-- sidebar menu end-->
  </div>
</aside>
 <!--sidebar end--> 
<script type="text/javascript">
 $('#study').on('change', function(){
    var study_id = $('#study').val();
    $.ajax({
    url:'<?=base_url()?>ProjectManager/changeStudy',
    data:{'study_id':study_id},
    type:'post',
    success:function(res){
        window.location.reload();
      }
    });
 });
</script>          