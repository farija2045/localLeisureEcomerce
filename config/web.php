<?php

$params = require __DIR__ . '/params.php';
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
            // Insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'ku9d6H9wRolFLDzARFHvQd1K8Gg18zqx',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // Send all mails to a file by default.
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
        'db' => $db, // Default database (Leisure_DB) for admin login
        'postDb' => [ // Second database (post_db) for storing posts
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=post_db', 
            'username' => 'root', // Replace with your database username
            'password' => '', // Replace with your database password
            'charset' => 'utf8',
        ],
        'urlManager' => [ // Enable pretty URLs
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                // Add custom URL rules here if needed
                'admin-entries' => 'site/admin-entries',
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // Configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // Uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // Uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;