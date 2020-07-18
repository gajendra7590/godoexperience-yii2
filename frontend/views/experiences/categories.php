<?php 
use yii\helpers\Html; 
use yii\helpers\Url;
use common\helpers\Utils;
use toriphes\lazyload\LazyLoad; 
$this->title = 'Experiences - Categories List';

?>

  <!-- Features Category Area Start -->
  <section class="features__Search sub__Category--banner" style="background: #000 url(<?= ( isset($sinle_cat->category_image_url) )?(Utils::IMG_URL($sinle_cat->category_image_url)):(Url::to(['/asset/images/background/sub-category.jpg']));?>);">
    <div class="features__Search__Content">
      <h1><?= (isset($sinle_cat->title))?$sinle_cat->title:'';?></h1>
      <p><?= (isset($sinle_cat->description))?substr(strip_tags($sinle_cat->description),0,200):'';?></p>
    </div>
  </section>
  <!-- Features Category Area Closed -->
  
  <!-- main Content Area Start -->
  <main id="main__Content">
    <!-- Sub Ctgry About Area Start -->
    <section class="sub__Ctgry--abut">
      <div class="container">
        <div class="row cst__Row">
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-5">
            <div class="sub__Abut--title">
              <h2><?= isset($sinle_cat->title)?$sinle_cat->title:'' ?></h2>
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-7">
            <div class="sub__Abut--content">
              <p><?= (isset($sinle_cat->description))?substr(strip_tags($sinle_cat->description),0,200):'';?></p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Sub Ctgry About Area Closed -->
    <div class="clearfix"></div>
    <!-- Features Exp Area Start --> 
    <section class="features__Exp">
      <div class="container">
        <div class="listing__Title">
          <h3>Our Features Categories</h3>
        </div>
        <div class="features__Exp--content">
          <div class="row cst__Row">
          <?php if(!empty($featured_cat)){
            foreach($featured_cat as $k => $featured){ ?>
            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 cst__Col"> 
              <div class="features__Exp--item">
                <a href="<?= Url::to(['/experiences','category'=>$featured['slug']]);?>">
                  <div class="features__Exp--img">  
                     <!-- Lazy start -->
                     <?= LazyLoad::widget(['src' => (($featured['category_image_url']!='')?(Utils::IMG_URL($featured['category_image_url'])):'no-image'),'options'=>[
                        'class'=>'img-responsive',
                        'alt'=>$featured['name']
                      ] ]); ?>
                      <!-- Lazy End --> 
                  </div>
                  <div class="exp_count category_name_title"><?= $featured['total_exp'];?>+ Experiences </div>
                  <div class="features__Exp--details">
                    <div class="features__Exp--title" title="<?= $featured['title'];?>">
                       <?= $featured['name'] ;?>
                    </div>
                    <div class="features__Exp--rating"> <i class="fa fa-star" aria-hidden="true"></i><span>4.87</span>
                    </div>
                  </div>
                </a>
                <!-- <span class="price__Item--prduct">$ 250</span> -->
              </div>
            </div> 
         <?php }} ?> 

          </div>
    </section> 
    <div class="clearfix"></div>
    <!-- Features Exp Area Closed -->
    <!-- Top Rated Exp Area Start -->
    <section class="rted__Exp">
      <div class="container">
        <div class="listing__Title">
          <h3>All Other Categories</h3>
        </div>
        <div class="rted__Exp--content cst__Row"> 

        <?php if(!empty($all_cat)){
         foreach($all_cat as $k => $ac){ ?>

          <div class="rted__Exp--col cst__Col">
            <div class="rted__Exp--item">
              <a href="<?= Url::to(['/experiences','category'=>$ac['slug']]);?>">
                <figure class="rted__Exp--img">  
                     <!-- Lazy start -->
                     <?= LazyLoad::widget(['src' => (($ac['category_image_url']!='')?(Utils::IMG_URL($ac['category_image_url'])):'no-image'),'options'=>[
                        'class'=>'img-responsive',
                        'alt'=>$ac['name']
                      ] ]); ?>
                      <!-- Lazy End --> 
                </figure>
                <div class="exp_count category_name_title"><?= $ac['total_exp'];?>+ Experiences </div>
                <p title=""><?= $ac['name'];?></<p>
              </a>
              <!-- <span class="price__Item--prduct">$ 250</span> -->
            </div>
          </div>

        <?php }} ?>
        </div>
      </div>
    </section>
    <!-- Top Rated Exp Area Closed -->
  </main>
  <!-- main Content Area Closed --