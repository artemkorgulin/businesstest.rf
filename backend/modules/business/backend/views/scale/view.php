<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

require dirname(__DIR__) . '/pictured/_labels.php';

/* @var $this yii\web\View */
/* @var $model common\modules\business\common\models\BusinessScale */

$this->title = 'Шкала: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => $crumbsTestLabel, 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => 'Реестр шкал', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-scale-view">
    <p>
        <?= Html::a('Переименовать шкалу', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить шкалу', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>

    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Вопросы в шкале</h3>
        </div>
        <div class="panel-body">
            <?= \yii\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'name',
                    'pts_yes',
                    'pts_no',

                    ['class' => 'yii\grid\ActionColumn', 'controller' => 'scalequest', 'template' => '{update} {delete}'],
                ],
            ]); ?>
        </div>
        <div class="panel-footer">
            <?= Html::a('Добавить вопрос к шкале', ['scalequest/create', 'scale_id' => $model->id], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Результаты по шкале</h3>
        </div>
        <div class="panel-body">
            <?= \yii\grid\GridView::widget([
                'dataProvider' => new \yii\data\ActiveDataProvider(['query' => \common\modules\business\common\models\BusinessScaleResult::find()->where(['scale_id' => $model->id])]),
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                     'pts_lo', 'pts_hi', 'content1', 'content2',
                    ['class' => 'yii\grid\ActionColumn', 'controller' => 'scaleres', 'template' => '{update} {delete}'],
                ],
            ]); ?>
        </div>
        <div class="panel-footer">
            <?= Html::a('Добавить результат к шкале', ['scaleres/create', 'scale_id' => $model->id], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

</div>
