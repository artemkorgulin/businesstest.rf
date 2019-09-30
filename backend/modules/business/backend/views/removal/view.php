<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\business\common\models\BusinessRemove */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Исключение характеристик', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-remove-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'removal:ntext',
        ],
    ]) ?>

</div>
