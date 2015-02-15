<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'db' => require(__DIR__ . '/database.php'),
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'i18n' => [                                          
            'translations' => [                      
            'app*'=>[
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'id-ID',
                'basePath' => '@common/language',
                'fileMap' => [
                'app' => 'App.php',
                'app/message' => 'Message.php'
                    ],
                ],
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'mail.vileo.co.id',
                'username' => 'sales@vileo.co.id',
                'password' => 'admin',
                'port' => '587',
            ],    
        ],
        'mail' => [
            'class' => 'common\models\Mail',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'RhLqcR79Fcg9GUBYSQa9R9BzTfo7htK-',
        ],
        'store' => [
            'class' => 'common\helpers\App',
        ],
    ],
    'aliases' => [
        '@assets' =>  realpath(dirname(__FILE__).'/../../').'/assets/',
        '@image_product' => '@assets/images/products/',
        '@image_brand'   => '@assets/images/brands/',
        '@image_banner'  => '@assets/images/banners/',
        '@image_courier' => '@assets/images/couriers/',
        '@image_bank' => '@assets/images/banks/',
    ],
    
    'language' => 'id',
    'timeZone' => 'Asia/Jakarta',
];
