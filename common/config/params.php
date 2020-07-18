<?php
use common\helpers\Utils;


return [
    'appName' => 'GoDo Experiences',    
    'supportEmail' => 'support@godoexperience.com',
    'senderEmail' => 'noreply@godoexperience.com',
    'senderName' => 'Go Do Experiences',
    'adminEmail' => 'admin@godoexperience.com', 
    'user.passwordResetTokenExpire' => 3600,
    'social_link' => [
        'google'=> 'www.google.com',
        'facebook'=> 'www.facebook.com',
        'twitter'=> 'www.twitter.com',
        'linkedin'=> 'www.linkedin.com'
    ],
    //Below all params for email template
    'contact_us' => Utils::IMG_URL('contact-us'),
    'about_us' => Utils::IMG_URL('about-us'),
    'faq' => Utils::IMG_URL('faq'),
    'logo_icon' => Utils::IMG_URL('uploads/email/godo_logo.png'),
    'need_help_icon' => Utils::IMG_URL('uploads/email/need-help.png'),
    'facebook_icon' => Utils::IMG_URL('uploads/email/icn_facebook.png'),
    'linkedin_icon' => Utils::IMG_URL('uploads/email/icn_linkedin.png'),
    'twitter_icon' => Utils::IMG_URL('uploads/email/icn_twitter.png'),
    'google_icon' => Utils::IMG_URL('uploads/email/icn_google.png') 
];
