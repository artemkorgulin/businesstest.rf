<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\business\backend\models\BusinessResultSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

require dirname(__DIR__) . '/pictured/_labels.php';

$this->title = 'Результаты тестирования';
$this->params['breadcrumbs'][] = ['label' => $crumbsTestLabel, 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-result-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'user_id',
            'user.email',
            ['label' => 'Участник тестирования', 'content' => function($model){
                return $model->user->profile->name_l . ' ' . $model->user->profile->name_f . ' ' . $model->user->profile->name_m
                    . '<br/>' . $model->user->profile->school->name;
            }],

            'created_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
