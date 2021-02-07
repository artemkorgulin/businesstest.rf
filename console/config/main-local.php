<?php
$db = require __DIR__ . '/db.php';

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'controllerMap' => [
        'fixture' => [
            'class' => 'yii\console\controllers\FixtureController',
            'namespace' => 'common\fixtures',
          ],
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db
    ],
    'modules' => [
        'treemenu' =>  [
            'class' => 'sitronik\treemenu\Module',
        ],
        'settings_values' => ['class' => '\common\modules\settings\common\models\SettingsValues', ],
        'settings' => ['class' => '\common\modules\settings\common\models\Settings', ],
        'bt'       => ['class' => '\common\modules\business\frontend\BusinessTestingModule', ],

        'datecontrol' =>  [
            'class' => '\kartik\datecontrol\Module'
        ],
    ],
    'params' => $params,
];
