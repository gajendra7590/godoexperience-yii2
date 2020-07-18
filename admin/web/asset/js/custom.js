
/*sign in*/
    jQuery(document).ready(function ()
    {
    jQuery('form[id="login_form"]').validate(
    {
        rules:
        {
            firs_name: 'required',
            email:
            {
                required: true,
                email: true,
            },
            password:
            {
                required: true,
                minlength: 8,
            }
        },
        messages:
        {
            firs_name: 'This field is required',
            email: 'Enter a valid email',
            password:
            {
                minlength: 'Password must be at least 8 characters long'
            }
        },
        submitHandler: function (form)
        {
            form.submit();
        }
    });

    });

/*sign up*/
    jQuery('form[id="signup_form"]').validate(
    {
    rules:
    {
        full_name: 'required',
        email:
        {
            required: true,
            email: true,
        }
    },
    messages:
    {
        full_name: 'This field is required',
        email: 'Enter a valid email',
    },
    submitHandler: function (form)
    {
        form.submit();
    }
    });

/* js for Loader*/
    jQuery(function (jQuery)
    {
    var waitText = "Please wait ...";
    jQuery(".btn_load").on("click touchstart", function ()
    {
        var that = jQuery(this);

        that.toggleClass("btn-wait");

        if (that.text() === waitText)
        {
            that.text(that.prop("data-original-text"));
            that.prop("aria-busy", "false");
        }
        else
        {
            that.prop("data-original-text", that.text());
            that.text(waitText);
            that.prop("aria-busy", "true");
        }
    });
    });
/*upload images client file*/
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            jQuery('#imagePreview').css('background-image', 'url('+e.target.result +')');
            jQuery('#imagePreview').hide();
            jQuery('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
jQuery("#imageUpload").change(function() {
    readURL(this);
});
/*Notification popup**/
    if(jQuery('.notifaction').length){
    /*Show*/
    jQuery('.notifaction').on('click', function(e) {
        e.preventDefault();
        jQuery('body').addClass('visible_notification');
    });
    /*Hide*/
    jQuery('.notification_wrapper .cross_icon,.layer_drop').on('click', function(e) {
        e.preventDefault();
        jQuery('body').removeClass('visible_notification');
    });
}
/*leftsidebar responsive mobile*/
if(jQuery('.slice-btn').length){
    /*Show Form*/
    jQuery('.slice-btn').on('click', function(e) {
        e.preventDefault();
        jQuery('body').addClass('left_sidebar_visible');
    });
    /*Hide Form*/
    jQuery('.left_sidebar_wrapper .cross-icon,.layer-drop').on('click', function(e) {
        e.preventDefault();
        jQuery('body').removeClass('left_sidebar_visible');
    });
}
/*top header right responsive mobile*/
jQuery(".top_heaer_right").click(function() {
    jQuery(this).toggleClass("on");
    jQuery(".topheader_right_content").fadeToggle("3000");
});





