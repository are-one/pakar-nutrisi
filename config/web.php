<?php

$params = require __DIR__ . '/params.php';
$before_action = require __DIR__ . '/before_action.php';
$db = require __DIR__ . '/db.php';
$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '2lFr5tVHhkM9JpariUOPyl43clzDZ7KE',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'app\models\AhliGizi',
            'idParam' => 'ahli_gizi', // Sebagai nama variable session
            'enableAutoLogin' => true,
            'enableSession' => true,
            'identityCookie' => [
                'name' => '_identity_ahli_gizi',
            ]
        ],
        'pasien' => [
            'class' => 'yii\web\User',
            'identityClass' => 'app\models\Pasien',
            'idParam' => 'pasien',   // Sebagai nama variable session
            'enableAutoLogin' => true,
            'enableSession' => true,
            'identityCookie' => [
                'name' => '_identity_pasien',
            ]
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => $db,
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */

        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => false
            ],
        ],

    ],
    'layout' => 'main.php',
    'params' => $params,
    'on beforeAction' => $before_action,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;