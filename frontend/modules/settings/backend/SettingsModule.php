<?php
namespace frontend\modules\settings\backend;
use frontend\modules\settings\backend\assets\BackendAsset;

class SettingsModule extends \common\modules\settings\common\SettingsModule
{
    /**
     * Конфигуратор меню админ-панели
     * @return array
     */
    public static function backend()
    {
        return [
            'title' => \Yii::t('app', 'Настройки'),
            'asset' => BackendAsset::className(),
            'icon'  => 'icon.png',
            'tools' => [
                '' => ['title' => \Yii::t('app', 'Настройки сайта'), 'visible' => true],
                'manage' => ['title' => \Yii::t('app', 'Управление настройками'), 'visible' => \Yii::$app->user->can('developer')],
            ],
        ];
    }
}
