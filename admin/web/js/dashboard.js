$(document).ready(function () {
    var USER_ROLE = $('#USER_ROLE').val();

    if(USER_ROLE == '1'){
        topVendors(null);
    }
    topExperiencesByOrder(null);
    getAllCounts(null);

    $( ".datepicker" ).datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        endDate: "today"
    });

    // $('#dashboar_widget_filter_form').submit(function (e) {
    $(document).on('submit','#dashboar_widget_filter_form',function (e) {
        e.preventDefault();
        var _from_date = $('#dashboard_from_date').val();
        var _to_date = $('#dashboard_to_date').val();
        toastr.remove();
        if(_from_date == '' || _to_date == ''){
            toastr.error('Please Select date range','Error');
            return false;
        }

        var startdate = new Date(_from_date);
        var enddate = new Date(_to_date);

        if(startdate > enddate){
            toastr.error('Invalid date range','Error');
            return false;
        }else{
            var data = { _from_date : _from_date,_to_date:_to_date };
            var USER_ROLE = $('#USER_ROLE').val();

            if(USER_ROLE == '1') {
                topVendors(data);
            }
            topExperiencesByOrder(data);
            getAllCounts(data);
        }
    })
});

function getAllCounts(data) {
    var BASE_URL = $("#BASE_URL").val();
    var url = BASE_URL+'dashboard/get-all-counts';
    $.ajax({
        url: url,
        type: 'get',
        data: data,
        beforeSend:function(){
            $('.total_exp_count').html('<i class="fa fa-refresh fa-spin" style="font-size:24px"></i>');
            $('.total_orders_count').html('<i class="fa fa-refresh fa-spin" style="font-size:24px"></i>');
            $('.total_users_count').html('<i class="fa fa-refresh fa-spin" style="font-size:24px"></i>');
            $('.total_vendors_count').html('<i class="fa fa-refresh fa-spin" style="font-size:24px"></i>');
        },
        success: function(response) {
            $('.total_exp_count').html( (typeof(response.total_exp_count) !='undefined'?response.total_exp_count:0));
            $('.total_orders_count').html( (typeof(response.total_orders_count) !='undefined'?response.total_orders_count:0));
            $('.total_users_count').html( (typeof(response.total_users_count) !='undefined'?response.total_users_count:0));
            $('.total_vendors_count').html( (typeof(response.total_vendors_count) !='undefined'?response.total_vendors_count:0));
        },
        error: function() {
            return false;
        }
    });
}

function topVendors(data) {
    var BASE_URL = $("#BASE_URL").val();
    var url = BASE_URL+'dashboard/top-vendors';

    $.ajax({
        url: url,
        type: 'get',
        data: data,
        beforeSend:function(){
            $('#topVendorContainer').html('<div class="chart_pre_loader"><i class="fa fa-refresh fa-spin" style="font-size:24px"></i></div>');
        },
        success: function(response) {
             $('#topVendorContainer').html(response);
        },
        error: function() {
            return false;
        }
    });
}

function topExperiencesByOrder(data) {
    var BASE_URL = $("#BASE_URL").val();
    var url = BASE_URL+'dashboard/top-experiences-by-order';

    $.ajax({
        url: url,
        type: 'get',
        data: data,
        beforeSend:function(){
            $('#topExperiencesByOrderContainer').html('<div class="chart_pre_loader"><i class="fa fa-refresh fa-spin" style="font-size:24px"></i></div>');
        },
        success: function(response) {
            $('#topExperiencesByOrderContainer').html(response);
        },
        error: function() {
            return false;
        }
    });
}