$(document).ready(function($) {
    $('body').on('beforeSubmit', '#experiences_form', function() {
        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            type: 'post',
            data: form.serialize(),
            success: function(response) {
                if (response == '1') {
                    var url = form.attr('submit-url');
                    var data = new FormData($("#experiences_form")[0]);
                    var redirect_url = form.attr('redirect-url');
                    submitForm(url, data, redirect_url); // callback function call
                    return false;
                }
            },
            error: function() {
                return false;
            }
        });
        return false;
    });

    //callback function  
    function submitForm(url, data, redirect_url) {

        var ifSuccess = validateCustomInputs();
        if (ifSuccess == false) { //Check Custom validations for dynamic fields
            $.ajax({
                url: url,
                type: 'post',
                data: data,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        window.location.href = response.redirect_url;
                    } else {
                        console.log(response);
                        return false;
                    }
                },
                error: function() {
                    return false;
                }
            });
        }
    }

    // Callback function for upload slider images
    $('#slide_img').change(function() {

        var file = $(this)[0].files[0];
        var allow_ext = ['jpg', 'jpeg', 'png'];
        var fileExt = ((file.name).split('.').pop()).toLowerCase();
        if (allow_ext.indexOf(fileExt) >= 0) {
            var url = $(this).data('url');
            var exp_id = $(this).data('exp_id');
            var formdata = new FormData();
            formdata.append('upload_media', file);
            formdata.append('exp_id', exp_id);
            $.ajax({
                url: url,
                type: 'post',
                data: formdata,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response != false) {
                        $('.image_upload_section').append(response);
                    }
                },
                error: function() {
                    return false;
                }
            });
        }
    });

    $(document).on('click', '.removeMediaImage', function() {
        var formdata = new FormData();
        formdata.append('image_name', $(this).data('img'));
        formdata.append('media_id', $(this).data('media_id'));
        formdata.append('exp_id', $(this).data('exp_id'));
        var url = $('#remove_action').data('url');
        var ele = $(this);
        $.ajax({
            url: url,
            type: 'post',
            data: formdata,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response == '1') {
                    ele.closest("div.image-div-main").remove();
                }
            },
            error: function() {
                return false;
            }
        });
    });

    /**
     * Function for chekc custom dynmaic field validations
     */
    validateCustomInputs = function() {
        var add_ons_name = $('.addon_name').length;
        var addon_desc = $('.addon_desc').length;
        var addon_price = $('.addon_price').length;
        $('.custom_errors').remove();
        var errors = false;
        if (add_ons_name > 0) {
            $('.addon_name').each(function(index, input) {
                if (input.value == '') {
                    $(this).after('<p class="custom_errors text-danger">The name is required</p>');
                    errors = true;
                }
            });
        }

        if (addon_desc > 0) {
            $('.addon_desc').each(function(index, input) {
                if (input.value == '') {
                    $(this).after('<p class="custom_errors text-danger">The description is required</p>');
                    errors = true;
                }
            });
        }

        if (addon_price > 0) {
            $('.addon_price').each(function(index, input) {
                if (input.value == '') {
                    $(this).after('<p class="custom_errors text-danger">The price is invalid</p>');
                    errors = true;
                } else {
                    if (($.isNumeric(input.value) == false) || (input.value < 0)) {
                        $(this).after('<p class="custom_errors text-danger">Price value only numbers</p>');
                        errors = true;
                    }
                }
            });
        }

        return errors;
    }

    $('#AdonMoreBtn').click(function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).data('url'),
            type: 'get',
            success: function(response) {
                $('#add_on_container').append(response);
            },
            error: function() {

            }
        });
    });

    $(document).on('click', '.addon-btn-remove', function() {
        //$(this).parents("div.remove_parent").remove();
        var time = $(this).data('time');
        var exp_id = $(this).data('exp_id');
        var getAdon_id = $(this).data('id');
        if(exp_id > 0){
            var url = $(this).data('bs_url');
            var this_obj = $(this);
            $.ajax({
                url: url,
                type: 'post',
                data:{id:getAdon_id,exp_id:exp_id},
                success: function(response) {
                    if(response.success == '0'){
                        toastr.remove();
                        toastr.error('This Item is already booked someone,cant remove','Error');
                    }else{
                        toastr.remove();
                        var get_type = $('#action_type_' + time).val();
                        if (get_type == 'new') {
                            this_obj.parents("div.remove_parent").remove();
                        } else {
                            $('#is_deleted_' + time).val(1);
                            this_obj.parents("div.remove_parent").hide();
                            $('.input_'+time).val('0');
                        }
                    }
                },
                error: function() {

                }
            });

        }else{
            var get_type = $('#action_type_' + time).val();
            if (get_type == 'new') {
                $(this).parents("div.remove_parent").remove();
            } else {
                $('#is_deleted_' + time).val(1);
                $('.input_'+time).val('0');
                $(this).parents("div.remove_parent").hide();
            }
        }


    });


    //For Dates
    $('#select_exp_type_dd').change(function() {
        var type = $(this).val();
        if (type != '') {
            $('#dates_container').html('');
            if (type == '2') {
                $('.manageShowForType').addClass('container_hide');
                $('#experiences-event_total_day').val('');
            } else {
                $('.manageShowForType').removeClass('container_hide');
                $('#experiences-event_total_day').val(1);
            }
            $.ajax({
                url: $(this).data('url'),
                type: 'get',
                success: function(response) {
                    $('#dates_container').append(response);
                },
                error: function() {

                }
            });
        }
    });


    //Below all Scripts for calendar

    $('#select_year').change(function() {
        var year = $('#select_year option:selected').val();
        $("#select_month").val('01');
        var month = $('#select_month option:selected').val();
        getCalendar(year, month);
    });


    $('#select_month').change(function() {
        var year = $('#select_year option:selected').val();
        var month = $('#select_month option:selected').val();
        getCalendar(year, month);
    });

    function getCalendar(year, month) {
        $.ajax({
            url: $(this).data('url'),
            type: 'get',
            data: { year: year, month: month },
            beforeSend: function() {
                $('#calendar_container').html('<div class="linear-background-admination"></div>');
            },
            success: function(response) {
                $('#calendar_container').html(response);
            },
            error: function() {

            }
        });
    }
    //On Page Load Get Calendar
    getCalendar(0, 0);


    $(document).on('click', '.date_change_event', function() {
        var url = $('#date_save_url').val();
        var fd = new FormData();
        fd.append('year', $('#select_year option:selected').val());
        fd.append('month', $('#select_month option:selected').val());
        fd.append('date', $(this).data('value'));
        //fd.append('deleted_status', is_active);
        var this_obj = $(this);
        saveRevokeEvent(url, fd,this_obj);
    });

    function saveRevokeEvent(url, data,this_obj) {
        $.ajax({
            url: url,
            type: 'post',
            data: data,
            processData: false,
            contentType: false,
            beforeSend: function() {

            },
            success: function(response) {
                toastr.remove() //Remove Previous Taostr message
                if(response.success == 1){

                    toastr.success(response.message, "Success");
                    var is_active = this_obj.attr('data-active');
                    if(is_active == '1'){
                        this_obj.attr('data-active',0);
                    }else{
                        this_obj.attr('data-active',1);
                    }
                    this_obj.toggleClass('corona_Active');

                }else if(response.success == 2){
                    toastr.error(response.message, "Error");
                }else{
                    toastr.error(response.message, "Error");
                }
            },
            error: function() {
                toastr.error("Error is occured", "Error");
            }
        });
    }

});