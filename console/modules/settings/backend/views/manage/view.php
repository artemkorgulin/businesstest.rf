<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\settings\common\models\Settings */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Управление параметрами', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="settings-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Удаление системного параметра может повлечь некорректную работу приложения. Продолжить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'const_name',
            'title',
            'value:ntext',
        ],
    ]) ?>

</div>
