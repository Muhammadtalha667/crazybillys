
<!-- js placed at the end of the document so the pages load faster -->
<script class="include" type="text/javascript" src="<?=base_url()?>asset/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="<?=base_url()?>asset/js/jquery.scrollTo.min.js"></script>
<script src="<?=base_url()?>asset/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?=base_url()?>asset/js/jquery.sparkline.js" type="text/javascript"></script>
<script src="<?=base_url()?>asset/js/jquery.customSelect.min.js" ></script>
<script src="<?=base_url()?>asset/js/select2.js" ></script>
<script src="<?=base_url()?>asset/js/respond.min.js" ></script>
<script src="<?=base_url()?>asset/js/bootstrap-datetimepicker.min.js" ></script>

<!--right slidebar-->

<script src="<?=base_url()?>asset/js/slidebars.min.js"></script>
<script src="<?=base_url()?>asset/js/toastr.js"></script>

    <link href="<?=base_url()?>asset/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
    <script src="<?=base_url()?>asset/fancybox/source/jquery.fancybox.js"></script>
<script type="text/javascript">
      $(function() {
        //    fancybox
          jQuery(".fancybox").fancybox();
      });

  </script>
<!--common script for all pages-->
<script src="<?=base_url()?>asset/js/common-scripts.js"></script>
<script src="<?=base_url()?>asset/js/custom-checks-qco-form.js?"<?=time()?>></script>
<script src="<?=base_url()?>asset/js/custom-checks-grader-form.js?"<?=time()?>></script>
<script src="<?=base_url()?>asset/js/customScript.js?"<?=time()?>></script>
<script src="<?=base_url();?>asset/js/jszip.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".message-box").fadeTo(3000, 500).slideUp(500, function(){
		   	$(".message-box").alert('close');
		});
	})
</script>
</body>
</html>
