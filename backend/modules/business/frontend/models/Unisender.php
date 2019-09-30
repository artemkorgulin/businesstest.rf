<?php
namespace common\modules\business\frontend\models;
use common\models\UnisenderBackup;

/**
 * Class Unisender
 * Подписка в юнисендер из теста по предпринимательству
 *
 * @package common\modules\business\frontend\models
 */
class Unisender extends UnisenderBackup
{
    /**
     * Списки рассылок, в которые будет добавлен контакт методом exchange()
     * @return array
     */
    public function getSubscribeLists()
    {
        return [
            '12664625',    // основной список рассылки по предпринимателям
        ];
    }
}