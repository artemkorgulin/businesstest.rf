<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\organizations\backend\models\RegionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Регионы';
if ($current) $this->title .= ': ' . $current->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="region-index">

    <p>
        <?php
        if ($current) $parent = $current->id; else $parent = 0;
        ?>
        <?= Html::a('Добавить регион', ['create', 'parent' => $parent], ['class' => 'btn btn-success']) ?>
        <?php if (is_object($current)) echo Html::a('Назад', ['index', 'parent' => $current->parent_id], ['class' => 'btn btn-warning']); ?>
    </p>
    <?php if (is_object($current) && $current->level_id == 0) : ?>
        <p>
            Для выгрузки отчета по количеству участников по организациям данного региона укажите дату:
            <input type="date" class="form-control" name="date" value="" onchange="document.getElementById('exportorg').setAttribute('href', document.getElementById('exportorg').getAttribute('href') + '&date=' + this.value)">
            <a id="exportorg" href="/index.php?r=business%2Fresult%2Fexportorg&parent=<?=Yii::$app->request->get('parent')?>" class="btn btn-success">Выгрузить</a>
        </p>
    <?php endif; ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',

            ['attribute' => 'name', 'content' => function($model) {
                return Html::a($model->name, ['index', 'parent'=>$model->id]);
            }],
            'name_display',

            ['attribute' => 'is_visible', 'content' => function($model) {
                return $model->is_visible ? 'Доступен' : 'Скрыт';
            }],

            ['attribute' => 'Выгрузить результаты', 'content' => function($model) {
                $level = $model->level_id;
                if ($level > 1) {
                    $level = $level - 1;
                } else if (stripos($model->name, 'РАЙОН') !== false) {
                    $level = $level + 1;
                }
                $inputs_dates = ($level == 0) ? ' 
                    c <input type="date" class="form-control" name="date_b" value="" onchange="document.getElementById(\'export\').setAttribute(\'href\', document.getElementById(\'export\').getAttribute(\'href\') + \'&date_b=\' + this.value)">
                    по (включ.)<input type="date" class="form-control" name="date_e" value="" onchange="document.getElementById(\'export\').setAttribute(\'href\', document.getElementById(\'export\').getAttribute(\'href\') + \'&date_e=\' + this.value)">
                ' : '';
                return "{$inputs_dates} <a id=\"export\" href=\"/index.php?r=business%2Fresult%2Fexport&limit=100000&level={$level}&region={$model->id}\">Выгрузить</a>";
            }],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
