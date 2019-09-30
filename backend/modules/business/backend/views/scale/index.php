<?php

use yii\helpers\Html;
use yii\grid\GridView;
require dirname(__DIR__) . '/pictured/_labels.php';

/* @var $this yii\web\View */
/* @var $searchModel common\modules\business\backend\models\BusinessScaleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Реестр шкал';
$this->params['breadcrumbs'][] = ['label' => $crumbsTestLabel, 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-scale-index">

    <p>
        <?= Html::a('Добавить шкалу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name', 'comment',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
