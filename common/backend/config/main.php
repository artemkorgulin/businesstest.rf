<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'language' => 'ru',
    'modules' => [
        'users' => ['class' => '\common\modules\user\backend\UserModule',],
        'business' => ['class' => '\common\modules\business\backend\BusinessTestingModule',],
        'org'  => ['class' => '\common\modules\organizations\backend\OrganizationsModule',],
        'settings' => ['class' => '\common\modules\settings\backend\SettingsModule',],
    ],
    'components' => [
        'request' => [
            'baseUrl' => '/',
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@backend/_messages',
                    'fileMap' => [
                        'backend'         => 'app.php',
                        'backend/auth'    => 'auth.php',
                        'backend/default' => 'default.php'
                    ]
                ],
            ],
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host='.getenv("MYSQL_HOST").';dbname='.getenv("MYSQL_DATABASE"),
            'username' => getenv("MYSQL_USER"),
            'password' => getenv("MYSQL_PASSWORD"),
            'charset' => 'utf8',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];
