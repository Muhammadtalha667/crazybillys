<section id="main-content">
  <section class="wrapper">
    <!-- page start-->
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
            Admin User Details
          </header>
        </section>
      </div>
      <?php if($this->session->flashdata("email_sent") != '' || $this->session->flashdata("email") !=''){ ?>
      <div class="col-lg-12 message-box">
        <section class="panel panel-success">
          <header class="panel-heading">
            <p> <?php echo $this->session->flashdata("email_sent"); ?> </p>
            <p> <?php echo $this->session->flashdata("email"); ?></p>
          </header>
        </section>
      </div>
      <?php } ?>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <span style="display: inline-block;">
          <input type="text" name="email" class="form-control" id="search_email" placeholder="Search..." style="border: 1px solid #363940;border-radius: 0px;width: 220px;height: 30px;" autocomplete="off">
        </span>
      </div>
    </div>
    <div class="row" style="margin-top: 5px;">
      <div class="col-lg-12">
        <div id="user_grid"></div>
      </div>
    </div>
  </section>
</section>
<!-- Model Html start -->
<div class="modal fade" id="ASSIGN_USER_MODAL" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" autocomplete='off'>
  <div class="modal-dialog modal-lg" >
    <div class="modal-content" style="margin-right: 200px; margin-left: 200px;">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
        <h4 class="modal-title">Add New user</h4>
      </div>
      <form action="<?=base_url()?>Admin/insertAdminUser" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" id = "userForm">
        <div class="modal-body">
          <div class="panel-body">
            <input type="hidden" name="user_id" id="user_id">
            <div class="form-group">
              <label for="Name" class="col-sm-3 control-label">User Name</label>
              <div class="col-sm-9">
                <input type="text" name="name" id="name" class="form-control" required>
              </div>
            </div>
            <div class="form-group">
              <label for="Mail" class="col-sm-3 control-label">User Email</label>
              <div class="col-sm-9">
                <input type="Email" name="email" id="email" class="form-control" required>
              </div>
            </div>
            <div style="background-color:#00A8B3;">
              <h4 style="color: white; text-align: center; padding-top: 5px; padding-bottom: 5px;">
            APPS / Role<h4></div>
            <div class="form-group">
              <!--  <label for="Mail" class="col-sm-3 control-label">Apps</label> -->
              <div class="col-sm-12">
                <?php foreach($apps as $value) {
                if($value['id']!=1){ ?>
                <div>
                  <input type="checkbox" name="user_apps[]" value="<?=$value['id'];?>" class="apps_<?php echo $value['id']; ?>">
                  <label class="form-check-label"><?= $value['name'];?></label>
                  <select style="width: 50%; display: inline; float: right;" class="form-control apps_role_<?php echo $value['id']; ?>" name="apps_role[]">
                    <option value="">Select Role</option>
                    <?php foreach($appsRoles as $value_roles) {
                    if($value_roles['app_id']==$value['id']){
                    ?>
                    <option value="<?php echo $value_roles['role_id']; ?>"><?php echo $value_roles['role_title']; ?></option>
                    <?php } }?>
                  </select>  </div><br>
                  <?php } } ?>
                  
                </div>
              </div>
              
              <div style="background-color:#00A8B3;">
                <h4 style="color: white; text-align: center; padding-top: 5px; padding-bottom: 5px;">
              CMS: Studies / Role<h4></div>
              <div class="form-group project">
                <!--   <label for="Mail" class="col-sm-3 control-label">Project / Role</label> -->
                <div class="col-sm-12">
                  <?php foreach($project as $value) { ?>
                  <div>
                    <input type="checkbox" name="project_title[]" value="<?php echo $value['project_id']; ?>" class="projects_<?php echo $value['project_id']; ?>"> <?php echo $value['project_title']; ?>
                    <select name="role_title[]" id="role_title" class="form-control proj_role_<?php echo $value['project_id']; ?> proj_role_select" style="width: 50%; display: inline; float: right;">
                      <option value="">Select Role</option>
                      <?php foreach($role as $value) {
                      if($value['project_id']==1){ ?>?>
                      <option value="<?php echo $value['role_id']; ?>"><?php echo $value['role_title']; ?></option>
                      <?php } } ?>
                    </select></div></br>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-success" type="submit"> Save</button>
              <button data-dismiss="modal" class="btn btn-danger empty" type="button">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Model Html end -->
    <!-- Model Html start -->
    <div class="modal fade" id="VIEW_MODAL" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" autocomplete='off'>
      <div class="modal-dialog modal-lg" >
        <div class="modal-content" style="margin-right: 200px; margin-left: 200px;">
          <div class="modal-header">
            <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
            <h4 class="modal-title">View User Detail</h4>
          </div>
          <form action="" class="form-horizontal" role="form" id = "userForm">
            <div class="modal-body">
              <div class="panel-body">
                <div class="form-group">
                  <label for="Name" class="col-sm-3 control-label">User Name</label>
                  <div class="col-sm-9">
                    <input type="text" id="name_u" class="form-control" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="Mail" class="col-sm-3 control-label">User Email</label>
                  <div class="col-sm-9">
                    <input type="Email" name="email" id="email_u" class="form-control" readonly>
                  </div>
                </div>
                <div style="background-color:#00A8B3;">
                  <h4 style="color: white; text-align: center; padding-top: 5px; padding-bottom: 5px;">
                APPS / Role<h4></div>
                <div class="form-group">
                  <!--  <label for="Mail" class="col-sm-3 control-label">Apps</label> -->
                  <div class="col-sm-12">
                    <?php foreach($apps as $value) {
                    if($value['id']!=1){ ?>
                    <div>
                      <input type="checkbox" name="user_apps[]" value="<?=$value['id'];?>" class="apps_u_<?php echo $value['id']; ?>" disabled>
                      <label class="form-check-label"><?= $value['name'];?></label>
                      <select style="width: 50%; display: inline; float: right;" class="form-control apps_role_u_<?php echo $value['id']; ?>" name="apps_role[]" disabled >
                        <option value="">Select Role</option>
                        <?php foreach($appsRoles as $value_roles) {
                        if($value_roles['app_id']==$value['id'] ){
                        ?>
                        <option value="<?php echo $value_roles['role_id']; ?>"><?php echo $value_roles['role_title']; ?></option>
                        <?php } }?>
                      </select>  </div><br>
                      <?php } } ?>
                      
                    </div>
                  </div>
                  
                  <div style="background-color:#00A8B3;">
                    <h4 style="color: white; text-align: center; padding-top: 5px; padding-bottom: 5px;">
                  CMS: Studies / Role<h4></div>
                  <div class="form-group project">
                    <!--   <label for="Mail" class="col-sm-3 control-label">Project / Role</label> -->
                    <div class="col-sm-12">
                      <?php foreach($project as $value) { ?>
                      <div>
                        <input type="checkbox" name="project_title[]" value="<?php echo $value['project_id']; ?>" class="projects_u_<?php echo $value['project_id']; ?>" disabled > <?php echo $value['project_title']; ?>
                        <select name="role_title[]" id="role_title" class="form-control proj_role_u_<?php echo $value['project_id']; ?> proj_role_select" style="width: 50%; display: inline; float: right;" disabled>
                          <option value="">Select Role</option>
                          <?php foreach($role as $value) {
                          if($value['project_id']==1){ ?>
                          <option value="<?php echo $value['role_id']; ?>"><?php echo $value['role_title']; ?></option>
                          <?php } } ?>
                        </select></div></br>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button data-dismiss="modal" class="btn btn-danger empty" type="button">Close</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- Model Html end -->
        <!-- Load Pako ZLIB library to enable PDF compression -->
        <script type="text/javascript">
        function user_list(keyword) {
        var keyword = keyword;
        $('#user_grid').kendoGrid({
        dataSource: {
        transport: {
        read: {
        url: "<?=base_url()?>Admin/getUserList",
        dataType: 'json',
        data: {
        keyword: keyword,
        }
        },
        },
        schema: {
        total: "total",
        data: "data",
        },
        pageSize: 20,
        pageSizes: true,
        serverPaging: true,
        },
        <?php rendar_access('Add','toolbar:[{ name: "Add New User" }],',''); ?>
        columns: [{
        field: 'name',
        title: 'FULL NAME',
        attributes: {
        class: "name"
        }
        },
        {
        field: 'email',
        title: 'USER EMAIL',
        attributes: {
        class: "email"
        }
        },
        {
        field: 'project_title',
        title: 'PROJECT',
        hidden:true,
        attributes: {
        class: "project_title"
        }
        },
        {
        field: 'role_title',
        title: 'ROLE',
        hidden:true,
        attributes: {
        class: "role_title"
        }
        },
        {
        field: 'apps_title',
        title: 'Apps',
        hidden:true,
        attributes: {
        class: "apps_title"
        }
        },
        {
        field: 'app_role_title',
        title: 'Apps Role',
        hidden:true,
        attributes: {
        class: "app_role_title"
        }
        },
        <?php rendar_access('Status','{field: \'user_status\',title: "PROFILE STATUS",sortable: true,width: "150px",
        template: "#if (user_status ==1) { # <button style=\"background:blue;\">BLOCK</button> # }else {# <button style=\"background:red;\">UN-BLOCK</button> #}  #", attributes: { class: "U_STATUS" } },','{field: \'user_status\',title: "PROFILE STATUS",sortable: true,width: "150px",template: "#if (user_status ==1) { # <button style=\"background:blue;\">BLOCK</button> # }else {# <button style=\"background:red;\">UN-BLOCK</button> #}  #", attributes: { class: "U_STATUS" } },'); ?>
        {
        field: 'user_status',
        title: "VIEW",
        sortable: true,
        width: "140px",
        template: "<button  class='view'>VIEW</button",
        },
        <?php rendar_access('Edit','{command: ["edit"], title: "", width: "90px"},',''); ?>
        <?php rendar_access('Delete','{command: ["destroy"], title: "", width: "110px"},',''); ?>
        {
        field: 'user_id',
        title: "",
        hidden: true,
        attributes: {
        class: "user_id"
        }
        },
        {
        field: 'role',
        title: "",
        hidden: true,
        attributes: {
        class: "role_id"
        }
        },
        {
        field: 'project_id',
        title: "",
        hidden: true,
        attributes: {
        class: "project_id"
        }
        },
        {
        field: 'apps_id',
        title: "",
        hidden: true,
        attributes: {
        class: "apps_id"
        }
        },
        {
        field: 'app_role_id',
        title: "",
        hidden: true,
        attributes: {
        class: "app_role_id"
        }
        },
        ],
        scrollable: true,
        pageable: true,
        selectable: true,
        pageable: {
        pageSizes: [30, 50,100,200],
        buttonCount: 5,
        refresh: true
        },
        });
        }
        user_list();
        ////////////////////////////////////
        $('.k-grid-AddNewUser').on('click', function() {
        //$('#userForm').find(':input').val('');
        $('#userForm').trigger("reset");
        $('#ASSIGN_USER_MODAL').modal('show');
        });
        $('#CONFIRM_PASS').focusout(function() {
        var pass = $('#PASSWORD').val();
        var confirm = $('#CONFIRM_PASS').val();
        if (confirm != pass) {
        alert('Password not match!');
        $('#CONFIRM_PASS').val('');
        }
        });
        $('body').on('click', '.k-grid-edit', function() {
        $('#userForm').trigger("reset");
        $("input[type=checkbox][name='project_title[]']").prop('checked',false);
        var row = $(this).closest('tr');
        var name = row.find('td.name').text();
        var email = row.find('td.email').text();
        var role_id = row.find('td.role_id').text();
        var project_id = row.find('td.project_id').text();
        var userType = row.find('td.user_type').text();
        var user_id = row.find('td.user_id').text();
        var appIds = row.find('td.apps_id').text();
        var appRoleIds= row.find('td.app_role_id').text();
        $('#user_id').val(user_id);
        $('#name').val(name);
        $('#email').val(email);
        $('#user_type').val(userType);
        var project_array=[];
        project_array=project_id.split(',');
        var role_array=[];
        role_array=role_id.split(',');
        var app_array=[];
        app_array=appIds.split(',');
        var apps_role_array=[];
        apps_role_array=appRoleIds.split(',');
        $.each(project_array , function(index, val) {
        $(".projects_"+val).prop('checked',true);
        $(".proj_role_"+val+"").val(role_array[index]);
        
        });
        $.each(app_array , function(index, val) {
        $(".apps_"+val).prop('checked',true);
        $(".apps_role_"+val+"").val(apps_role_array[index]);
        
        });
        $('#ASSIGN_USER_MODAL').modal('show');
        });
        $('body').on('click', '.view', function() {
        $('#userForm').trigger("reset");
        $("input[type=checkbox][name='project_title[]']").prop('checked',false);
        var row = $(this).closest('tr');
        var name = row.find('td.name').text();
        var email = row.find('td.email').text();
        var role_id = row.find('td.role_id').text();
        var project_id = row.find('td.project_id').text();
        var userType = row.find('td.user_type').text();
        var user_id = row.find('td.user_id').text();
        var appIds = row.find('td.apps_id').text();
        var appRoleIds= row.find('td.app_role_id').text();
        $('#user_id_u').val(user_id);
        $('#name_u').val(name);
        $('#email_u').val(email);
        $('#user_type_u').val(userType);
        var project_array=[];
        project_array=project_id.split(',');
        var role_array=[];
        role_array=role_id.split(',');
        var app_array=[];
        app_array=appIds.split(',');
        var apps_role_array=[];
        apps_role_array=appRoleIds.split(',');
        $.each(project_array , function(index, val) {
        $(".projects_u_"+val).prop('checked',true);
        $(".proj_role_u_"+val+"").val(role_array[index]);
        
        });
        $.each(app_array , function(index, val) {
        $(".apps_u_"+val).prop('checked',true);
        $(".apps_role_u_"+val+"").val(apps_role_array[index]);
        
        });
        $('#VIEW_MODAL').modal('show');
        });
        $('body').on('click', '.k-grid-delete', function() {
        var row = $(this).closest('tr');
        var u_id = row.find('td.user_id').text();
        if (confirm("Are you sure to delete?")) {
        $.ajax({
        url: '<?=base_url()?>Admin/deleteUser',
        data: {
        'u_id': u_id
        },
        type: 'post',
        success: function(res) {
        user_list();
        }
        })
        }
        });
        $('body').on('click', '.U_STATUS', function() {
        var row = $(this).closest('tr');
        var u_id = row.find('td.user_id').text();
        $('#mail').val(email);
        $.ajax({
        url: '<?=base_url()?>Admin/changeStatus',
        data: {
        'u_id': u_id
        },
        type: 'post',
        success: function(res) {
        // $('#APPROVEL_MODAL').modal('show');
        user_list();
        }
        });
        });
        $(document).ready(function() {
        $("#search_email").keyup(function() {
        var mailValue = $(this).val();
        user_list(mailValue);
        });
        /* $("#user_type").on('change', function(){
        var user_type = $(this).val();
        if(user_type =="dicom_user")
        {
        $(".project").hide();
        }
        else{  $(".project").show();}
        });*/
        
        });
        </script>