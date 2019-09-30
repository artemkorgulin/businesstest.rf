<?php
namespace common\modules\organizations\backend;
use common\modules\organizations\backend\assets\BackendAsset;

class OrganizationsModule extends \common\modules\organizations\common\OrganizationsModule
{
    /**
     * Конфигуратор меню админ-панели
     * @return array
     */
    public static function backend()
    {
        return [
            'title' => 'Учреждения',
            'asset' => BackendAsset::className(),
            'icon'  => 'icon.png',
            'tools' => [
                'all'     => ['title' => 'Реестр организаций', 'visible' => true],
                'reg'     => ['title' => 'Регионы', 'visible' => true],
                'zip'     => ['title' => 'Индексы', 'visible' => false],
                'upload'  => ['title' => 'Импорт XLSX', 'visible' => false],
            ],
        ];
    }
}