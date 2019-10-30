<!--sidebar start-->
<?php
$method = $this->router->fetch_method();
$controller = $this->router->fetch_class();
?>
<aside>
  <div id="sidebar"  class="nav-collapse ">
    <ul class="sidebar-menu" id="nav-accordion">
      <li>
        <a href="<?=base_url()?>Admin" class="<?php if($method =='index'){ echo 'active'; }else{} ?>">
          <i class="fa fa-dashboard"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li>
        <a href="<?=base_url()?>Products/Main" class="<?php if($method =='Products'){ echo 'active'; }else{} ?>">
          <i class="fa fa-th"></i>
          <span>Products</span>
        </a>
      </li>
      <li class="sub-menu dcjq-parent-li">
        <a href="javascript:;" class="dcjq-parent <?php if($controller=='Categories'){ echo 'active'; }else{} ?>">
          <i class="fa fa-list-alt"></i><span>Categories</span><span class="dcjq-icon"></span>
        </a>
        <ul class="sub" style="display:none;">
          <li>
            <a href="<?=base_url()?>Categories/Main" class="<?php if($method =='Main'){ echo 'active'; }else{} ?>">
              <i class="fa fa-th-list"></i> <span>Main Category</span>
            </a>
          </li>
          <li>
            <a href="<?=base_url()?>Categories/subCategory" class="<?php if($method =='subCategory'){ echo 'active'; }else{} ?>">
              <i class="fa fa-th-list"></i> <span>Sub Category</span>
            </a>
          </li>
        </ul>
      </li>
      <li>
        <a href="<?=base_url()?>Gallery/Main" class="<?php if($method =='Main'){ echo 'active'; }else{} ?>">
          <i class="fa fa-picture-o"></i>
          <span>Gallery</span>
        </a>
      </li>
      <li>
        <a href="<?=base_url()?>Admin/events" class="<?php if($method =='events'){ echo 'active'; }else{} ?>">
          <i class="fa fa-th-list"></i>
          <span>Events</span>
        </a>
      </li>
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
      
    </ul>
    <!-- sidebar menu end-->
  </div>
</aside>
<!--sidebar end-->