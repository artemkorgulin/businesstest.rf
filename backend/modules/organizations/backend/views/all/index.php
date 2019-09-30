<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\organizations\backend\models\OrganizationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Учебные заведения';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organization-index">

    <p>
        <?= Html::a('Добавить учебное заведение', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                 'attribute' => 'status',
                 'content' => function ($data) {
                    if ($data->status) {
                        return 'Объединено ' . Html::a($data->status, ['view', 'id' => $data->status]);
                    } else {
                        return 'Активно';
                    }
                 }
            ],
            'type',
            'name',
            'zip',
            'address',
            'phone',
            'url:url',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
