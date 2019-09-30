<?php

use yii\helpers\Html;
use yii\grid\GridView;

include __DIR__ . '/_labels.php';

/* @var $this yii\web\View */
/* @var $searchModel common\modules\business\backend\models\BusinessPicturedSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $crumbsLabel;
$this->params['breadcrumbs'][] = ['label' => $crumbsTestLabel, 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-pictured-index">
    <p>
        <?= Html::a('Добавить вопрос', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'question_text',
            'variant1_text',
            'variant2_text',
            'variant3_text',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
