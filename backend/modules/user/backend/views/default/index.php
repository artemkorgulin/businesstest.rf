<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\user\common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Учетные записи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать аккаунт', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'email:email',
            ['attribute' => 'status', 'content' => function($model) {
                return $model->status === \backend\models\User::STATUS_ACTIVE ? 'Активен' : 'Заблокирован';
            }],
            ['class' => 'yii\grid\ActionColumn', 'template'=>'{view} {update}'],
        ],
    ]); ?>
</div>
