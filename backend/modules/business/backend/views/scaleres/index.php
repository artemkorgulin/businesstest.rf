<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\business\backend\models\BusinessScaleResultSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Business Scale Results';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-scale-result-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Business Scale Result', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'scale_id',
            'pts_lo',
            'pts_hi',
            'content1:ntext',
            // 'content2:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
