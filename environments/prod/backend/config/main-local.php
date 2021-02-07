<?php
return [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'fdhgdfgdgdfgs56y45rghrthtr',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=buisnesstest',
            'username' => "mysql",
            'password' => "mysql",
            'charset' => 'utf8',
        ],
    ],
];
