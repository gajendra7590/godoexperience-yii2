$('.viewOrderSummary').click(function (e) {
    e.preventDefault();
    var url = $(this).attr('href');

    if ($('#orderDetailModal').data('bs.modal').isShown) {
        $('#orderDetailModal').find('#modalContent')
            .load(url);
    } else {
        //if modal isn't open; open it and load content
        $('#orderDetailModal').modal('show')
            .find('#modalContent')
            .load(url);
    }


})