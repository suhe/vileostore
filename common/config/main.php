<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'db' => require(__DIR__ . '/database.php'),
        /*'cache' => [
            'class' => 'yii\caching\FileCache',
        ],*/
        'i18n' => [                                          
            'translations' => [                      
            'app*'=>[
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'id-ID',
                'basePath' => '@common/language',
                'fileMap' => [
                'app' => 'app.php',
                'app/message' => 'message.php'
                    ],
                ],
            ],
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
    ],
    
    'language' => 'id',
    'timeZone' => 'Asia/Jakarta',
];
