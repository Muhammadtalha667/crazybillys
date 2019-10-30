<?php $method = $this->router->fetch_method(); ?>
<section id="main-content">
  <section class="wrapper">
    <!-- page start-->
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
            <i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
          </header>
        </section>
      </div>
    </div>
    <div class="row state-overview">
      <div class="col-lg-3 col-sm-6">
        <section class="panel">
          <a href="<?=base_url()?>Admin/adminUser" class="<?php if($method =='adminUser'){ echo 'active'; }else{} ?>">
            <div class="symbol terques" style="">
              <i class="fa fa-users"></i>
            </div>
            <div class="value">
              <h3>Users</h3>
            </div>
          </a>
        </section>
      </div>
      <div class="col-lg-3 col-sm-6">
        <section class="panel">
          <a href="#" class="<?php if($method =='Role'){ echo 'active'; }else{} ?>">
            <div class="symbol" style="background-color: #a9d86e; ">
              <i class="fa fa-check-square"></i>
            </div>
            <div class="value">
              <h3>Categories</h3>
            </div>
          </a>
        </section>
      </div>
      <div class="col-lg-3 col-sm-6">
        <section class="panel">
          <a href="#" class="<?php if($method =='Site'){ echo 'active'; }else{} ?>">
            <div class="symbol red" style="">
              <i class="fa fa-plus-square"></i>
            </div>
            <div class="value">
              <h3>Sub-Cate</h3>
            </div>
          </a>
        </section>
      </div>
      <div class="col-lg-3">
        <section class="panel">
          <a href="#" class="<?php if($method =='index'){ echo 'active'; }else{} ?>">
            <div class="symbol" style="background-color: #2e8f94; ">
              <i class="fa fa-tasks"></i>
            </div>
            <div class="value">
              <h3>Products</h3>
            </div>
          </a>
        </section>
      </div>
    </div>
  </section>
</section>