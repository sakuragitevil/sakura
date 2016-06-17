<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'name' => 'Sakura',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log', 'gii'],
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['*'],
        ]
    ],
    'homeUrl' => '/sakura/admin',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
        'request' => [
            'baseUrl' => '/sakura/admin',
        ],
        'urlManager' => [
            'class' => 'backend\components\ZUrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<language:\w+>/<controller>/<action>/<id:\d+>/<title>' => '<controller>/<action>',
                '<language:\w+>/<controller>/<id:\d+>/<title>' => '<controller>/index',
                '<language:\w+>/<controller>/<action>/<id:\d+>' => '<controller>/<action>',
                '<language:\w+>/<controller>/<action>' => '<controller>/<action>',
                '<language:\w+>/<controller>' => '<controller>',
                '<language:\w+>/'=>'site/index',
            ],
        ],
    ],
    'params' => $params,
];
