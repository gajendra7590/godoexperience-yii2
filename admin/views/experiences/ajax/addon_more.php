<?php
use yii\helpers\Url;
?>
<?php if(isset($addons)){
  foreach($addons as $k => $data){ ?>
    <?php $time = rand(111111,999999); ?>

        <div class="row remove_parent">
            <div class="col-xs-12 col-sm-4 col-md-12 col-lg-4">
                <div class="form-group">
                    <label class="control-label" for="name">Name</label>
                    <input type="text" value="<?php echo $data['name'];?>" name="add_ons[<?php echo $time;?>][name]" class="form-control input_modifier addon_name input_<?=$time;?>" placeholder="Enter Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-12 col-lg-3">
                <div class="form-group">
                    <label class="control-label" for="description">Description</label>
                    <input type="text" value="<?php echo $data['description'];?>" name="add_ons[<?php echo $time;?>][description]" class="form-control input_modifier addon_desc input_<?=$time;?>" placeholder="Enter Description">
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-1 2 col-lg-2">
                <div class="form-group">
                    <label class="control-label" for="price">Price</label>
                    <input type="text" value="<?php echo $data['price'];?>" name="add_ons[<?php echo $time;?>][price]" class="form-control input_modifier addon_price input_<?=$time;?>" placeholder="Enter Price">
                    <input type="hidden" name="add_ons[<?php echo $time;?>][action_type]" id="action_type_<?php echo $time;?>" value="update" class="form-control input_modifier">
                    <input type="hidden" name="add_ons[<?php echo $time;?>][is_deleted]" id="is_deleted_<?php echo $time;?>" value="0" class="form-control input_modifier">
                    <input type="hidden" name="add_ons[<?php echo $time;?>][id]" id="id_<?php echo $time;?>" value="<?php echo $data['id'];?>" class="form-control input_modifier">
                </div> 
            </div>
            <div class="col-xs-12 col-sm-3 col-md-12 col-lg-2">
                <div class="form-group">
                    <label class="control-label" for="experiences-title">&nbsp;</label> 
                    <a type="submit" data-bs_url="<?php echo Url::to(['/experiences/check-adons']);?>" data-id="<?php echo $data['id'];?>" data-exp_id="<?php echo isset($data['experiences_id'])?$data['experiences_id']:'';?>" data-time="<?php echo $time;?>" class="btn btn-danger cst_btn mr-10 addon-btn-remove">
                        <i class="fa fa-times" aria-hidden="true"></i> Remove
                    </a>
                </div> 
            </div>
        </div>
<?php }} else { ?>
    <?php $time = rand(111111,999999); ?>
        <div class="row remove_parent">
            <div class="col-xs-12 col-sm-4 col-md-12 col-lg-4">
                <div class="form-group">
                    <label class="control-label" for="name">Name</label>
                    <input type="text" name="add_ons[<?php echo $time;?>][name]" class="form-control input_modifier addon_name input_<?=$time;?>" placeholder="Enter Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-12 col-lg-3">
                <div class="form-group">
                    <label class="control-label" for="description">Description</label>
                    <input type="text" name="add_ons[<?php echo $time;?>][description]" class="form-control input_modifier addon_desc input_<?=$time;?>" placeholder="Enter Description">
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-12 col-lg-2">
                <div class="form-group">
                    <label class="control-label" for="price">Price</label>
                    <input type="text" name="add_ons[<?php echo $time;?>][price]" class="form-control input_modifier addon_price input_<?=$time;?>" placeholder="Enter Price">
                    <input type="hidden" name="add_ons[<?php echo $time;?>][action_type]" id="action_type_<?php echo $time;?>" value="new" class="form-control input_modifier">
                    <input type="hidden" name="add_ons[<?php echo $time;?>][is_deleted]" id="is_deleted_<?php echo $time;?>" value="0" class="form-control input_modifier">
                    <input type="hidden" name="add_ons[<?php echo $time;?>][id]" id="id_<?php echo $time;?>" value="0" class="form-control input_modifier">
                </div> 
            </div>
            <div class="col-xs-12 col-sm-3 col-md-12 col-lg-2">
                <div class="form-group">
                    <label class="control-label" for="experiences-title">&nbsp;</label> 
                    <a type="submit" data-bs_url="" data-id="0" data-exp_id="0" data-time="<?php echo $time;?>" class="btn btn-danger cst_btn mr-10 addon-btn-remove">
                        <i class="fa fa-times" aria-hidden="true"></i> Remove
                    </a>
                </div> 
            </div>
        </div>
<?php } ?>