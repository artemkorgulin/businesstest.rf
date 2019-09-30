<?php

use yii\helpers\Html;
use yii\grid\GridView;
include dirname(__DIR__) . '/pictured/_labels.php';

/* @var $this yii\web\View */
/* @var $searchModel common\modules\business\backend\models\BusinessVariantsQuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Вопросы с вариантами ответов';
$this->params['breadcrumbs'][] = ['label' => $crumbsTestLabel, 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-variants-question-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить вопрос с вариантами ответов', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                 'attribute' => 'name',
                 'content' => function ($model) {
                    return '<div style="max-width: 800px;">' . $model->name . '</div>';
                 },
                 'contentOptions' => [
                     'style' => 'white-space: normal;'
                 ],
            ],
            'picture',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
