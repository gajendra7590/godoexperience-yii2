(function(){

    function loaderShow(){
        $(".loader-myac").show();
        $(".overlayer-myac").show();
    }

    function loaderHide(){
        $(".loader-myac").delay(200).fadeOut("slow");
        $(".overlayer-myac").delay(200).fadeOut("slow");
    }

    //Overlay Of Page
    loaderHide();

    //For Registration Form
    $('body').on('beforeSubmit', '#register_form', function(e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            type: 'post',
            data: form.serialize(),
            success: function(response) {
                if (response == '1') {
                    var url = form.attr('submit-url');
                    var data = new FormData($("#register_form")[0]);
                    submitHandler(url,data);
                    return false;
                }else{
                    return false;
                }
            },
            error: function() {
                return false;
            }
        });
        return false;
    });

    //For Forgot Password
    $('body').on('beforeSubmit', '#reset_password_form', function(e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            type: 'post',
            data: form.serialize(),
            success: function(response) {
                if (response == '1') {
                    var url = form.attr('submit-url');
                    var data = new FormData($("#reset_password_form")[0]);
                    submitHandler(url,data);
                    return false;
                }else{
                    return false;
                }
            },
            error: function() {
                return false;
            }
        });
        return false;
    });

    //For Forgot Password
    $('body').on('beforeSubmit', '#set_new_password_form', function(e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            type: 'post',
            data: form.serialize(),
            success: function(response) {
                if (response == '1') {
                    var url = form.attr('submit-url');
                    var data = new FormData($("#set_new_password_form")[0]);
                    submitHandler(url,data);
                    return false;
                }else{
                    return false;
                }
            },
            error: function() {
                return false;
            }
        });
        return false;
    });



    function submitHandler(url,data){
        $.ajax({
            url: url,
            type: 'post',
            data: data,
            processData: false,
            contentType: false,
            beforeSend:function () {
                loaderShow();
            },
            complete:function () {
                loaderHide();
            },
            success: function (response) {

                if(response.success == true){
                    toastr.success(response.message , "Success!");
                    //response.success
                    setTimeout(function(){
                        window.location.href = response.redirect_url
                    }, 500)
                }else{
                    toastr.error("We are facing issue to make your request","Error!");
                }
            },
            error: function (err) {
                toastr.error(err,'Error');
            }
        });
    }

})();