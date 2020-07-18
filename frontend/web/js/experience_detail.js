(function() {

    /* Show Date popup Toggle*/
    $(document).on('click','.guests-shw-toggle',function(e){
        $(".guests-shw-menu").slideToggle();
    });

    /* function for call ajax item saved */
    $('#savedExp').unbind().click(function (e) {
        e.preventDefault();
        var exp_id = $(this).data('exp_id');
        var base_url =  $('#showBookDates').data('base_url');
        var url = base_url+ 'experience-detail/experience-saved?id=' + exp_id;
        var data = {};
        var container = $(this);
        $.ajax({
            url: url,
            type: 'post',
            data: data,
            success: function(response) {
                if(response.success == true){
                    container.removeClass().addClass( (typeof('response.action')!='undefined')?response.action:'');
                    container.html('<i class="fa fa-heart-o" aria-hidden="true"></i><span>'+response.text+'</span>');
                    toastr.remove();
                    if(response.text == 'Saved'){
                        toastr.success("Added to favourite","Added");
                    }else{
                        toastr.success("Removed from favourite","Removed");
                    }
                }
            },
            error: function() {
                return false;
            }
        });

    });

    $('#showBookDates').unbind().click(function() {
        var id = $(this).data('id');
        var base_url = $(this).data('base_url');
        var cal_url = base_url + 'experience-detail/events-cal?id=' + id;
        var cal_dates = base_url + 'experience-detail/events-avl-dates?id=' + id;
        var guest_url = base_url + 'experience-detail/events-guest?id=' + id;
        // alert(cal_url)

        getEventsCalendar(cal_url);
        getEventsDates(cal_dates);
        getEventsGuests(guest_url);
        $('#showDatePopup').modal('show');

    });

    $(document).on('click','.eventsSwitch',function (e) {
        e.preventDefault();
        $('#cartPaySection').html(''); //Remove Pay Section
        var id = $('#showBookDates').data('id');
        var base_url = $('#showBookDates').data('base_url');

        var year = $(this).data('year');
        var month = $(this).data('month');
        var action = $(this).data('action');

        var cal_url = base_url + 'experience-detail/events-cal?id=' + id;
        var cal_dates = base_url + 'experience-detail/events-avl-dates?id=' + id;
        var guest_url = base_url + 'experience-detail/events-guest?id=' + id;

        const data = {year:year,month:month,action:action,date:0,guest:1};
        getEventsCalendar(cal_url,data);
        getEventsDates(cal_dates,data);
        getEventsGuests(guest_url,data);
    });

    $(document).on('click','.corona_Active',function (e) {
        e.preventDefault();
        $('#cartPaySection').html(''); //Remove Pay Section
        $('.corona_Active').removeClass('corona_Active_Selected');
        $(this).addClass('corona_Active_Selected');

        var id = $('#showBookDates').data('id');
        var base_url = $('#showBookDates').data('base_url');

        var year = $(this).data('year');
        var month = $(this).data('month');
        var date = $(this).data('date');


        var cal_dates = base_url + 'experience-detail/events-avl-dates?id=' + id;
        const data = {year:year,month:month,date:date,guest:getGuestCount()};
        // guestReset();
        getEventsDates(cal_dates,data);

    });

    $(document).on('click','.guestCalc',function (e) {
        //type = 0=>adult,1=children,2=Infants
        e.preventDefault();
        var id = $(this).data('id');
        var action = $(this).data('action');
        var type = $(this).data('type');

        if(action == 'plus'){
            var current_val = parseInt($('#'+id).val());
            $('#'+id).val(current_val+1);
        }

        if(action == 'minus'){
            var current_val = parseInt($('#'+id).val());
            if(current_val > 1 && type == '0'){
                $('#'+id).val(current_val-1);
            }
            if(current_val > 0 && type != '0'){
                $('#'+id).val(current_val-1);
            }
        }
    });

    $(document).on('click','.guests_shw-save',function (e) {
        e.preventDefault();
        guestSave();

    });

    $(document).on('click','.guests_shw-clear',function (e) {
        e.preventDefault();
        $('#cartPaySection').html(''); //Remove Pay Section
        guestReset();
        filterbyGuest();
    });

    $(document).on('click','.chooseEventDate',function (e) {
        e.preventDefault();
        var event_id = $(this).data('event_id');

        var data = getCommonObject(); //Get from common callback function
        data.event_id = event_id;


        var cal_dates = data.base_url + 'experience-detail/get-event-with-adons?id=' + data.id;
        var cart_url = data.base_url + 'experience-detail/get-event-cart?id=' + data.id;

        getEventWithAdons(cal_dates,data);
        getEventCart(cart_url,data);

    });

    $(document).on('click','.adon_add_to_cart,.adon_remove_to_cart',function (e) {
        e.preventDefault();
        var adon_id = $(this).data('id');
        var is_added = $('.cart_item_input_'+adon_id).val();
        $('.cart_item_input_'+adon_id).val( (is_added == '1'?0:1) );
        var BtnText = (is_added == '1'?'Add to Cart':'Added in card');
        $(this).html(BtnText);
        $(this).toggleClass('adon_add_to_cart');
        $(this).toggleClass('adon_remove_to_cart');


        var event_id = $(this).data('event_id');
        var data = getCommonObject(); //Get from common callback function
        data.event_id = event_id;
        var cart_url = data.base_url + 'experience-detail/get-event-cart?id=' + data.id;
        getEventCart(cart_url,data);
        toastr.remove();
        if(is_added == '0'){
            toastr.success('Item added to cart',"Added");
        }else{
            toastr.success('Item removed from cart',"Removed");
        }
    });

    $(document).on('click','.adon_remove_to_cart_icon',function (e) {
        e.preventDefault();
        var adon_id = $(this).data('id');
        var is_added = $('.cart_item_input_'+adon_id).val();
        $('#list_adon_'+adon_id).html('Add to Cart');
        $('.cart_item_input_'+adon_id).val( (is_added == '1'?0:1) );
        $('#list_adon_'+adon_id).toggleClass('adon_add_to_cart');
        $('#list_adon_'+adon_id).toggleClass('adon_remove_to_cart');

        var event_id = $(this).data('event_id');
        var data = getCommonObject(); //Get from common callback function
        data.event_id = event_id;
        var cart_url = data.base_url + 'experience-detail/get-event-cart?id=' + data.id;
        getEventCart(cart_url,data);

    })


    function getCommonObject(){
        var id = $('#showBookDates').data('id');
        var base_url = $('#showBookDates').data('base_url');

        //Get Guest
        var adult = parseInt($('#guestAdultsInput').val());
        var children = parseInt($('#guestChildrensInput').val());
        var infants = parseInt($('#guestInfantsInput').val());
        var total = (adult+children+infants);

        //Get Adons
        var adons = '';
        $('input[name="cartItem[]"]').map(function (index,ele) {
            if(this.value == '1'){
                adons+=$(this).data('id')+',';
            }
            return true;
        }).get();

        adons = adons.replace(/,\s*$/, "");
        return {id:id,base_url:base_url,adult:adult,children:children,infants:infants,total:total,adons:adons};

    }


    function guestSave(){
        $(".guests-shw-menu").slideToggle();
        var adult = parseInt($('#guestAdultsInput').val());
        var children = parseInt($('#guestChildrensInput').val());
        var infants = parseInt($('#guestInfantsInput').val());
        var total = (adult+children+infants);
        if(total > 1){
            $('#total_guest').html(total+" Guests");
            $('#total_guest').addClass('multipleGuest');
        }else{
            $('#total_guest').html("Guests");
            $('#total_guest').removeClass('multipleGuest');
        }

        var event_id = $('#selectedEvent').val();
        if( typeof(event_id)!='undefined' ){
           filterbyGuest();
        }
    }



    function getGuestCount(){
        var adult = parseInt($('#guestAdultsInput').val());
        var children = parseInt($('#guestChildrensInput').val());
        var infants = parseInt($('#guestInfantsInput').val());
        var total = (adult+children+infants);
        return total;
    }

    function guestReset(){
        $(".guests-shw-menu").slideToggle();
        $('#guestAdultsInput').val(1);
        $('#guestChildrensInput').val(0);
        $('#guestInfantsInput').val(0);
        $('#total_guest').html("Guests");
        $('#total_guest').removeClass('multipleGuest');
    }

    function filterbyGuest(){
        var event_id = $('#selectedEvent').val();
        var data = getCommonObject(); //Get from common callback function
        data.event_id = event_id;
        var cart_url = data.base_url + 'experience-detail/get-event-cart?id=' + data.id;
        getEventCart(cart_url,data);
    }

    //Callback function get calendar
    function getEventsCalendar(url,data) {
        $.ajax({
            url: url,
            type: 'post',
            data: data,
            success: function(response) {
                $('#avalaibleDates').html(response);
            },
            error: function() {
                return false;
            }
        });

    }

    //Callback function get events List
    function getEventsDates(url,data) {
        $.ajax({
            url: url,
            type: 'post',
            data: data,
            success: function(response) {
                $('#avalaibleEvents').html(response);
            },
            error: function() {
                return false;
            }
        });
    }

    //Callback function get guest Toggel button
    function getEventsGuests(url,data) {
        $.ajax({
            url: url,
            type: 'post',
            data: data,
            success: function(response) {
                $('#guestSection').html(response);
            },
            error: function() {
                return false;
            }
        });
    }

    // Callback function get event With Adons
    function getEventWithAdons(url,data){
        $.ajax({
            url: url,
            type: 'post',
            data: data,
            success: function(response) {
                $('#avalaibleEvents').html(response);
            },
            error: function() {
                return false;
            }
        });
    }

    // Callback function get event cart section
    function getEventCart(url,data){
        $.ajax({
            url: url,
            type: 'post',
            data: data,
            success: function(response) {
                $('#cartPaySection').html(response);
            },
            error: function() {
                return false;
            }
        });
    }


})();