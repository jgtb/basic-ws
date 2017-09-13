<?php
$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');
        
$config = [
    'id'         => 'api',
    'timeZone' => 'America/Sao_Paulo',
    'basePath'   => dirname(__DIR__),
    'bootstrap'  => ['log'],
    'components' => [
        'request'      => [
            'enableCookieValidation' => false,
            'enableCsrfValidation'   => false,
            'cookieValidationKey'    => 'modifycustomkey',
        ],
        'cache'        => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'base/error',
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'      => 'yii\log\FileTarget',
                    'except'     => ['yii\web\HttpException:404'],
                    'levels'     => [
                        'error',
                        'warning'],
                    'categories' => ['yii\*',
                        'application'],
                    'logFile'    => '@app/runtime/logs/' . date("Y-m-d", time()) . '.txt',
                ],
            ],
        ],
        'response'     => [
            'class'      => 'yii\web\Response',
            'formatters' => [
                'jsonApi' => 'app\components\JsonApiFormatter',
            ],
        ],
        'db' => $db,
        'urlManager'   => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules'           => [
            ],
        ],
        'tool'         => [
            'class' => 'app\components\Tool',
        ],
    ],
    'params'     => $params,
];

if (YII_DEBUG) {
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class'      => 'yii\gii\Module',
        'allowedIPs' => ['*']
    ];
}

return $config;
