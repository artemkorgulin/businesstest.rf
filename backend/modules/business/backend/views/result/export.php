<?php
/**
 * Created by PhpStorm.
 * User: AKoloskova
 * Date: 16.11.2018
 * Time: 10:31
 */
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\organizations\backend\models\RegionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Скачать отчет';
$this->params['breadcrumbs'][] = $this->title;
$link = '';
if (isset($dataProvider['error_limit']) && $dataProvider['error_limit'] == true) {
    $offset = (isset($dataProvider['limit'])) ? $dataProvider['limit'] : 0;
    $offset += (int)Yii::$app->request->get('offset');
    if ($offset > 0) $link = Yii::$app->request->url . '&offset=' . $offset . '&continue=1';
    $text = 'Превышен допустимый лимит выгрузки. Отчет загружен не полностью. Нажмите ссылку чтобы догрузить в отчет еще ' . $offset;
} else {
    if (isset($dataProvider['report'])) {
        $link = $dataProvider['report'];
        $text = 'Скачать отчет';
    } else $text = 'По заданным параметрам нет данных к выгрузке';
}
?>
<div class="region-index">
    <a href="<?=$link?>"><?=$text?></a>
</div>
