<?php
namespace common\modules\business\backend;
use common\modules\business\backend\assets\BackendAsset;

class BusinessTestingModule extends \common\modules\business\common\BusinessTestingModule
{
    /**
     * Конфигуратор меню админ-панели
     * @return array
     */
    public static function backend()
    {
        return [
            'title' => 'Предприниматели',
            'asset' => BackendAsset::className(),
            'icon'  => 'icon.png',
            'tools' => [
                'pictured'  => ['title' => 'Вопросы на выбор картинки', 'visible' => true],
                'scale'     => ['title' => 'Вопросы по шкалам', 'visible' => true],
                'vquest'    => ['title' => 'Вопросы с вариантами', 'visible' => true],
                'removal'   => ['title' => 'Исключение характеристик', 'visible' => true],
                'result'    => ['title' => 'Результаты', 'visible' => true],
            ],
        ];
    }
}