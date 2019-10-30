<!-- header -->
<!-- end header -->
<div id="content-container">
  <div id="content-container2">
    <div id="scontent">
      <!-- central space -->
      <div id="left-bar">
        
        <div class="menu-dialog menu-minicart"><div class="btop"></div>
        <div class="bint">
          <div class="title-bar ">
            <img class="icon ajax-minicart-icon" src="../skin/common_files/images/spacer.gif" alt="" /><h2>Shopping Cart</h2>
          </div>
          <div class="content">
            
            <div class="minicart">
              
              <div class="valign-middle empty">
                <strong>Cart is empty</strong>
              </div>
              
            </div>
            <div class="cart-checkout-links">
            </div>
            <ul>
              
            </ul>
          </div>
        </div>
        <div class="bbot"></div></div>
        <ul id="buttons">
          <li id="side-shop"><a href="#"></a></li>
          <li id="side-gifts"><a href="#"></a></li>
          <li id="side-specials"><a href="#"></a></li>
          <li id="side-events"><a href="#"></a></li>
        </ul>
      </div>
      <div id="center">
        <div id="center-main">
          <!-- central space -->
          <h1 style="text-align: left;"><?php echo $subCategoryTitle;?></h1>
          <div class="dialog products-dialog dialog-category-products-list list-dialog">
           
            
            <div class="content">
              <div class="products products-list">
                
                <script type="text/javascript">
                //<![CDATA[
                products_data[1494] = {};
                //]]>
                </script>
                <?php foreach($products as $value){?>
                <div class="highlight item">
                  <div class="image" style="width: 115px;">
                    <img src="<?=base_url()?>asset/uploads/<?=$value['image']?>" height="150" width="100" />
                  </div>
                  <div class="details" style="margin-left: 115px;">
                    <div class="pinfo">
                      <h5 class="product-title"><?=$value['title'];?></h5>
                      
                      <div class="descr"><?=$value['description']?></div>
                    </div>
                    <div class="pright">
                      <div class="price-row">
                        <div class="bottle"><span class="price">Item(s)</span><br/><span class="price-value"><span class="currency">$12.99</span></span></div> 
                      </div>
                      <div class="taxes">  
                      </div>
                      <div class="buy-now">
                        <script type="text/javascript">
                        //<![CDATA[
                        products_data[1388].quantity = 1000;
                        products_data[1388].min_quantity = 1;
                        //]]>
                        </script>
                        
                        
                      </div>
                      
                      <div class="extra-details">
                        
                        Size: <?=$value['size'];?><br />
                        Case: <?=$value['case'];?>
                        Item# <?=$value['item_no'];?><br/>
                      Type: <?=$value['sub_category_title'];?></div>
                    </div>
                  </div>
                  <div class="clearing"></div>
                </div>
                <?php } ?>
                </div>
             <!--  <ul class="simple-list-left width-100">
                <li class="item-right">
                  <span class="per-page-selector">Items Per Page <select onchange="javascript:window.location='http://www.crazybillys.net/shop/asian/?objects_per_page=' + this.value;"><option value="" selected="selected"></option><option value="5">5 items</option><option value="10" selected="selected">10 items</option><option value="15">15 items</option><option value="20">20 items</option><option value="25">25 items</option><option value="30">30 items</option><option value="35">35 items</option><option value="40">40 items</option><option value="45">45 items</option><option value="50">50 items</option></select></span>
                </li>
              </ul> -->
              <div class="clearing"></div>
            </div>
          </div>
          <!-- /central space -->
          </div><!-- /center -->
          </div><!-- /center-main -->
          <div id="right-bar">
            <div id="ccats">
              <h2>Gift Certificates</h2>
              <ul>
                <li><a href="#">Order Gift Certificates</a></li>
              </ul>
              <?php foreach ($category as $value) {?>
              <h2><?= $value['title'];?></h2>
              <ul>
                <?php foreach ($catProducts as  $cat_product) 
                if($cat_product['cat_id']== $value['cat_id']) {?>
                <li><a href="<?php echo base_url(); ?>home/products/<?php echo $cat_product['sub_cat_id']; ?>"><?= $cat_product['title'];?></a></li>
               <?php }?>
              </ul>
            <?php }?>
            </div>
          </div>