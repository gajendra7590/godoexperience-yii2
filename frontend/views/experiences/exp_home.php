<?php 
use yii\helpers\Html; 
use yii\helpers\Url;
use common\helpers\Utils;
use yii\widgets\ListView; 
use toriphes\lazyload\LazyLoad;  
$this->title = 'Experiences - Home';
?> 

<!-- Features Search Area Start -->
<section class="features__Search" style="background: #000 url(asset/images/background/banner4.jpg);">
    <div class="features__Search__Content">
        <h1>Go Do Experiences are vetted for quality</h1>
<!--        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>-->
        <div class="features__Search__Input features__mod">
        <input class="form-control" placeholder="Search" type="text">
        </div>
        <div class="features__Search__Input">
        <input class="form-control" placeholder="mm/dd/yyyy" type="text">
        <button>Search</button>
        </div>
    </div>
</section> 
<!-- Features Search Area Closed -->

 <!-- main Content Area Start -->
 <main id="main__Content">
    <div class="hm__Block">
      <!-- Activities Category Area Start -->
      <section class="activities__Catgry">
        <div class="container">
          <div class="activities__Catgry--title">
            <h2>One-of-a-kind activities hosted by locals</h2>
          </div>
          <div class="row cst__Row"> 
            <?php if(!empty($top3_categories)){
              foreach($top3_categories as $k => $top3){ ?>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 cst__Col">
                    <div class="activities__Catgry--content">
                      <figure class="activities__Catgry--img"> 
                        <a href="<?= Url::to(['/experiences','category'=>$top3['slug']]);?>">
                           <!-- Lazy start -->
                              <?= LazyLoad::widget(['src' => (($top3['category_image_url']!='')?(Utils::IMG_URL($top3['category_image_url'])):'no-image'),'options'=>[
                                'class'=>'img-responsive',
                                'alt'=>$top3['name']
                              ] ]); ?>
                           <!-- Lazy End --> 
                          <figcation><?= $top3['name'] ;?></figcation>
                        </a> 
                      </figure>
                      <div class="activities__Catgry--link"> 
                        <span class="cat_exp_count"><?= $top3['total_experiences'] ;?>+ Experiences</span>
                        <a href="sub-category.html"><?= $top3['name'] ;?></a>
                        <span> 
                            <?= $top3['title'] ;?>
                        </span> 
                      </div>
                    </div>
                </div> 
              <?php }} ?> 
          </div>

          <div class="clearfix"></div>
          <div class="row cst__Row">
            <div class="col-sm-12 cst__Col">
              <div class="show__all--exp"> 
                <a class="exp__Btn--outline" href="<?= Url::to(['/categories']);?>" title="Show All Categories">
                   Show all <i class="fa fa-angle-right" aria-hidden="true"></i>
                </a>
              </div>
            </div>
          </div>


        </div>
      </section>
      <!-- Activities Category Area Closed -->
      <div class="clearfix"></div>
      <!-- Meet Host World Area Start-->
      <section class="meet__Host--world">
        <div class="container">
          <div class="listing__Title">
            <h3>Meet hosts around the world</h3>
          </div>
          <div class="meet__Host--content cst__Row">
            
            <?php if(!empty($top5_worldarround_exp)){
            foreach($top5_worldarround_exp as $k => $top5){ ?>
              <div class="meet__Host--col cst__Col">
                <div class="meet__Host--item"> 
                  <a href="<?= Url::to(['/experience/'.$top5->slug]);?>">
                    <div class="meet__Host--img"> 
                        <!-- Lazy start -->
                          <?= LazyLoad::widget(['src' => (($top5->experiences_image_url!='')?(Utils::IMG_URL($top5->experiences_image_url)):'no-image'),'options'=>[
                              'class'=>'img-responsive',
                              'alt'=>$top5->title
                           ]]); ?>
                        <!-- Lazy End -->                        
                     </div>
                    <p class="category_name_title"><?= $top5->category->name;?></p>
                    <p class="exp_title"><?= strip_tags($top5->title);?></p>
                    <span>From  <?= Utils::cc().$top5->price;?>/ person . <?= $top5->duration.' '.$top5->duration_type;?></span>
                  </a>
                 </div>
              </div> 
            <?php }} ?> 
          </div>
          <div class="clearfix"></div>
          <div class="row cst__Row">
            <div class="col-sm-12 cst__Col">
              <div class="show__all--exp"> 
                <a class="exp__Btn--outline" href="<?= Url::to(['/experiences']);?>" title="Show All Experiences">
                   Show all <i class="fa fa-angle-right" aria-hidden="true"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Meet Host World Area Closed -->
      <div class="clearfix"></div>
      <!-- Features Exp Area Start -->
      <section class="features__Exp">
        <div class="container">
          <div class="row cst__Row">
            <div class="col-sm-12 cst__Col">
              <div class="listing__Title">
                <h3>Our Features Experience</h3>
              </div>
            </div>
            <div class="features__Exp--content">
              <?php if(!empty($top4_featured_exp)){
              foreach($top4_featured_exp as $k => $top4){ ?>

                <div class="cst__Col col-xs-6 col-sm-6 col-md-4 col-lg-3">
                  <div class="features__Exp--item"> 
                    <a href="<?= Url::to(['/experience/'.$top4->slug]);?>">
                      <div class="features__Exp--img">  
                        <!-- Lazy start -->
                        <?= LazyLoad::widget(['src' => (($top4->experiences_image_url!='')?(Utils::IMG_URL($top4->experiences_image_url)):'no-image'),'options'=>[
                            'class'=>'img-responsive',
                            'alt'=>$top4->title
                        ]]); ?>
                        <!-- Lazy End -->
                        </div>
                        <p class="category_name_title"><?= $top4->category->name;?></p>
                        <div class="features__Exp--details">
                          <div class="features__Exp--title">
                              <?= $top4->title;?>
                          </div>
                          <div class="features__Exp--rating"> <i class="fa fa-star" aria-hidden="true"></i>
                            <span>4.97</span>
                          </div>
                        </div>
                    </a>
                       <span class="price__Item--prduct">From <?= Utils::cc().$top4->price;?>/ person . <?= $top4->duration.' '.$top4->duration_type;?></span>
                  </div>
                </div>

              <?php }} ?> 
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="row cst__Row">
            <div class="col-sm-12 cst__Col">
              <div class="show__all--exp"> 
                <a class="exp__Btn--outline" href="<?= Url::to(['/experiences']);?>" title="Show All Experiences">
                  Show all <i class="fa fa-angle-right" aria-hidden="true"></i> 
                </a>
              </div>
            </div>
          </div>
        </div>
      </section>
      <div class="clearfix"></div>
      <!-- Features Exp Area Closed -->
      <!-- Top Rated Exp Area Start -->
      <section class="rted__Exp">
        <div class="container">
          <div class="listing__Title">
            <h3>Top-rated experiences</h3>
          </div>
          <div class="rted__Exp--content cst__Row">

          <?php if(!empty($top6_rated_exp)){
              foreach($top6_rated_exp as $k => $top6){ ?>
             
            <div class="rted__Exp--col cst__Col">
              <div class="rted__Exp--item"> 
                <a href="<?= Url::to(['/experience/'.$top6->slug]);?>">
                   <figure class="rted__Exp--img">  
                       <!-- Lazy start -->
                       <?= LazyLoad::widget(['src' => (($top6->experiences_image_url!='')?(Utils::IMG_URL($top6->experiences_image_url)):'no-image'),'options'=>[
                                'class'=>'img-responsive',
                                'alt'=>$top6->title
                              ]   ]); ?>
                       <!-- Lazy End --> 
                    </figure>
                    <p class="category_name_title"><?= $top6->category->name;?></p>
                    <p><?= $top6->title;?></p>
                </a>
                <span class="price__Item--prduct">From <?= Utils::cc().$top6->price;?>/ person . <?= $top6->duration.' '.$top6->duration_type;?></span>
              </div>
            </div>

          <?php }} ?>  

          </div>
          <div class="clearfix"></div>
          <div class="row cst__Row">
            <div class="col-sm-12 cst__Col">
              <div class="show__all--exp"> 
                <a class="exp__Btn--outline" href="<?= Url::to(['/experiences']);?>" title="Show All Experiences">
                  Show all <i class="fa fa-angle-right" aria-hidden="true"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Top Rated Exp Area Closed -->
      <div class="clearfix"></div>
      <!-- Home Client Area Start -->
      <section class="hm__Client">
        <div class="container">
          <div class="row cst__Row">
            <div class="owl-carousel owl-theme hm__Client--crusel">
             <?php if( isset($testimonials)) {  
                   foreach($testimonials as $tm){
                ?> 
              <div class="item">
                <div class="testimonial-box">
                     <div class="cm-testimonials-slider__quote-wrapper">
                     <img src="<?= Url::to('@web/asset/images/thumnails/quote-green.png');?>"
                      class="cm-testimonials-slider__quote">
                      </div>
                  <div class="testimonial-inner">
                    <div class="testimonial-pic">
                     <img src="<?= ($tm['client_image']!='')?(Utils::IMG_URL($tm['client_image'])):'no-image';?>">
                    </div>
                    <div class="clear-fix"></div>
                    <div class="testimonial-text">
                      <div class="user-name"><?= ( isset($tm['client_name']))?$tm['client_name']:'--';?>
                        <div class="clear-fix"></div>
                        <span><?= ( isset($tm['client_position']))?$tm['client_position']:'--';?> </span> </div>
                        <?= ( isset($tm['client_message']))?$tm['client_message']:'--';?>
                    </div>
                  </div>
                </div>
              </div> 
            <?php }} ?>
            </div>
          </div>
        </div>
      </section>
      <!-- Home Client Area Closed -->
    </div>
  </main>
  <!-- main Content Area Closed -->