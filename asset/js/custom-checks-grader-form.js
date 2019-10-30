    $(document).ready(function() {

        $('.checke_other_od_oct').on('change', function() {
            var hid = $(this).val();
            console.log(hid);
            if (hid == "Gradable") {
                $('.affected_other_oct .od').attr('disabled', false);
                $('.affected_other_oct .od').prop('checked', false);
                $('.segmentation_lines').attr('disabled', false);
            } else if (hid == "Partially Gradable") {
                $('.affected_other_oct .od').attr('disabled', false);
                $('.affected_other_oct .od').prop('checked', false);
                $('.segmentation_lines').attr('disabled', false);

            } else if (hid == "Ungradable" || hid == "No OD Scans") {
                $('.affected_other_oct .od').attr('disabled', true);
                $('.affected_other_oct .od').prop('checked', false);
                $('.segmentation_lines').attr('disabled', true);

            }
        });

        $('.irf_macular').on('click', function() {
            if ($(this).val() == 'Yes') {
                $('.segmentation_lines').attr('disabled', false);
            } else if ($(this).val() == 'No') {
                $('.segmentation_lines').attr('disabled', true);
            }
        });
        $('.irf_macular_os').on('click', function() {
            if ($(this).val() == 'Yes') {
                $('.segmentation_lines_os').attr('disabled', false);
            } else if ($(this).val() == 'No') {
                $('.segmentation_lines_os').attr('disabled', true);
            }
        });
        $('.checke_other_os_oct').on('change', function() {
            var hide = $(this).val();
            console.log(hide)
            if (hide == "Gradable") {
                $('.affected_other_oct .os').attr('disabled', false);
                $('.affected_other_oct .os').prop('checked', false);
            } else if (hide == "Partially Gradable") {
                $('.affected_other_oct .os').attr('disabled', false);
                $('.affected_other_oct .os').prop('checked', false);
            } else if (hide == "Ungradable" || hide == "No OD Scans") {
                $('.affected_other_oct .os').attr('disabled', true);
                $('.affected_other_oct .os').prop('checked', false);
            }
        });
		
		        });