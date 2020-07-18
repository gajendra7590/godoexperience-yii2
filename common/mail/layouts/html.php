<?php
use yii\helpers\Html;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <?php $this->head() ?>

    <style>
        @import url("https://fonts.googleapis.com/css?family=Poppins:400,500,100%,700&display=swap");
        @media only screen and (max-width:600px) {
            td[class=head-title] {
                font-size: 24px !important;
                padding-bottom: 10px !important;
                line-height: 32px !important;
            }
            div[class=mb_View] {
                width: 96% !important;
                padding-left: 2%;
                padding-right: 2%;
            }
            table[class=order-list],
            table[class=billing-info] {
                width: 100% !important;
            }
        }

        @media only screen and (max-width:480px) {
            td[class=head-title] {
                font-size: 18px !important;
            }
            img[class=logo_img] {
                width: 185px !important;
            }
        }

        table[class=order-list],
        table[class=billing-info] {
            margin: 0 auto;
            border: 1px solid #ddd;
        }
        table[class=billing-info] {
            border: 1.5px solid #ddd;
            padding: 15px;
        }

        table[class=order-list] thead tr {
            border-bottom-width: 2px;
        }

        table[class=order-list] thead tr th,
        table[class=order-list] tbody tr td,
        table[class=order-list] tfoot tr td,
        table[class=order-list] tfoot tr th {
            border: 1px solid #ddd;
            padding: 8px
        }

        table[class=order-list] tfoot:first-child tr {
            border-top: 1px solid red !important;
        }

        table[class=order-list] tfoot:first-child>tr:first-child>th table[class=order-list] tfoot:first-child>tr:first-child>td {
            border-top-width: 2px !important;
        }

        table[class=order-list] thead tr td > small {
            margin-left: 8px;
            text-transform: capitalize;
        }
    </style>

</head>
<body style="margin:0; padding:0; font-family: 'Montserrat', sans-serif !important; color:#484848;bgcolor='#f4f4f4'">
    <?php $this->beginBody() ?>
    <?= $content ?>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
