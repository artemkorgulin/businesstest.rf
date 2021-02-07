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
        'allert' => ['class' => '\common\widgets\Alert',],
    ],
    'components' => [
        'assetManager' => [
            'basePath' => __DIR__ . '/../web/assets',
        ],
        'request' => [
            'baseUrl' => '/',
            'csrfParam' => '_csrf-backend',
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'fdhgdfgdgdfgs56y45rghrthtr', // ВОТ СЮДА напишите какую-то строку
        ],
        'user' => [
            'identityClass' => 'backend\models\User',
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
            'dsn' => 'mysql:host=localhost;dbname=buisnesstest',
            'username' => "mysql",
            'password' => "mysql",
            'charset' => 'utf8',
        ],
        'urlManager'=>[
            'scriptUrl'=>'/index.php',
        ],
    ],
    'params' => $params,
];
