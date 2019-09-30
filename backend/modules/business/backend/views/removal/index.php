<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\business\backend\models\BusinessRemoveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Исключение характеристик';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-remove-index">

    <p>
        <?= Html::a('Добавить исключение', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'removal:ntext',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
