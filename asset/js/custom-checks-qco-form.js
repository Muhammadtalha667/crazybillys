
      $(document).ready(function(){

	// form js checks start here
        $('body').on('click', '.study_eye',function(){
		  var option_selected = $(this).val();
		  if(option_selected=='OD'){
		 	 $(".od").attr('disabled',false);
		  	$(".os").attr('disabled',true);
		  	$(".od").attr('checked',false);
		  	$(".os").attr('checked',false);
		  }
		  else if(option_selected=='OS'){
		  	$(".od").attr('disabled',true);
		  	$(".os").attr('disabled',false);
		 	 $(".od").attr('checked',false);
		  	$(".os").attr('checked',false);
		  }else{
		 	 $(".od").attr('disabled',false);
		  	$(".os").attr('disabled',false);
		  	$(".od").attr('checked',false);
		  	$(".os").attr('checked',false);
		  }
		  defaultoff_od();
		  defaultoff_os();
		  defaultoff_oct_od();
		  defaultoff_oct_os();

		  });	
        // check's on cfp form 
		//comman defautl form settings 
		function defaultoff_od(){
				$("#photographer_yes").attr('disabled',true);
				$("#photographer_no").attr('disabled',true);	
				$("#camera_used_yes").attr('disabled',true);	
				$("#camera_used_no").attr('disabled',true);	
		}
		function defaultoff_os(){
				$("#photographer_yes_os").attr('disabled',true);	
				$("#photographer_no_os").attr('disabled',true);	
				$("#camera_used_yes_os").attr('disabled',true);	
				$("#camera_used_no_os").attr('disabled',true);	
		}

		// Q1 script
		
		$('.images_acquired').on('click',function(){
			var value = $(this).val();
			if (value == "Yes") {
           		 $('.affected_od').attr('disabled', false);
				 $('.view').attr('disabled', false);
				$('.view_textarea').attr('disabled', false);
				$('.section2_3 .od').attr('disabled', false);
                $('.section2_3 .od').prop('checked', false);
			 	$('.section2_3 .od :input').val('');
			}else if(value =="No"){
            	$('.affected_od').attr('disabled', true);
				$('.affected_od').attr('checked',false);
				$('.view').attr('disabled', true);
				$('.view_textarea').attr('disabled', true);
				$('.section2_3 .od').attr('disabled', true);
                $('.section2_3 .od').prop('checked', false);
			 	$('.section2_3 .od :input').val('');
			}
			defaultoff_od();
		});
		$('.images_acquired_os').on('click',function(){
			var value = $(this).val();
			if (value == "Yes") {
           		 $('.affected_os').attr('disabled', false);
				 $('.view_os').attr('disabled', false);
				$('.view_textarea_os').attr('disabled', false);
				$('.section2_3 .os').attr('disabled', false);
                $('.section2_3 .os').prop('checked', false);
			 	$('.section2_3 .os :input').val('');
			}else if(value =="No"){
            	$('.affected_os').attr('disabled', true);
				$('.affected_os').attr('checked',false);
				$('.view_os').attr('disabled', true);
				$('.view_textarea_os').attr('disabled', true);
				$('.section2_3 .os').attr('disabled', true);
                $('.section2_3 .os').prop('checked', false);
			 	$('.section2_3 .os :input').val('');
				
			}
			defaultoff_os();
		});
		// Q2 script
		$('.photographer').on('click',function(){
			var value = $(this).val();
			if (value == "Yes") {
           		 	$('#photographer_no').attr('disabled', true);
            		$('#photographer_yes').attr('disabled', false);
					//$('.section2_3 .od').attr('disabled', false);
			}else if(value == "No"){
            		$('#photographer_no').attr('disabled', false);
            		$('#photographer_yes').attr('disabled', true);
			}
		});
        $('.photographer_os').on('click',function(){
			var value = $(this).val();
			if (value == "Yes") {
           		 	$('#photographer_no_os').attr('disabled', true);
            		$('#photographer_yes_os').attr('disabled', false);
			}else if(value == "No"){
            		$('#photographer_no_os').attr('disabled', false);
            		$('#photographer_yes_os').attr('disabled', true);
			}
		});
		// Q4 script
		$('.camera_used').on('click',function(){
			var value = $(this).val();
			if (value == "Yes") {
           		 	$('#camera_used_no').attr('disabled', true);
            		$('#camera_used_yes').attr('disabled', false);
			}else if(value == "No"){
            		$('#camera_used_no').attr('disabled', false);
            		$('#camera_used_yes').attr('disabled', true);
			}
		});
       	$('.camera_used_os').on('click',function(){
			var value = $(this).val();
			if (value == "Yes") {
           		 	$('#camera_used_no_os').attr('disabled', true);
            		$('#camera_used_yes_os').attr('disabled', false);
			}else if(value == "No"){
            		$('#camera_used_no_os').attr('disabled', false);
            		$('#camera_used_yes_os').attr('disabled', true);
			}
		});

      //Q5 Scrpit
        $('.view').on('click', function() {
            var value = $(this).val();
            if (value != "30-60") {
                $('.section2_3 .od').attr('disabled', true);
                $('.section2_3 .od').prop('checked', false);
			 	$('.section2_3 .od :input').val('');
				$('.view_textarea').attr('disabled', false);
            } else if (value == "30-60") {
                $('.section2_3 .od').attr('disabled', false);
                $('.section2_3 .od').prop('checked', false);
			 	$('.section2_3 .od :input').val('');
				$('.view_textarea').attr('disabled', true);

            }
        });
        $('.view_os').on('change', function() {
            var value = $(this).val();
            if (value != "30-60") {
                $('.section2_3 .os').attr('disabled', true);
                $('.section2_3 .os').prop('checked', false);
                $('.section2_3 .os :input').val('');
				$('.view_textarea_os').attr('disabled', false);
            } else if (value == "30-60") {
                $('.section2_3 .os').attr('disabled', false);
                $('.section2_3 .os').prop('checked', false);
                $('.section2_3 .os :input').val('');
				$('.view_textarea_os').attr('disabled', true);
            }
        });
       
       
        // check's for oct Form  Start Here
		//comman defautl form settings 
		function defaultoff_oct_od(){
				$("#photographer_oct_yes").attr('disabled',true);
				$("#photographer_oct_no").attr('disabled',true);	
				$("#camera_used_oct_yes").attr('disabled',true);	
				$("#camera_used_oct_no").attr('disabled',true);	
		}
		function defaultoff_oct_os(){
				$("#photographer_oct_yes_os").attr('disabled',true);	
				$("#photographer_oct_no_os").attr('disabled',true);	
				$("#camera_used_oct_yes_os").attr('disabled',true);	
				$("#camera_used_oct_no_os").attr('disabled',true);	
		}
		// Q1 script
		$('.sd_scans_acquired').on('click',function(){
			var value = $(this).val();
			if (value == "Yes") {
           		 $('.affected_od_oct').attr('disabled', false);
				 
				$('.scan_type').attr('disabled', false);
				$('.scan_type_textarea').attr('disabled', false);
				$('.section2_3 .od').attr('disabled', false);
                $('.section2_3 .od').prop('checked', false);
			 	$('.section2_3 .od :input').val('');
			}else if(value =="No"){
            	$('.affected_od_oct').attr('disabled', true);
				$('.affected_od_oct').attr('checked',false);
				
				$('.scan_type').attr('disabled', true);
				$('.scan_type_textarea').attr('disabled', true);
				$('.section2_3 .od').attr('disabled', true);
                $('.section2_3 .od').prop('checked', false);
			 	$('.section2_3 .od :input').val('');
			}
			defaultoff_oct_od();
		});
		$('.sd_scans_acquired_os').on('click',function(){
			var value = $(this).val();
			if (value == "Yes") {
           		 $('.affected_os_oct').attr('disabled', false);
				 $('.scan_type_os').attr('disabled', false);
				$('.scan_type_textarea_os').attr('disabled', false);
				$('.section2_3 .os').attr('disabled', false);
                $('.section2_3 .os').prop('checked', false);
			 	$('.section2_3 .os :input').val('');
			}else if(value =="No"){
            	$('.affected_os_oct').attr('disabled', true);
				$('.affected_os_oct').attr('checked',false);
				$('.scan_type_os').attr('disabled', true);
				$('.scan_type_textarea_os').attr('disabled', true);
				$('.section2_3 .os').attr('disabled', true);
                $('.section2_3 .os').prop('checked', false);
			 	$('.section2_3 .os :input').val('');
			}
			defaultoff_oct_os();
		});
		
		// Q2 script
		$('.photographer_oct').on('click',function(){
			var value = $(this).val();
			if (value == "Yes") {
           		 	$('#photographer_oct_no').attr('disabled', true);
            		$('#photographer_oct_yes').attr('disabled', false);
			}else if(value == "No"){
            		$('#photographer_oct_no').attr('disabled', false);
            		$('#photographer_oct_yes').attr('disabled', true);
			}
		});
        $('.photographer_oct_os').on('click',function(){
			var value = $(this).val();
			if (value == "Yes") {
           		 	$('#photographer_oct_no_os').attr('disabled', true);
            		$('#photographer_oct_yes_os').attr('disabled', false);
			}else if(value == "No"){
            		$('#photographer_oct_no_os').attr('disabled', false);
            		$('#photographer_oct_yes_os').attr('disabled', true);
			}
		});
		
		// Q4 script
		$('.camera_used_oct').on('click',function(){
			var value = $(this).val();
			if (value == "Yes") {
           		 	$('#camera_used_oct_no').attr('disabled', true);
            		$('#camera_used_oct_yes').attr('disabled', false);
			}else if(value == "No"){
            		$('#camera_used_oct_no').attr('disabled', false);
            		$('#camera_used_oct_yes').attr('disabled', true);
			}
		});
       	$('.camera_used_oct_os').on('click',function(){
			var value = $(this).val();
			if (value == "Yes") {
           		 	$('#camera_used_oct_no_os').attr('disabled', true);
            		$('#camera_used_oct_yes_os').attr('disabled', false);
			}else if(value == "No"){
            		$('#camera_used_oct_no_os').attr('disabled', false);
            		$('#camera_used_oct_yes_os').attr('disabled', true);
			}
		});
       
      //Q5 Scrpit
         $('.scan_type').on('change', function() {
            var value = $(this).val();
			if (value == "25 B-scan") {
                $('.section2_3 .od').attr('disabled', false);
                $('.section2_3 .od').prop('checked', false);
				$('.section2_3 .od :input').val('');
				$('.scan_type_textarea').attr('disabled', true);
            } else if (value == "49 B-scan") {
                $('.section2_3 .od').attr('disabled', false);
                $('.section2_3 .od').prop('checked', false);
				$('.section2_3 .od :input').val('');
				$('.scan_type_textarea').attr('disabled', true);
            } else if (value != "25 B-scan" || hid != "49 B-scan") {
                $('.section2_3 .od').attr('disabled', true);
                $('.section2_3 .od').prop('checked', false);
				$('.section2_3 .od :input').val('');
				$('.scan_type_textarea').attr('disabled', false);
            }
        });
        $('.scan_type_os').on('change', function() {
            var value = $(this).val();
			if (value == "25 B-scan") {
                $('.section2_3 .os').attr('disabled', false);
                $('.section2_3 .os').prop('checked', false);
				$('.section2_3 .os :input').val('');
				$('.scan_type_textarea_os').attr('disabled', true);
            } else if (value == "49 B-scan") {
                $('.section2_3 .os').attr('disabled', false);
                $('.section2_3 .os').prop('checked', false);
				$('.section2_3 .os :input').val('');
				$('.scan_type_textarea_os').attr('disabled', true);
            } else if (value != "25 B-scan" || hid != "49 B-scan") {
                $('.section2_3 .os').attr('disabled', true);
                $('.section2_3 .os').prop('checked', false);
				$('.section2_3 .os :input').val('');
				$('.scan_type_textarea_os').attr('disabled', false);
            }
        });
        
        // check's on Q # 6
		$('.b_25_scan').on('click',function(){
			var value = $(this).val();
			if (value == "Yes") {
           		$('.six_yes').attr('disabled', false);
			}else if(value == "No"){
            	$('.six_yes').attr('disabled', true);
				$('.six_yes').prop('checked', false);
			}
		});
		$('.b_25_scan_os').on('click',function(){
			var value = $(this).val();
			if (value == "Yes") {
           		$('.six_os_yes').attr('disabled', false);
			}else if(value == "No"){
            	$('.six_os_yes').attr('disabled', true);
				$('.six_os_yes').prop('checked', false);
			}
		});
		
		// check's on Q # 7
		$('.b_49_scan').on('click',function(){
			var value = $(this).val();
			if (value == "Yes") {
            	$('.seven_yes').attr('disabled', false);
			}else if(value == "No"){
            	$('.seven_yes').attr('disabled', true);
				$('.seven_yes').prop('checked', false);
			}
		});
		$('.b_49_scan_os').on('click',function(){
			var value = $(this).val();
			if (value == "Yes") {
           	 	$('.seven_os_yes').attr('disabled', false);
			}else if(value == "No"){
            	$('.seven_os_yes').attr('disabled', true);
				$('.seven_os_yes').prop('checked', false);

			}
		});
      
	});

