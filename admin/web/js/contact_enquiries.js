
$('body').on('beforeSubmit', '#contact_us_reply_form', function(e) {
    e.preventDefault();
    var form = $(this);
    $.ajax({
        url: form.attr('action'),
        type: 'post',
        data: form.serialize(),
        success: function(response) {
            if (response == '1') {
                var url = form.attr('submit-url');
                var data = new FormData($("#contact_us_reply_form")[0]);
                $.ajax({
                    url: url,
                    type: 'post',
                    data: data,
                    processData: false,
                    contentType: false,
                    beforeSend:function () {
                        $('.overlay_admin').show();
                    },
                    success: function(response) {
                        if ( typeof( (response.success)!='undefined') &&(response.success == true) ) {
                            toastr.success("Email has been sent successfully",'Success');
                            setTimeout(function () {
                                //$('#contactEnquiryModal').modal('hide');
                                window.location.href = '';
                            },1000);
                        } else {
                            toastr.error("Sorry! we are getting some erro",'Error');
                        }
                    },
                    complete:function (res) {
                        $('.overlay_admin').hide();
                    },
                    error: function() {
                        return false;
                    }
                });
            }
        },
        error: function() {
            return false;
        }
    });
    return false;
});


$('.contactReplyPreview').click(function (e) {
    var closeBtn = '<button type="button" class="close" data-dismiss="modal">&times;</button><h4>Replied email preview</h4>';

    if ($('#contactEnquiryModal').data('bs.modal').isShown) {
        $('#contactEnquiryModal').find('#contactModalContent')
            .load($(this).attr('data-preview'));
        document.getElementById('contactEnquiryModalHeader').innerHTML = closeBtn;
    } else {
        $('#contactEnquiryModal').modal('show')
            .find('#contactModalContent')
            .load($(this).attr('data-preview'));
        document.getElementById('contactEnquiryModalHeader').innerHTML = closeBtn;
    }

});


$('.contactReply').click(function (e) {
    e.preventDefault();

    if ($('#contactEnquiryModal').data('bs.modal').isShown) {
        $('#contactEnquiryModal').find('#contactModalContent')
            .load($(this).attr('data-reply'));
        document.getElementById('contactEnquiryModalHeader').innerHTML = '<button type="button" class="close" data-dismiss="modal">&times;</button><h4>' + $(this).attr('title') + '</h4>';
    } else {
        $('#contactEnquiryModal').modal('show')
            .find('#contactModalContent')
            .load($(this).attr('data-reply'));
        document.getElementById('contactEnquiryModalHeader').innerHTML = '<button type="button" class="close" data-dismiss="modal">&times;</button><h4>' + $(this).attr('title') + '</h4>';
    }

});