<section id="main-content">
  <section class="wrapper">
    <!-- page start-->
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
            Events
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
<div class="modal fade" id="EventsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" autocomplete='off'>
  <div class="modal-dialog modal-lg" >
    <div class="modal-content" style="margin-right: 100px; margin-left: 100px;">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
        <h4 class="modal-title">Add New Sub Eevent</h4>
      </div>
      <form action="<?=base_url()?>Admin/insertEvent" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" id = "userForm">
        <div class="modal-body">
          <div class="panel-body">
            <input type="hidden" name="id" id="id">
            <div class="form-group">
              <label for="Name" class="col-sm-3 control-label">Address</label>
              <div class="col-sm-9">
                <input type="text" name="address" id="address" class="form-control" required>
              </div>
            </div>
            <div class="form-group">
              <label for="Name" class="col-sm-3 control-label">Date</label>
              <div class="col-sm-9">
                <input type="date" name="date" id="date" class="form-control" required>
              </div>
            </div>
            <div class="form-group">
              <label for="Name" class="col-sm-3 control-label">From Time</label>
              <div class="col-sm-3">
                <input type="time" name="from_time" id="from_time" class="form-control" required>
              </div>
              <label for="Name" class="col-sm-2 control-label">To Time</label>
              <div class="col-sm-4">
                <input type="time" name="to_time" id="to_time" class="form-control" >
              </div>
            </div>
            <div class="form-group">
              <label for="Name" class="col-sm-3 control-label">Description</label>
              <div class="col-sm-9">
                <textarea class="form-control" name="description" id="description"></textarea>
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
    function events_list(keyword) {
        var keyword = keyword;
        $('#user_grid').kendoGrid({
            dataSource: {
                transport: {
                    read: {
                        url: "<?=base_url()?>Admin/getEvents",
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
            toolbar:[{ name: "Add New Eevent" }],
            columns: [{
                    field: 'id',
                    title: '',
                    hidden: true,
                    attributes: {
                        class: "event_id"
                    }
                },
                {
                    field: 'address',
                    title: 'ADDRESS',
                    attributes: {
                        class: "address"
                    }
                },
                {
                    field: 'date',
                    title: 'DATE',
                    attributes: {
                        class: "date"
                    }
                },
                
                {
                    field: 'from_time',
                    title: 'FROM TIME',
                    attributes: {
                        class: "from_time"
                    }
                },
                {
                    field: 'to_time',
                    title: 'TO TIME',
                    attributes: {
                        class: "to_time"
                    }
                },
                {
                    field: 'description',
                    title: '',
                    attributes: {
                        class: "description"
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
    events_list();
    ////////////////////////////////////
    $('.k-grid-AddNewEevent').on('click', function() {
        $('#userForm').trigger("reset");
        $('#EventsModal').modal('show');
    });

    $('body').on('click', '.k-grid-edit', function() {
      $('#userForm').trigger("reset");
        var row = $(this).closest('tr');
        var id = row.find('td.event_id').text();
        var address = row.find('td.address').text();
        var date = row.find('td.date').text();
        var from_time = row.find('td.from_time').text();
        var to_time = row.find('td.to_time').text();
        var description = row.find('td.description').text();
        $('#id').val(id);
        $('#address').val(address);
        $('#date').val(date);
        $('#from_time').val(from_time);
        $('#to_time').val(to_time);
        $('#description').val(description);
        $('#EventsModal').modal('show');
    });
    
    $('body').on('click', '.k-grid-delete', function() {
        var row = $(this).closest('tr');
        var event_id = row.find('td.event_id').text();
        if (confirm("Are you sure to delete?")) {
            $.ajax({
                url: '<?=base_url()?>Admin/deleteEvent',
                data: {
                    'event_id': event_id
                },
                type: 'post',
                success: function(res) {
                    events_list();
                }
            })
        }
    });
    $(document).ready(function() {
        $("#product_title").keyup(function() {
            var mailValue = $(this).val();
            events_list(mailValue);
        });   
    });
</script>
