<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\helpers\Utils;
use toriphes\lazyload\LazyLoad;
$this->title = 'Booking - My Booking';
?>
  <main class="my-ac-page">
      <!-- My ac Content-->
      <section class="my-ac-content">
          <h1>my account</h1>
          <div class="container">
              <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                      <!-- My Ac list-->
                        <div class="my-ac-list">
                            <ul>
                                <li class="ac-list_Active"><a href="#"><span>Profile</span></a></li>
                                <li><a href="#"><span>Change password</span></a></li>
                                <li><a href="#"><span>order list</span></a></li>
                                <li><a href="#"><span>wishlist</span></a></li>
                            </ul>
                        </div>
                      <!-- // My Ac list-->
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                      <!-- My Ac Ele-->
                      <div class="myac-content-details">
                          <div class="my-ac-title">
                              <h3>Profile</h3>
                          </div>
                          <!-- My Account Profile-->
                            <section class="my-ac-profile">
                                <form action="#">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="myac-profile-img">
                                            <div class="myac-pro-user">
                                                <div class="field-imageUpload">
                                                    <input type="hidden" name="Categories[category_image]" value="">
                                                    <input type="file" id="imageUpload" name="Categories[category_image]">
                                                </div>
                                                <div id="imagePreview" style="background-image: url(../asset/images/background/upload_img.png);">
                                                </div>
                                            </div>
                                            <div class="myac-profile-btn">
                                                <label for="imageUpload" class="btn btn_Primary">Choose Image</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label class="label_Mod">First Name <sub>*</sub> </label>
                                        <input type="text" class="form-control input_Mod">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="label_Mod">Last Name <sub>*</sub> </label>
                                        <input type="text" class="form-control input_Mod">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label class="label_Mod">Email Addres <sub>*</sub> </label>
                                        <input type="email" class="form-control input_Mod">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="label_Mod">Mobile <sub>*</sub> </label>
                                        <input type="text" class="form-control input_Mod">
                                    </div>
                                </div>
                                <div class="my-ac-btn">
                                    <button class="btn_Primary">Submit</button>
                                </div>
                            </form>
                            </section>
                          <!-- // My Account Profile-->

                          <!--My Account Changes Password-->
                           <section class="myac-psw-chnage">
                               <div class="my-ac-title">
                                   <h3>Password change</h3>
                               </div>
                               <form action="#">
                                   <div class="row">
                                       <div class="form-group col-sm-12">
                                           <label class="label_Mod">Current Password <sub>*</sub> </label>
                                           <input type="text" class="form-control input_Mod">
                                       </div>
                                   </div>
                                   <div class="row">
                                       <div class="form-group col-sm-6">
                                           <label class="label_Mod">New Password <sub>*</sub> </label>
                                           <input type="email" class="form-control input_Mod">
                                       </div>
                                       <div class="form-group col-sm-6">
                                           <label class="label_Mod">Confirm Password <sub>*</sub> </label>
                                           <input type="text" class="form-control input_Mod">
                                       </div>
                                   </div>
                                   <div class="my-ac-btn">
                                       <button class="btn_Primary">Submit</button>
                                   </div>
                               </form>
                           </section>
                          <!--My Account Changes Password-->

                          <!--My Account Order list-->
                            <section class="myac-order-list">
                                <div class="my-ac-title">
                                    <h3>Order list</h3>
                                </div>
                                <div class="myac-order-content myaccount-table">
                                    <table class="table table-bordered">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>Order</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Aug 22, 2019</td>
                                            <td>Pending</td>
                                            <td>$3000</td>
                                            <td><a href="#" class="btn_Primary btn__bg">View</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>July 22, 2019</td>
                                            <td>Approved</td>
                                            <td>$200</td>
                                            <td><a href="#" class="btn_Primary btn__bg">View</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>June 12, 2019</td>
                                            <td>On Hold</td>
                                            <td>$990</td>
                                            <td><a href="#" class="btn_Primary btn__bg">View</a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </section>
                          <!--My Account Order list-->


                          <!--My Account Order Wishlist-->
                            <section class="myac-wishlist">
                                <div class="my-ac-title">
                                    <h3>Wishlist</h3>
                                </div>
                                <!-- Row Area -->
                                <div class="row">
                                    <!-- Wishlist Item-->
                                    <div class="col-lg-4">
                                        <div class="rted__Exp--item">
                                            <a href="/godoexperience-php/experience/this-island-is-canada-s-best-kept-secret">
                                                <figure class="rted__Exp--img">
                                                    <!-- Lazy start -->
                                                    <img class="img-responsive lazy" alt="This Island is Canada's Best Kept Secret" data-original="http://localhostC:\htdocs\godoexperience-php/uploads/experiences/4e81934a-c98c-4390-912e-2d85d31c8363.jpeg" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC">                      <!-- Lazy End -->
                                                </figure>
                                                <span class="category_name_title">Adventures</span>
                                                <p title="This Island is Canada's Best Kept Secret">
                                                    This Island is Canada's Best Kept Secret...                </p>
                                                <span class="price__Item--prduct">From $350/ person . 1 day</span>

                                            </a>

                                        </div>
                                    </div>
                                    <!-- // Wishlist Item-->
                                    <!-- Wishlist Item-->
                                    <div class="col-lg-4">
                                        <div class="rted__Exp--item">
                                            <a href="/godoexperience-php/experience/this-island-is-canada-s-best-kept-secret">
                                                <figure class="rted__Exp--img">
                                                    <!-- Lazy start -->
                                                    <img class="img-responsive lazy" alt="This Island is Canada's Best Kept Secret" data-original="http://localhostC:\htdocs\godoexperience-php/uploads/experiences/4e81934a-c98c-4390-912e-2d85d31c8363.jpeg" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC">                      <!-- Lazy End -->
                                                </figure>
                                                <span class="category_name_title">Adventures</span>
                                                <p title="This Island is Canada's Best Kept Secret">
                                                    This Island is Canada's Best Kept Secret...                </p>
                                                <span class="price__Item--prduct">From $350/ person . 1 day</span>

                                            </a>

                                        </div>
                                    </div>
                                    <!-- // Wishlist Item-->
                                    <!-- Wishlist Item-->
                                    <div class="col-lg-4">
                                        <div class="rted__Exp--item">
                                            <a href="/godoexperience-php/experience/this-island-is-canada-s-best-kept-secret">
                                                <figure class="rted__Exp--img">
                                                    <!-- Lazy start -->
                                                    <img class="img-responsive lazy" alt="This Island is Canada's Best Kept Secret" data-original="http://localhostC:\htdocs\godoexperience-php/uploads/experiences/4e81934a-c98c-4390-912e-2d85d31c8363.jpeg" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC">                      <!-- Lazy End -->
                                                </figure>
                                                <span class="category_name_title">Adventures</span>
                                                <p title="This Island is Canada's Best Kept Secret">
                                                    This Island is Canada's Best Kept Secret...                </p>
                                                <span class="price__Item--prduct">From $350/ person . 1 day</span>

                                            </a>

                                        </div>
                                    </div>
                                    <!-- // Wishlist Item-->
                                </div>
                                <!--// Row Area -->
                            </section>
                          <!--My Account Order Wishlist-->

                      </div>
                      <!-- // My Ac Ele-->
                  </div>
              </div>
          </div>
      </section>
      <!-- // My ac Content-->
  </main>

