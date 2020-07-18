<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

use \yii\web\Request;
$baseUrl = str_replace('/frontend/web', '', (new Request)->getBaseUrl());

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers', 
    'components' => [        
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => $baseUrl,
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'auth/error',
        ],
        'urlManager' => [
            'baseUrl' => $baseUrl,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [  
                'login' => 'auth/login',  
                'register' => 'auth/register',
                'forgot-password' => 'auth/forgot-password',
                'reset-password' => 'auth/reset-password',
                'verify-email' => 'auth/verify-email', 
                'logout' => 'auth/logout',
                'social/auth' => 'auth/auth', //Route for only Social Loign
                ''=>'home/index',
                'home'=>'home/index',
                'about-us' => 'home/about-us',
                'contact-us' => 'home/contact-us',
                'privacy-policy' => 'home/privacy-policy',
                'terms-and-conditions' => 'home/terms-and-conditions',
                'faq' => 'home/faq',
                'experiences'=>'experiences/experiences',
                'experience/<slug:[A-Za-z0-9 -_.]+>'=>'experience-detail/experience',
                'categories'=>'category/index',
                'my-account'=>'my-account/index',
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',                
            ],
        ], 
        'authClientCollection' => [ //social login
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'google' => [
                    'class' => 'yii\authclient\clients\Google',
                    'clientId' => '1046795477332-3j6m2r843m2d8p60atout1qpse3f25kp.apps.googleusercontent.com',
                    'clientSecret' => 'O47RwAssgxTyErR4-xMGZ4BJ',
                    'returnUrl' => 'http://localhost/godoexperience-php/social/auth?authclient=google',
                ] 
            ],
        ],
        //This is only for server
        /*'authClientCollection' => [ //social login
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'google' => [
                    'class' => 'yii\authclient\clients\Google',
                    'clientId' => '413998578861-lg72oe3kl03j8ks0dfeu8g5g6fsbkt1p.apps.googleusercontent.com',
                    'clientSecret' => 'KKW7iYDAzy-jMJlQaJu6_nrb',
                    'returnUrl' => 'https://godo.bitcotapps.com/social/auth?authclient=google',
                ]
            ],
        ],*/
        'stripe' => [  //For Strip Payment
            'class' => 'ruskid\stripe\Stripe',
            'publicKey' => "pk_test_4XP2DS4TJJ4V5LPgjF0fmTOw00w165HlbK",
            'privateKey' => "sk_test_OJepHGO3On5Lumo8Zu8q79T300fgj4sG2W",
        ],
        'socialShare' => [
            'class' => \ymaker\social\share\configurators\Configurator::class,
            'socialNetworks' => [
                '<span class="facebook">Facebook</span>' => [
                    'class' => \ymaker\social\share\drivers\Facebook::class,
                    //'label' => \yii\helpers\Html::tag('i', '', ['class' => 'fa fa-facebook-square']),
                ],
                '<span class="twitter">Twitter</span>' => [
                    'class' => \ymaker\social\share\drivers\Twitter::class,
                    //'label' => \yii\helpers\Html::tag('i', '', ['class' => 'fa fa-twitter']),
                ],
                '<span class="pinterest">Pinterest</span>' => [
                    'class' => \ymaker\social\share\drivers\Pinterest::class,
                    ///'label' => \yii\helpers\Html::tag('i', '', ['class' => 'fa fa-pinterest']),
                ],
                '<span class="linkedIn">LinkedIn</span>' => [
                    'class' => \ymaker\social\share\drivers\LinkedIn::class,
                    //'label' => \yii\helpers\Html::tag('i', '', ['class' => 'fa fa-linkedin']),
                ],
                '<span class="whatsapp">WhatsApp</span>' => [
                    'class' => \ymaker\social\share\drivers\WhatsApp::class,
                    //'label' => \yii\helpers\Html::tag('i', '', ['class' => 'fa fa-whatsapp']),
                ],
                '<span class="telegram">Telegram</span>' => [
                    'class' => \ymaker\social\share\drivers\Telegram::class,
                   // 'label' => \yii\helpers\Html::tag('i', '', ['class' => 'fa fa-telegram']),
                ],
            ],
        ],
    ],
    'params' => $params,
];
