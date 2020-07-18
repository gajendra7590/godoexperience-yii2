(function(){

$('body').on('beforeSubmit', '#profile_form', function() {
    var form = $(this);
    $.ajax({
        url: form.attr('action'),
        type: 'post',
        data: form.serialize(),
        success: function(response) {
            if (response == '1') {
                var url = form.attr('submit-url');
                var data = new FormData($("#profile_form")[0]);
                var redirect_url = form.attr('redirect-url');

                $.ajax({
                    url: url,
                    type: 'post',
                    data: data,
                    processData: false,
                    contentType: false,
                    beforeSend:function () {
                        $('.loader-btn').button('loading');
                        loaderShow();
                    },
                    complete:function () {
                        $('.loader-btn').button('reset');
                        loaderHide();
                    },
                    success: function (response) {
                        if (response.success) {
                            toastr.success('Profile Updated Successfully','Success!!');
                        } else {
                            toastr.error('Error in update profile','Error!!');
                        }
                    },
                    error: function (err) {
                        toastr.error(err,'Error');
                    }
                });


                return false;
            }
        },
        error: function() {
            return false;
        }
    });
    return false;
});


$('body').on('beforeSubmit', '#change_password_form', function() {
    var form = $(this);
    $.ajax({
        url: form.attr('action'),
        type: 'post',
        data: form.serialize(),
        success: function(response) {
            if (response == '1') {
                var url = form.attr('submit-url');
                var data = new FormData($("#change_password_form")[0]);
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
                        if (response.success) {
                            $("#change_password_form")[0].reset();
                            toastr.success('Password Changed successfully','Success!!');
                        } else {
                            toastr.error('Error in set password','Error!!');
                        }
                    },
                    error: function (err) {
                        toastr.error(err,'Error');
                    }
                });

                return false;
            }
        },
        error: function() {
            return false;
        }
    });
    return false;
});


$(document).on('click','.viewOrderDetail',function(e){
    e.preventDefault();
    var id = $(this).data('order_id');
    var url = $('#base_url').val();
    url = url+'/order-detail?id='+id


    $('#orderDetailModal').modal('toggle');
    $('#orderDetailModal').find('#modalContent')
        .load(url);
});



$(document).on('click','.manageGuestDetail',function(e){
    e.preventDefault();
    var id = $(this).data('order_id');
    var url = $('#base_url').val();
    url = url+'/guest-info-form?order_id='+id;

    $('#orderDetailModal').modal('toggle');
    $('#orderDetailModal').find('#modalContent').load(url);
});


$(document).on('click','.wishlist_close',function (e) {
    e.preventDefault();
    var id = $(this).data('exp_id');
    var url = $('#base_url').val();
    url = url+'/wishlist-remove?id='+id ;
    $.ajax({
        url: url,
        type: 'post',
        data: {},
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.success) {
                toastr.success('Item removed from wishlist','Success');
                pageTab('wishlist');
            }
        },
        error: function (err) {
            toastr.error(err,'Error');
        }
    });

});


$('.accountPage').click(function (e) {
    e.preventDefault();
    var page = $(this).data('page');

    if( ($(this).parent('li').hasClass('ac-list_Active')) == false){
        $('.ac-list_Active').removeClass('ac-list_Active mouseDisable');
        $(this).parent('li').addClass('ac-list_Active mouseDisable');
        pageTab(page);
    }

});

function loaderShow(){
    $(".loader-myac").show();
    $(".overlayer-myac").show();
}

function loaderHide(){
    $(".loader-myac").delay(200).fadeOut("slow");
    $(".overlayer-myac").delay(200).fadeOut("slow");
}

function pageTab(tab_name){
    var base_url = $('#base_url').val();
    var url = base_url+'?page='+tab_name;
    $.ajax({
        url: url,
        type: 'GET',
        data: {},
        beforeSend:function () {
            loaderShow();
        },
        success: function(response) {
            $('#pageContainer').html(response).hide().fadeIn(500);
        },
        complete:function (data) {
            loaderHide();
        },
        error: function(error) {
            toastr.error('Opps! error occured','Error');
            return false;
        }
    });
}

pageTab('profile');


})();