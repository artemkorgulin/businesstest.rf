<?php
namespace frontend\assets;


use yii\web\AssetBundle;

class RegistrationAsset extends AssetBundle
{
    public $appendTimestamp = true;
    public $js = [
        '/js/register.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}