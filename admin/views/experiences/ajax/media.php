<?php 
use yii\helpers\Url;
use common\helpers\Utils;


if(isset($media_images) && (!empty($media_images)) ){
foreach($media_images as $m){  ?> 

    <div class="col-xs-6 col-sm-4 col-md-4 col-lg-3 image-div-main">
        <div class="image-wrpper image-div">
            <img src="<?php echo Utils::IMG_URL($m['image_url']);?>" alt="Media Image">
            <a href="javascript:void(0);" class="removeMediaImage"
                data-exp_id = "<?php echo $m['experiences_id'];?>"
                data-img="<?php echo $m['image_name'];?>"
                data-media_id="<?php echo $m['id'];?>" >
                <i class="fa fa-times" aria-hidden="true"></i>
            </a>
        </div>
    </div> 

<?php } } else if( isset($single_upload)){ ?>
    <div class="col-xs-6 col-sm-4 col-md-4 col-lg-3 image-div-main">
        <div class="image-wrpper image-div">
            <img src="<?php echo  Utils::IMG_URL($single_upload['img']);?>" alt="Media Image">
            <?php if( isset($single_upload['action_type']) && ($single_upload['action_type'] == 'insert') ){ ?>
                <input type="hidden" name="media_image[<?php echo $single_upload['image_name'];?>]" value="<?php echo $single_upload['image_name'];?>">
            <?php } ?>
            <a href="javascript:void(0);" class="removeMediaImage"
                        data-exp_id = "<?php echo $single_upload['exp_id'];?>"
                        data-img="<?php echo $single_upload['image_name'];?>"
                        data-media_id="<?php echo $single_upload['media_id'];?>" 
                    >
                <i class="fa fa-times" aria-hidden="true"></i>
            </a>
        </div>
    </div>  
<?php }?>
