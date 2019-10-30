
<div id="page-container">
  <div id="page-container2">
    <div id="header">
      
      <a id="crazy-billys" href="#">Crazy Billy's</a>
      <div id="tagline">Welcome, Come On In - Proudly Serving Long Island Since 1955</div>
      <div id="nav-cont">
        <ul>
          <li id="home"><a href="<?php echo base_url();?>Home">Home</a></li>
          <!-- <li id="shop"><a href="<?php echo base_url();?>Home/Products">Products</a></li> -->
          <li id="gift-baskets"><a href="<?php echo base_url();?>Home/gift_baskets">Gift Baskets</a></li>
         <li id="specials"><a href="<?php echo base_url()?>Home/specials">Specials</a></li>
          <li id="events"><a href="<?php echo base_url();?>Home/events">In-Store Events</a></li>
          <li id="did-you-know"><a href="<?php echo base_url()?>Home/did_you_know">Did You Know</a></li> 
          <li id="contact"><a href="<?php echo base_url()?>Home/contact_us">Contact Us</a></li>
        </ul>
        <div id="search">
          <form method="post" action="#" name="productsearchform">
            <input type="hidden" name="simple_search" value="Y" />
            <input type="hidden" name="mode" value="search" />
            <input type="hidden" name="posted_data[by_title]" value="Y" />
            <input type="hidden" name="posted_data[by_descr]" value="Y" />
            <input type="hidden" name="posted_data[by_sku]" value="Y" />
            <input type="hidden" name="posted_data[search_in_subcategories]" value="Y" />
            <input type="hidden" name="posted_data[including]" value="all" />
            <input id="sfield" type="text" name="posted_data[substring]" value="Let us help you find what you're looking for." onfocus="if(this.value=='Let us help you find what you\'re looking for.') this.value='';" onblur="if(this.value=='') this.value='Let us help you find what you\'re looking for.';" /><input type="submit" id="submit" value="GO" />
          </form>
        </div>
      </div>
      <a id="facebook" href="#" target="_blank" rel="nofollow">Join Us on Facebook</a>
      <a id="instalogo" href="#" target="_blank" rel="nofollow"></a>
    <img id="seal" src="<?=base_url()?>asset_main/images/logo_c.png" height="162" width="100" alt="SSL Secured" style="top: 0px;"/>    
   </div>
