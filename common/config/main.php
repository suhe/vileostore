<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'db' => require(__DIR__ . '/database.php'),
        /*'cache' => [
            'class' => 'yii\caching\FileCache',
        ],*/
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'RhLqcR79Fcg9GUBYSQa9R9BzTfo7htK-',
        ],
        'urlAsset' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => '@web',
            'enablePrettyUrl' => true,
            'showScriptName' => true,
            'rules' => []
        ],
    ],
    'aliases' => [
        '@assets' =>  realpath(dirname(__FILE__).'/../../').'/assets/',
        '@image_product' => '@assets/images/products/', 
    ],
];
