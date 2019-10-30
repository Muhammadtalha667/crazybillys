<!DOCTYPE html>
<!-- saved from url=(0044)http://hold.ncodeart.com/nc/l1-index-8.html# -->
<html><head>
	<title>ORRIC-CMC</title>
	<!-- FONT-ICON -->
	<link rel="stylesheet" href="<?=base_url()?>assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/themify-icons.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/pe-icon-7-stroke.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/style.css">
	<!-- LIB -->
	<link rel="stylesheet" href="<?=base_url()?>assets/css/animate.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/custom-animation.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/owl.carousel.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/sweetalert.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/magnific-popup.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/swiper.min.css">
	<!-- EFFECT -->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/partical-animation.css">
	<!-- TEMPLATE -->
	<link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/nc-grids.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/main.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/helper.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/responsive.css">
	<!-- THEME -->
	<link rel="stylesheet" href="<?=base_url()?>assets/css/default.css">
	
	<!-- CUSTOM -->
	<link rel="stylesheet" href="<?=base_url()?>assets/css/custom.css">
	<!-- FAVICONS -->
	
	<link rel="stylesheet" href="<?=base_url()?>assets/css/css" media="all"><style type="text/css">.f-1 { font-family: "Oswald"; }.f-2 { font-family: "Open Sans"; }.f-3 { font-family: "Pacifico"; }</style><link id="avast_os_ext_custom_font" href="chrome-extension://eofcbnmajmjmplflapaojjnihcjkigck/common/ui/fonts/fonts.css" rel="stylesheet" type="text/css"></head>
	<body class="nctheme-default  pace-done"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
		<div class="pace-progress-inner"></div>
	</div>
	<div class="pace-activity"></div></div>
	
	<!-- MAIN-WRAPER -->
	<div class="nc-mainwrapper">
		
		<!-- CONTENT AREA -->
		<div id="nc-main" class="nc-main bg-cover bg-cc" data-bg="<?=base_url()?>assets/img/login_BG2.png" style="background-image: url(&quot;<?=base_url()?>assets/img/login_BG2.png&quot;);">
			
			<!-- BACKGROUND OVERLAY -->
			<div class="nc-main--bgoverlay min-vh-h100 w100" data-bgcolor="rgba(0,0,0,0.3)" style="background-color: rgba(0, 0, 0, 0.3);">
				
				<!-- PARTICLE -->
				<div id="particles-js"><canvas class="particles-js-canvas-el" width="1366" height="608" style="width: 100%; height: 100%;"></canvas></div>
				<!-- PARTICLE END -->
				<!-- PAGEWRAPPER -->
				<div class="nc-main--pagewrapper nc-activeajax">
					
					
					<!-- AJAX PAGES -->
					<div id="nc-ajaxpage" class="nc-ajaxpage"><!-- PAGE -->
					<div class="nc-page min-vh-h100 w100 flex-cc animated s008 pd-tb-small fadeIn" data-animin="fadeIn|0" data-animout="fadeOut|0" data-bgcolor="rgba(0,0,0,0.7)" style="background-color: rgba(0, 0, 0, 0.7); animation-delay: 0s;">
						<div class="container">
							<div style="text-align: right;">
								<a href="<?=base_url()?>Login/logout">
									 <span  style="color: #ffffff;font-size: 12px;">Welcome! <?php echo $this->name; ?> </span>
									 <span><i class="pe-7s-power" style="color: #ffffff;font-size: 17px;font-weight: bold;"></i></span> 
								</a>	
							</div>
							<!-- TITLE -->
							<div class="nc-titlewrapper align-c typo-light mr-b-60">
								<h1 class="nc-titlewrapper--tile fs50 f-1 txt-upper animated s008 fadeInUp" data-animin="fadeInUp|0.1" data-animout="fadeOut|0.1" style="animation-delay: 0.1s;">OIRRC</h1>
								<p class="nc-titlewrapper--subtitle fs22 f-2 bold-1 op-08 mr-auto w70 animated s008 fadeInUp" data-animin="fadeInUp|0.2" data-animout="fadeOut|0.1" data-nc-md="w90 fs22" data-nc-sm="w100 fs20" style="animation-delay: 0.2s;">
									Ocular Imaging Research and Reading Center
								</p>
								</div><!-- / TITLE -->
								<!-- PAGE BODY -->
								<div class="nc-pagebody">
									<div class="flex-row">
										<?php 
											$apps = explode(',', $this->user_apps);
											foreach($acl_apps as $app){
											if(in_array($app['id'], $apps))	{
										?>

										<div class="flex-col-md-4" style="margin: 0 auto;">
											<div class="info-obj img-t g30 pd-tiny medium align-c typo-light mr-0 animated s008 fadeInUp" data-animin="fadeInUp|0.6" data-animout="fadeOut|0.1" data-bgcolor="rgba(255,255,255,0.04)" style="background-color: rgba(255, 255, 255, 0.04); animation-delay: 0.6s;">
												<div class="img txt-default"><span class="iconwrp"><a href="<?php echo base_url() ?>Apps/validate/<?php echo $app['name'];?>"><i class="<?php echo $app['app_icon']; ?>"></i></a></span></div>
												<div class="info">
													<a href="<?php echo base_url() ?>Apps/validate/<?php echo $app['name'];?>">
														<h3><?php echo $app['name'];?></h3>
														<p class="mr-0 op-08 f-2 bold-1"><?php echo $app['description'];?></p>
													</a>
												</div>
											</div>
										</div>
										<?php } 
									} ?>
									<?php
										if(!empty($this->user_cms)){ $cms_app = $cms_app[0]; ?>
											<div class="flex-col-md-4" style="margin: 0 auto;">
											<div class="info-obj img-t g30 pd-tiny medium align-c typo-light mr-0 animated s008 fadeInUp" data-animin="fadeInUp|0.6" data-animout="fadeOut|0.1" data-bgcolor="rgba(255,255,255,0.04)" style="background-color: rgba(255, 255, 255, 0.04); animation-delay: 0.6s;">
												<div class="img txt-default"><span class="iconwrp"><a href="<?php echo base_url() ?>Apps/validate/<?php echo $cms_app['name'];?>"><i class="<?php echo $cms_app['app_icon']; ?>"></i></a></span></div>
												<div class="info">
													<a href="<?php echo base_url() ?>Apps/validate/<?php echo $cms_app['name'];?>">
														<h3><?php echo $cms_app['name'];?></h3>
														<p class="mr-0 op-08 f-2 bold-1"><?php echo $cms_app['description'];?></p>
													</a>
												</div>
											</div>
										</div>

									<?php 	} ?>
									</div>
									</div><!-- / PAGE BODY -->
								</div>
								</div><!-- / PAGE-->
								</div><!-- / AJAX PAGES -->
								</div><!-- / PAGEWRAPPER -->
								</div><!-- / BACKGROUND OVERLAY -->
								<!-- PAGE OVERLAY -->
								
								</div><!-- / CONTENT AREA -->
								
								</div><!-- / MAIN-WRAPER -->
								<!-- FONT SELECTION -->
								<script>
									/* Use fonts with class name in sequence => f-1, f-2, f-3 .... */
									var fgroup = [
										'Oswald:200,300,400,500,600,700',
										'Open Sans:400,300,300italic,400italic,600,700,600italic,700italic,800,800italic',
										'Pacifico'
									];
								</script>
								<!-- TEMPLATE -->
								<script type="text/javascript" src="<?=base_url()?>assets/js/jquery-1.12.4.min.js"></script>
								<script type="text/javascript" src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
								<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.validate.min.js"></script>
								<script type="text/javascript" src="<?=base_url()?>assets/js/plugins.js"></script>
								<script type="text/javascript" src="<?=base_url()?>assets/js/swiper.jquery.min.js"></script>
								<script type="text/javascript" data-pace-options="{ &quot;ajax&quot;: true }" src="<?=base_url()?>assets/js/pace.min.js"></script>
								<script type="text/javascript" src="<?=base_url()?>assets/js/nc.js"></script>
								<!-- EFFECT -->
								<script type="text/javascript" src="<?=base_url()?>assets/js/particles.min.js"></script>
								<script type="text/javascript" src="<?=base_url()?>assets/js/partical-animation.js"></script>
							</body>
						</html>