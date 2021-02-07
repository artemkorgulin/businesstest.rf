<?php
$db = require __DIR__ . '/db.php';

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'db' => $db
    ],
    'modules' => [
        'treemenu' =>  [
            'class' => 'sitronik\treemenu\Module',
        ],
        'settings' => ['class' => '\common\modules\settings\frontend\SettingsModule', ],
        'bt'       => ['class' => '\common\modules\business\frontend\BusinessTestingModule', ],

        'datecontrol' =>  [
            'class' => '\kartik\datecontrol\Module'
        ],
    ]
];
