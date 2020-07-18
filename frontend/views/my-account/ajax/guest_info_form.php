<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use common\helpers\Utils;
?>
<main class="order-Summary">
<!-- Order Details-->
<section class="order_Details">
<div class="container">
    <div class="order_ele">
        <div class="row">
            <div class="col-sm-12">
                <div class="order_ele-wrap">
                    <h2 class="order-ele-heading">Order <span>#<?= isset($orderDetail['id'])?$orderDetail['id']:0;?></span></h2>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <!--Order Details Contetn-->
                <div class="order_details-content">
                    <h3 class="order-gest-heading">Guest List</h3>
                    <div class="table-responsive order-Tbl-cst">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email Id</th>
                                <th>Gender</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($guests) && count($guests)){
                                foreach ($guests as $k =>  $gst){ ?>
                                    <tr>
                                        <td><?= $k+1;?></td>
                                        <td><?= ($gst['first_name'])?$gst['first_name']:'--';?></td>
                                        <td><?= ($gst['last_name'])?$gst['last_name']:'--';?></td>
                                        <td><?= ($gst['email'])?$gst['email']:'--';?></td>
                                        <td><?= ($gst['gender'])?$gst['gender']:'--';?></td>
                                    </tr>
                                <?php }} ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="text-danger">Note : * (--) means you have not given the guest detail who is comming. </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <?php

            if( isset($orderDetail) && (!empty($orderDetail))){
            $status = 0;
            if( date('Y-m-d',strtotime($orderDetail['experience_end_date'])) >= date('Y-m-d')){
                $status = 1;
            }
            if( (isset($guests)) && (count($guests) > 1) && ($status == '1') ){ ?>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <!--Order Details Contetn-->
                <div class="order_details-content manage-guest-myac">
                    <h3 class="order-gest-heading">Manage Guest Detail</h3>
                    <div class="order-Tbl-cst">
                        <?php $form = ActiveForm::begin([
                            'id'=>'orderGuestsForm',
                            'action' => Url::to(['/order/guest-save','id'=>$orderDetail['id']]),
                            'options' => ['enctype' => 'multipart/form-data','data-base_url'=>Url::to(['/'])]
                        ]); ?>

                        <div class="Gest-details-frm">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="label_modifier">Your phone number <span class="text-danger">*</span></label>
                                    <input type="text" name="phone_number" value="<?= $orderDetail['phone_number'];?>" class="form-control input_modifier phone_number_input" placeholder="Please enter phone">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="order_id" value="<?= $orderDetail['id'];?>">
                            <?php $k = 0;
                            foreach ($guests as $guest){
//                                if($guest['booked_self'] == 0){ ?>
                                <div class="Gest-details-item">
                                    <h5>Guest <?= $k+1;?></h5>
                                    <div class="Gest-details-frm">
                                        <div class="row">
                                            <input name="guest[<?= $k;?>][id]" type="hidden" value="<?= $guest['id'];?>">
                                            <div class="form-group col-sm-3">
                                                <label class="label_modifier">First name <span class="text-danger">*</span></label>
                                                <input name="guest[<?= $k;?>][first_name]" type="text" value="<?= $guest['first_name'];?>" class="form-control input_modifier first_name_input" placeholder="Please first name..">
                                            </div>
                                            <div class="form-group col-sm-3">
                                                <label class="label_modifier">Last name <span class="text-danger">*</span></label>
                                                <input name="guest[<?= $k;?>][last_name]" type="text" value="<?= $guest['last_name'];?>" class="form-control input_modifier last_name_input" placeholder="Please last name..">
                                            </div>
                                            <div class="form-group col-sm-3">
                                                <label class="label_modifier">Email <span class="text-danger">*</span></label>
                                                <input name="guest[<?= $k;?>][email]" type="text" value="<?= $guest['email'];?>" class="form-control input_modifier email_input" placeholder="Please enter email..">
                                            </div>
                                            <div class="form-group col-sm-3">
                                                <label class="label_modifier">Gender <span class="text-danger">*</span></label>
                                                <select name="guest[<?= $k;?>][gender]" class="form-control input_modifier select_Mod gender_input">
                                                    <option value="male" <?= ($guest['gender'] == 'male')?'selected="selected"':'';?>>Male</option>
                                                    <option value="female" <?= ($guest['gender'] == 'female')?'selected="selected"':'';?>>Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php $k = $k+1; } }?>
                            <div class="btn-guest-thank">
                                <button type="submit" id="guestDetailFormBtn" class="btn_Primary">Save Guest Detail</button>
                            </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
            <?php }  ?>
    </div>
</div>
</section>
</main>

<script>

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
                         $('#orderDetailModal').modal('toggle');
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
</script>