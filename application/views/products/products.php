<section id="main-content">
  <section class="wrapper">
    <!-- page start-->
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
            Products
          </header>
        </section>
      </div>
      <?php if($this->session->flashdata("msg") != ''){ ?>
      <div class="col-lg-12 message-box">
        <section class="panel panel-success">
          <header class="panel-heading">
            <p> <?php echo $this->session->flashdata("msg"); ?> </p>
          </header>
        </section>
      </div>
      <?php } ?>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <span style="display: inline-block;">
          <input type="text" class="form-control" id="product_title" placeholder="Search..." style="border: 1px solid #363940;border-radius: 0px;width: 220px;height: 30px;" autocomplete="off">
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
<div class="modal fade" id="ProductModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" autocomplete='off'>
  <div class="modal-dialog modal-lg" >
    <div class="modal-content" style="margin-right: 100px; margin-left: 100px;">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
        <h4 class="modal-title">Add New Product</h4>
      </div>
      <form action="<?=base_url()?>Products/insertProduct" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" id = "userForm">
        <div class="modal-body">
          <div class="panel-body">
            <input type="hidden" name="prod_id" id="prod_id">
            <div class="form-group">
              <label for="Name" class="col-sm-3 control-label">Product Against Category</label>
              <div class="col-sm-9">
                <select class="form-control" name="sub_cat_id" id="sub_cat_id">
                  <option value="">Category</option>
                  <?php foreach($categories as $category){ ?>
                  <option value="<?php echo $category['sub_cat_id'];?>"><?php echo $category['title'];?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="Name" class="col-sm-3 control-label">Title</label>
              <div class="col-sm-9">
                <input type="text" name="title" id="title" class="form-control" required>
              </div>
            </div>
            <div class="form-group">
              <label for="Name" class="col-sm-3 control-label">Size</label>
              <div class="col-sm-3">
                <input type="text" name="size" id="size" class="form-control" required>
              </div>
              <label for="Name" class="col-sm-2 control-label">Quantity</label>
              <div class="col-sm-4">
                <input type="text" name="quantity" id="quantity" class="form-control" required>
              </div>
            </div>
            <div class="form-group">
              <label for="Name" class="col-sm-3 control-label">item_no</label>
              <div class="col-sm-3">
                <input type="text" name="item_no" id="item_no" class="form-control" required>
              </div>
              <label for="Name" class="col-sm-2 control-label">price</label>
              <div class="col-sm-4">
                <input type="text" name="price" id="price" class="form-control" >
              </div>
            </div>
            <div class="form-group">
              <label for="Name" class="col-sm-3 control-label">discount</label>
              <div class="col-sm-3">
                <input type="text" name="discount" id="discount" class="form-control" >
              </div>
              <label for="Name" class="col-sm-2 control-label">type</label>
              <div class="col-sm-4">
                <select class="form-control" name="type" id="type">
                  <option value="general">General</option>
                  <option value="special">Special</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="Name" class="col-sm-3 control-label">Description</label>
              <div class="col-sm-9">
                <textarea class="form-control" name="description" id="description"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="Name" class="col-sm-3 control-label">Upload Image</label>
              <div class="col-sm-9">
                <input type="file" name="userfile" class="form-control">
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
<!-- Load Pako ZLIB library to enable PDF compression -->
<script type="text/javascript">
function product_list(keyword) {
var keyword = keyword;
$('#user_grid').kendoGrid({
dataSource: {
transport: {
read: {
url: "<?=base_url()?>Products/getProductList",
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
toolbar:[{ name: "Add New Product" }],
columns: [{
field: 'prod_id',
title: '',
hidden: true,
attributes: {
class: "prod_id"
}
},
{
field: 'title',
title: 'TITLE',
attributes: {
class: "product_title"
}
},
{
field: 'sub_cat_name',
title: 'CATEGORY NAME',
attributes: {
class: "sub_name"
}
},

{
field: 'size',
hidden: true,
title: 'SIZE',
attributes: {
class: "size"
}
},
{
field: 'quantity',
title: 'QUANTITY',
attributes: {
class: "quantity"
}
},
{
field: 'item_no',
title: 'ITEM #',
attributes: {
class: "item_no"
}
},
{
field: 'price',
title: 'PRICE',
attributes: {
class: "price"
}
},
{
field: 'discount',
title: 'DISCOUNT',
attributes: {
class: "discount"
}
},
{
field: 'type',
title: 'TYPE',
attributes: {
class: "type"
}
},
{
field: 'description',
title: '',
hidden: true,
attributes: {
class: "description"
}
},
{
field: 'image',
title: 'IMAGE',
attributes: {
class: "image"
},
template:'<img src="<?=base_url()?>asset/uploads/#=image#" width="30px" data-img_name="#=image#">',
},
{command: ["edit","destroy"], title: "ACTION", width: "200px"},
{
field: 'sub_cat_id',
title: '',
hidden: true,
attributes: {
class: "sub_cat_id"
}
},
{
field: 'url',
title: '',
hidden: true,
attributes: {
class: "subcat_url"
}
},

],
scrollable: true,
pageable: true,
selectable: true,
pageable: {
pageSizes: [20, 50,100],
buttonCount: 20,
refresh: true
},
});
}
product_list();
////////////////////////////////////
$('.k-grid-AddNewProduct').on('click', function() {
$('#userForm').trigger("reset");
$('#ProductModal').modal('show');
});
$('body').on('click', '.k-grid-edit', function() {
$('#userForm').trigger("reset");
var row = $(this).closest('tr');
var prod_id = row.find('td.prod_id').text();
var product_title = row.find('td.product_title').text();
var sub_cat_id = row.find('td.sub_cat_id').text();
var size = row.find('td.size').text();
var quantity = row.find('td.quantity').text();
var item_no = row.find('td.item_no').text();
var price = row.find('td.price').text();
var discount = row.find('td.discount').text();
var type = row.find('td.type').text();
var description = row.find('td.description').text();
$('#prod_id').val(prod_id);
$('#sub_cat_id').val(sub_cat_id);
$('#title').val(product_title);
$('#size').val(size);
$('#quantity').val(quantity);
$('#item_no').val(item_no);
$('#price').val(price);
$('#discount').val(discount);
$('#description').val(description);
$('#ProductModal').modal('show');
});

$('body').on('click', '.k-grid-delete', function() {
var row = $(this).closest('tr');
var prod_id = row.find('td.prod_id').text();
if (confirm("Are you sure to delete?")) {
$.ajax({
url: '<?=base_url()?>Products/deleteProduct',
data: {
'prod_id': prod_id
},
type: 'post',
success: function(res) {
product_list();
}
})
}
});
$(document).ready(function() {
$("#product_title").keyup(function() {
var mailValue = $(this).val();
product_list(mailValue);
});
});
</script>