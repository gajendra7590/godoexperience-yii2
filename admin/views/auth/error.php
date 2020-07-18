<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

   <div id="main_error_container">
       <h3><?= Html::encode($this->title) ?></h3>

       <div id="error_inner">
           <p>
               The above error occurred while the Web server was processing your request.
           </p>
           <p>
               Please contact us if you think this is a server error. Thank you.
           </p>
           <p>
               <a href="<?php echo \yii\helpers\Url::to(['/dashboard']);?>" class="btn btn-sm btn-info">Back To Home</a>
           </p>
       </div>

   </div>

</div>
<style>
    .admin-alert {
        padding: 1px 42px;
        margin-top: 22px;
    }
    .site-error {
        background: #fff;
        padding: 82px 42px;
    }
    #error_inner {
        margin-top: 21px;
        font-size: 16px;
    }
</style>
