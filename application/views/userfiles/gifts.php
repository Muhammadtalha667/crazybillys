<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset_main/style.css">
<div id="main">
	<div id="page">
		<img width="981" height="200" src="<?=base_url()?>asset_main/images/gift-baskets-header.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" srcset="<?=base_url()?>asset_main/images/gift-baskets-header.jpg" sizes="(max-width: 981px) 100vw, 981px" /><div class="clear"></div>
		<div id="text" role="main">
			<div id="giftcolumn" class="columns">
				<?php foreach ($gallery as $value) {?>
				<img src="<?=base_url()?>asset/uploads/<?=$value['image'];?>" height="265" width="200" alt="" />
				<?php } ?>
			</div>
			
			<div class="clear"></div>
		</div>
	