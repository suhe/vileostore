<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'lDWr3LYiq6P5JXitDnpnUeMSI3Nsa3Pp',
        ],
        
    ],
    'aliases' => [
        '@images' => dirname(dirname(__DIR__)) . '/assets/images',
    ],
];
