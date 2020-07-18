<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=godoexperience',
            'username' => 'root',
            'password' => 'bitcot',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.sendgrid.net',  // e.g. smtp.mandrillapp.com or smtp.gmail.com smtp.sendgrid.net
                'username' => 'gajendra.bitcot',
                'password' => 'Gajendra@7590',
                'port' => '587', // Port 25 is a very common port too
                'encryption' => 'tls', // It is often used, check your provider or mail server specs
            ],
        ],
        'sms' => [
            'class' => 'wadeshuler\sms\twilio\Sms',
            'viewPath' => '@common/sms',
            'useFileTransport' => false,
            'messageConfig' => [
                'from' => '+18168399644',
            ],
            'sid' => 'AC741c972f955d4639abd7dde2a18f7391',
            'token' => '0f0d7304a5f091947dd8b5d636e4759f',
        ]
    ],
];
