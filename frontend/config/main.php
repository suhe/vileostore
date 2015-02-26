<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/params.php')
);


use \yii\web\Request;
$baseUrl = str_replace('/frontend/web', '/cgi-bin', (new Request)->getBaseUrl());
return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'RhLqcR79Fcg9GUBYSQa9R9BzTfo7htK-',
            'baseUrl' => $baseUrl,
        ],
        'urlManager' => [
            'baseUrl' => $baseUrl,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller:\w+>/<action:\w+>/<id:\d+>/<slug>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                //'product/category/<id:\d+>/<slug:[-a-zA-Z]+>' => 'product/category/',
                //'product/read/<id:\d+>/<slug:[-a-zA-Z]+>' => 'product/read/',
                //'controller/<page:\d+>' => 'controller/index',
                //'<id:\d+>/<title>/*' => 'category/view/id/<id>',
                //'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                //'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
               //'<controller:\w+>/<id:\d+>/<slug:[-a-zA-Z]+>' => '<controller>/<action>',
                //'<controller:\w+>/<slug:[a-zA-Z0-9-]+>'=>'<controller>/index',
            ],
            'suffix' => '.html',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
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
            'errorAction' => 'site/error',
        ],
    ],
    'homeUrl' => str_replace('/cgi-bin', '',$baseUrl),
    'params' => $params,
];
