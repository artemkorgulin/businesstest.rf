<?php
namespace common\modules\user\backend;
use backend\base\ModuleBackend;
use common\modules\user\backend\assets\BackendAsset;

class UserModule extends \common\modules\user\common\UserModule implements ModuleBackend
{
    /**
     * Конфигуратор меню админ-панели
     * @return array
     */
    public static function backend()
    {
        return [
            'title' => \Yii::t('app', 'Пользователи'),
            'asset' => BackendAsset::className(),
            'icon'  => 'icon.png',
            'tools' => [
                '' => ['title' => \Yii::t('app', 'Учетные записи'), 'visible' => \Yii::$app->user->identity->hasRole('access-admin')],
                'default/create' => ['title' => \Yii::t('app', 'Создать аккаунт'), 'visible' => \Yii::$app->user->identity->hasRole('access-admin')]
            ],
        ];
    }
}