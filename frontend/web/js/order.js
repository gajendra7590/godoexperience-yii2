$('.first_name_input').bind('blur keyup', function(){
    $(this).parent('div').children('.text-danger').remove();
    if($(this).val() == ''){
        $(this).parent('div').append('<span class="text-danger">The first name field is required</span>')
    }
});

$('.last_name_input').bind('blur keyup', function(){
    $(this).parent('div').children('.text-danger').remove();
    if($(this).val() == ''){
        $(this).parent('div').append('<span class="text-danger">The last name field is required</span>');
    }
});

$('.email_input').bind('blur keyup', function(){
    var email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
    var email = $(this).val();
    $(this).parent('div').children('.text-danger').remove();
    if(email != ''){
        if(!email_regex.test(email)){
            $(this).parent('div').append('<span class="text-danger">The email field must valid email address</span>');
        }
    }else{
        $(this).parent('div').append('<span class="text-danger">The email field is required</span>')
    }
});

$('.phone_number_input').bind('blur keyup', function(){
    var phone_number_regex = /^[0-9]{10}$/;
    var  phone_number = $(this).val();
    $(this).parent('div').children('.text-danger').remove();
    if(phone_number != ''){
        if(!phone_number_regex.test(phone_number)){
            $(this).parent('div').append('<span class="text-danger">The phone number should valid 10 digit</span>');
        }
    }else{
        $(this).parent('div').append('<span class="text-danger">The phone number field is required</span>')
    }
});

$('#orderGuestsForm').unbind().submit(function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();

    //Validations Start
        $('.text-danger').remove();
        var error = false;
        $('.first_name_input').each(function (index, item) {
            var v = $(item).val();
            if(v=='' || v==null){
                error = true;
                $(this).parent('div').append('<span class="text-danger">The first name field is required</span>')
            }

        });

        $('.last_name_input').each(function (index, item) {
            var v = $(item).val();
            if(v=='' || v==null){
                error = true;
                $(this).parent('div').append('<span class="text-danger">The last name field is required</span>')
            }
        });

        $('.email_input').each(function (index, item) {
            var v = $(item).val();
            var email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
            if(v=='' || v==null){
                error = true;
                $(this).parent('div').append('<span class="text-danger">The email field is required</span>');
            }

            if(v!='' && (!email_regex.test(v))){
                error = true;
                $(this).parent('div').append('<span class="text-danger">The email field must valid email address</span>');
            }
        });

        $('.phone_number_input').each(function (index, item) {
            var phone_number_regex = /^[0-9]{10}$/;
            var  phone_number = $(item).val();
            $(this).parent('div').children('.text-danger').remove();
            if(phone_number != ''){
                if(!phone_number_regex.test(phone_number)){
                    error = true;
                    $(this).parent('div').append('<span class="text-danger">The phone number should valid 10 digit</span>');
                }
            }else{
                error = true;
                $(this).parent('div').append('<span class="text-danger">The phone number field is required</span>')
            }
        });

        //If Valdiation is success then save the detail
        if(error == false){
            var url = $(this).attr('action');
            var base_url = $(this).data('base_url');
            base_url = base_url+'my-account';
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success == true){
                        toastr.success('Guest detail saved','Saved');
                        $('.text-danger').remove();
                        setTimeout(function(){
                            window.location.href = base_url;
                        }, 500);

                    }else{
                        toastr.error('Opps! error occured','Error');
                        $('.text-danger').remove();
                    }
                },
                error: function() {
                    toastr.error('Opps! error occured','Error');
                    return false;
                }
            });

        }else {
            toastr.error("Please correct form values","Form Error");
        }
});