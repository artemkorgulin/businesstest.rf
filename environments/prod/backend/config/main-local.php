<?php
return [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host='.getenv("MYSQL_HOST").';dbname='.getenv("MYSQL_DATABASE"),
            'username' => getenv("MYSQL_USER"),
            'password' => getenv("MYSQL_PASSWORD"),
            'charset' => 'utf8',
        ],
    ],
];
