<?php
use kartik\datecontrol\Module;

return [

    //Отсюда отправляются письма о регистрации и смене пароля
    'robotEmail' => 'dnifg@synergy.ru',

    'supportEmail' => 'dnifg@synergy.ru',

    'adminEmail' => 'admin@example.com',

    'user.passwordResetTokenExpire' => 3600,

    // директория для загрузки медиафайлов
    'mediaDirectory' => dirname(dirname(__DIR__)) . '/frontend/web/media',

    'dateControlDisplay' => [
        Module::FORMAT_DATE => 'dd.MM.yyyy',
        Module::FORMAT_TIME => 'hh:mm:ss',
        Module::FORMAT_DATETIME => 'dd.MM.yyyy hh:mm:ss',
    ],

    // format settings for saving each date attribute (PHP format example)
    'dateControlSave' => [
        Module::FORMAT_DATE => 'php:Y-m-d',
        Module::FORMAT_TIME => 'php:H:i:s',
        Module::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
    ],

    'unisender' => [
        'apiUrl' => 'http://api.unisender.com/ru/api/',
        'apiKey' => '6ouenez841xb41s17t7mism87ddb4yeodi8afido',
    ],
];
