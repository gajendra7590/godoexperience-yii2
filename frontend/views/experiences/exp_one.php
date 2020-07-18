<?php 
use yii\helpers\Html; 
use yii\helpers\Url;
use common\helpers\Utils;
use toriphes\lazyload\LazyLoad; 
$this->title = 'Experiences - Experience Detail';
?>   
  <!-- Single page slide Area Start -->
  <section class="sp__Slide">
    <div class="owl-carousel owl-theme sp__Slide--ele">
        <?php if( isset($experince_media) && (count($experince_media) > 0)){
            foreach ($experince_media as $media){ ?>
              <div class="item">
                <div class="slide__Item-img">
                  <a href="<?= Utils::IMG_URL($media);?>" data-lightbox="gallery">
                    <img src="<?= Utils::IMG_URL($media);?>" alt="slide">
                  </a>
                </div>
              </div>
        <?php }} ?>
    </div>
  </section>
  <!-- Single page slide Area Closed -->
  
<!-- main Content Area Start -->
<main id="main__Content">
    <section class="sp__Prduct">
      <div class="container">
        <!-- row block start -->
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-7 col-lg-9">
            <!-- sp Product content Start -->
                <div class="sp__Prduct--content">
                   <?= isset($experience_detail->description)?$experience_detail->description:'';?>
                </div>
            <!-- sp Product content Closed -->
          </div>

          <div class="col-xs-12 col-sm-12 col-md-5 col-lg-3">
            <!-- sp Product Booking Area Start -->
            <div class="sp__Prduct--booking">
              <h2>book now</h2>
              <div class="bking__Date--selct">
                <div class="form-group">
                  <label class="label_Mod">Select Date</label>
                  <input type="text" class="form-control input_Mod date-Mod" placeholder="mm/dd/yyyy">
                </div>
              </div>
              <!-- booking list select Area Start -->
              <div class="bking__list--select">
              <?php if( ($experience_adons) && $experience_adons!=NULL){
                foreach($experience_adons as $k => $item){ ?>

                <!-- booking item select Area Start -->
                <div class="bking__item--select">
                  <div class="bking__item--title">
                    <?= $item['name'];?>
                  </div>
                  <div class="bking__item--body">
                    <div class="bking__item-doller">
                      <?= Utils::cc().$item['price'];?>
                    </div>
                    <div class="bking__item-select booking__Filp" data-id="booking__Pannel_<?= $k;?>" id="booking__Filp_<?= $k;?>">
                      <a href="javascript:void(0)" class="form-control input_Mod select_Mod ">
                        select
                      </a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="bking__item-panel clearfix booking__Pannel" id="booking__Pannel_<?= $k;?>">
                      <h5><?= $item['name'];?></h5>
                      <div class="qty__group">
                        <input type="button" value="-" class="qty-minus">
                        <input type="text" value="1" class="form-control qty-num" class="qty">
                        <input type="button" value="+" class="qty-plus">
                      </div>
                      <div class="qty__group--btn">
                        <a href="javascript:void(0)" class="exp__Btn--primary">Add to Cart</a>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- booking item select Area Closed -->

                <?php }} ?>

              </div>
              <!-- booking list select Area Closed -->
              <!-- Booking your cart Area Start -->
              <div class="bking__Your--cart">
                <h2>Your Cart</h2>
                <!-- Booking your cart item Area Start -->
                <div class="your__Cart--item">
                  <h3>February 25, 2020</h3>
                  <ul>
                    <li>
                      <span>Day Pass - adult ($20)</span>
                      <a href="javascript:void(0)" class="remove-link"><i class="fa fa-times"
                          aria-hidden="true"></i></a>
                    </li>
                    <li>
                      <span>Day Pass - adult ($20)</span>
                      <a href="javascript:void(0)" class="remove-link"><i class="fa fa-times" aria-hidden="true"></i>
                      </a>
                    </li>
                    <li>
                      <span>Day Pass - adult ($20)</span>
                      <a href="javascript:void(0)" class="remove-link"><i class="fa fa-times" aria-hidden="true"></i>
                      </a>
                    </li>
                  </ul>
                  <div class="Your__Cart--btn">
                    <a class="exp__Btn--outline" href="javascript:void(0)">Book Now <i class="fa fa-angle-right"
                        aria-hidden="true"></i></a>
                  </div>
                </div>
                <!-- Booking your cart item Area Closed -->
              </div>
              <!-- Booking your cart Area Closed -->
            </div>
            <!-- sp Product Booking Area Closed -->
          </div>
        </div>
        <!-- row block end  -->
      </div>
    </section>
  </main>
  <!-- main Content Area Closed -->