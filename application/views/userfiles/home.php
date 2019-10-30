<!-- end header -->
<div id="content-container">
  <div id="content-container2">
    <div id="scontent">
      <!-- central space -->              
      <div style="padding-top: 1px;">
        <h1>Our Collections</h1>
        <?php foreach($subCategories as $item){ ?>
          <div class="subcategories">
            <a href="<?php echo base_url(); ?>home/products/<?php echo $item['sub_cat_id']; ?>"><img src="<?=base_url()?>asset/uploads/<?php echo $item['image']; ?>" alt="<?php echo $item['title'];?>"  width="129" height="129" />
            </a><br /><?php echo $item['title'];?>
          </div>
        <?php } ?>  

                
                
                 
             