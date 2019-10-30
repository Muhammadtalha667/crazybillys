<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset_main/style.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset_main/events.css">
<link rel='stylesheet' id='tribe-events-bootstrap-datepicker-css-css'  href='<?php echo base_url()?>asset_main/css/datepicker.css?ver=4.9.11' type='text/css' media='all' />
<link rel='stylesheet' id='tribe-events-custom-jquery-styles-css'  href='<?php echo base_url()?>asset_main/css/jquery-ui-1.8.23.custom.css?ver=4.9.11' type='text/css' media='all' />
<link rel='stylesheet' id='tribe-events-full-calendar-style-css'  href='<?php echo base_url()?>asset_main/css/tribe-events-full.min.css?ver=3.6.1' type='text/css' media='all' />
<link rel='stylesheet' id='tribe-events-calendar-style-css'  href='<?php echo base_url()?>asset_main/css/tribe-events-theme.min.css?ver=3.6.1' type='text/css' media='all' />
<link rel='stylesheet' id='tribe-events-calendar-full-mobile-style-css'  href='<?php echo base_url()?>asset_main/css/tribe-events-full-mobile.min.css?ver=3.6.1' type='text/css' media='(max-width: 768px)' />
<link rel='stylesheet' id='tribe-events-calendar-mobile-style-css'  href='<?php echo base_url()?>asset_main/css/tribe-events-theme-mobile.min.css?ver=3.6.1' type='text/css' media='(max-width: 768px)' />
<link rel='stylesheet' id='easymedia_styles-css'  href='<?php echo base_url()?>asset_main/css/frontend.css?ver=4.9.11' type='text/css' media='all' />
<script type='text/javascript' src='<?php echo base_url()?>asset_main/js/jquery.js'></script>
<script type='text/javascript' src='<?php echo base_url()?>asset_main/js/jquery-migrate.min.js'></script>
<script type='text/javascript' src='<?php echo base_url()?>asset_main/js/jquery.placeholder.min.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>asset_main/js/bootstrap-datepicker.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>asset_main/js/jquery.ba-resize.min.js'></script>
<script type='text/javascript' src='<?= base_url()?>asset_main/js/tribe-events.min.js'></script>
<script type='text/javascript' src='<?= base_url()?>asset_main/js/tribe-events-bar.min.js'></script>
<script type='text/javascript' src='<?php echo base_url()?>asset_main/js/jquery.fittext.js'></script>
<script type='text/javascript' src='<?= base_url()?>asset_main/js/mootools-core-1.4.5-min.js'></script>
<div id="main">
	<div id="page">
		<div id="text-cont">
			<div id="text" role="main">
				<div id="post-0" class="post-0 page type-page status-draft hentry">
					<div class="entry-content">
						<div id="tribe-events" class="tribe-no-js" data-live_ajax="1" data-datepicker_format="0" data-category=""><div class="tribe-events-before-html"><p><font color="Black" style="bgcolor: White"><br />
						<BODY BGCOLOR=#000000 TEXT=#FFFFFF></p>
					</div>
					<span class="tribe-events-ajax-loading">
						<img class="tribe-events-spinner-medium" src="<?= base_url();?>/images/tribe-loading.gif" alt="Loading Events" />
					</span>
					<div id="tribe-events-content-wrapper" class="tribe-clearfix"><input type="hidden" id="tribe-events-list-hash" value="">
					
					<div id="tribe-events-content" class="tribe-events-list">
						<h2 class="tribe-events-page-title">Upcoming Events</h2>
						  <table style="width: 100%;max-width: 100%;margin-bottom: 20px;border: 1px solid #ddd;">
						    <thead>
						      <tr style="border: 1px solid #ddd;">
						        <th style="border: 1px solid #ddd;text-align: left;padding: 10px;width: 40%">Address</th>
						        <th style="border: 1px solid #ddd;text-align: left;padding: 10px;width: 20%">Date</th>
						        <th style="border: 1px solid #ddd;text-align: left;padding: 10px;width: 20%">From Time</th>
						        <th style="border: 1px solid #ddd;text-align: left;padding: 10px;width: 20%">To Time</th>
						      </tr>
						    </thead>
						    <tbody>
						    <?php foreach($events as $event){?>	
						      <tr>
						        <td style="border: 1px solid #ddd;text-align: left;padding: 10px;"><?php echo $event['address'];?></td>
						        <td style="border: 1px solid #ddd;text-align: left;padding: 10px;"><?php echo $event['date'];?></td>
						        <td style="border: 1px solid #ddd;text-align: left;padding: 10px;"><?php echo date('h:i a', strtotime($event['from_time']));?></td>
						        <td style="border: 1px solid #ddd;text-align: left;padding: 10px;"><?php echo date('h:i a', strtotime($event['to_time']));?></td>
						      </tr>
						    <?php } ?>  
						    </tbody>
						  </table>
					</div>
					<div class="tribe-clear"></div>
				</div>
			</div>
		</div>
	</div>
