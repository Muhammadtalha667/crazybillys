<section id="main-content">
  <section class="wrapper">
    <!-- page start-->
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
            Main Categories
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
          <input type="text" name="email" class="form-control" id="category_title" placeholder="Search..." style="border: 1px solid #363940;border-radius: 0px;width: 220px;height: 30px;" autocomplete="off">
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
<div class="modal fade" id="CategoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" autocomplete='off'>
  <div class="modal-dialog modal-lg" >
    <div class="modal-content" style="margin-right: 200px; margin-left: 200px;">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
        <h4 class="modal-title">Add New Category</h4>
      </div>
      <form action="<?=base_url()?>Categories/insertMainCategory" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" id = "userForm">
        <div class="modal-body">
          <div class="panel-body">
            <input type="hidden" name="cat_id" id="cat_id">
            <div class="form-group">
              <label for="Name" class="col-sm-3 control-label">Title</label>
              <div class="col-sm-9">
                <input type="text" name="title" id="title" class="form-control" required>
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
    function cat_list(keyword) {
        var keyword = keyword;
        $('#user_grid').kendoGrid({
            dataSource: {
                transport: {
                    read: {
                        url: "<?=base_url()?>Categories/getCatList",
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
            toolbar:[{ name: "Add New Category" }],
            columns: [{
                    field: 'cat_id',
                    title: 'ID',
                    attributes: {
                        class: "cat_id"
                    }
                },
                {
                    field: 'title',
                    title: 'TITLE',
                    attributes: {
                        class: "cat_title"
                    }
                },
                {command: ["edit","destroy"], title: "ACTION", width: "200px"},
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
    cat_list();
    ////////////////////////////////////
    $('.k-grid-AddNewCategory').on('click', function() {
        $('#userForm').trigger("reset");
        $('#CategoryModal').modal('show');
    });

    $('body').on('click', '.k-grid-edit', function() {
      $('#userForm').trigger("reset");
        var row = $(this).closest('tr');
        var title = row.find('td.cat_title').text();
        var id = row.find('td.cat_id').text();
        $('#cat_id').val(id);
        $('#title').val(title);
        $('#CategoryModal').modal('show');
    });
    
    $('body').on('click', '.k-grid-delete', function() {
        var row = $(this).closest('tr');
        var cat_id = row.find('td.cat_id').text();
        if (confirm("Are you sure to delete?")) {
            $.ajax({
                url: '<?=base_url()?>Categories/deletecategory',
                data: {
                    'cat_id': cat_id
                },
                type: 'post',
                success: function(res) {
                    cat_list();
                }
            })
        }
    });
    $(document).ready(function() {
        $("#category_title").keyup(function() {
            var mailValue = $(this).val();
            cat_list(mailValue);
        });   
    });
</script>
