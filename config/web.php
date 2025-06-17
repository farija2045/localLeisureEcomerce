<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => 'Leisure SF',
    'language' => 'en-US',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower'   => '@vendor/bower-asset',
        '@npm'     => '@vendor/npm-asset',
        '@uploads' => '@app/web/uploads', // Alias for uploads
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'ku9d6H9wRolFLDzARFHvQd1K8Gg18zqx',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['leisure/login'],
        ],
        'errorHandler' => [
            'errorAction' => 'leisure/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            'useFileTransport' => true, // Set to false to send real emails via SMTP

            // Uncomment below to use real SMTP (example with Gmail)
            /*
            'transport' => [
                'dsn' => 'smtp://your_email@gmail.com:your_password@smtp.gmail.com:587?encryption=tls',
            ],
            */
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'admin-entries' => 'leisure/admin-entries',
                'leisure/image/<id:\d+>' => 'leisure/image',
            ],
        ],
        'db' => $db,
    ],
    'defaultRoute' => 'leisure/index',
    'params' => $params,
];

// DEV MODE MODULES (debug, gii)
if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => yii\debug\Module::class,
        // 'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => yii\gii\Module::class,
        // 'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
