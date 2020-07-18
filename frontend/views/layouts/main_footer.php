<?php 
use yii\helpers\Html; 
use yii\helpers\Url;
use common\helpers\Utils;  
?>

 <!-- Footer Area Start -->
 <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
          <div class="fter__Item">
            <h5>Go Do Experience</h5>
            <ul class="fter__List">
              <li><a href="<?= Url::to(['/faq']);?>">frequently asked quetions</a></li>
              <li><a href="<?= Url::to(['/about-us']);?>">about us</a></li>
              <li><a href="<?= Url::to(['/contact-us']);?>">contact us</a></li>
              <li><a href="<?= Url::to(['/terms-and-conditions']);?>">terms & conditions</a></li>
              <li><a href="<?= Url::to(['/privacy-policy']);?>">privacy policy</a></li>
            </ul>
          </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
          <div class="fter__Item">
            <h5>Discover</h5>
            <ul class="fter__List">
              <li><a href="#">Trust & Safety</a></li>
              <li><a href="#">Travel Credit</a></li>
              <li><a href="#">Airbnb Citizen</a></li>
              <li><a href="#">Business Travel</a></li>
              <li><a href="#">Things To Do</a></li>
            </ul>
          </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
          <div class="fter__Item">
            <h5>Hosting</h5>
            <ul class="fter__List">
              <li><a href="#">Why Host</a></li>
              <li><a href="#">Hospitality</a></li>
              <li><a href="#">Responsible Hosting</a></li>
              <li><a href="#">Community Centre</a></li>
              <li><a href="#">Host an Experience</a></li>
            </ul>
          </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
          <div class="fter__Item">
            <h5>Support</h5>
            <ul class="fter__List">
              <li><a href="<?= Url::to(['/contact-us']);?>">Help</a></li>
              <li><a href="mailto:info@support.com">info@support.com</a><span>new</span></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="fter__Bottom">
            <div class="fter__Bottom--Coupyrgt"> <span>&copy; <?= date('Y');?> Go Do Experiences, All rights reserved.</span>
              <ul class="fter__Bottom--list">
                <li><a href="<?= Url::to(['/terms-and-conditions']);?>">terms <i class="fa fa-circle" aria-hidden="true"></i></a></li>
                <li><a href="<?= Url::to(['/privacy-policy']);?>">privacy</a></li>
              </ul>
            </div>
            <div class="fter__Social--Item">
              <ul class="list-inline">
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </footer>
  <!-- Footer Area Closed -->