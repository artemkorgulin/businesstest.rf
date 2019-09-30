<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\organizations\common\models\Region */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Регионы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="region-view">
    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Скрыть регион из регистрации',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'parent.name',
            'level_id',
            'name',
            'name_display',
            'is_visible',
        ],
    ]) ?>

    <?php
        $form = \kartik\form\ActiveForm::begin();
    ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                Перенести индексы в регион <?=$model->name_display?>
            </h3>
        </div>

        <div class="panel-body">
            <?php if ($zip->done): ?>
            <p>Добавлено: <?=count($zip->created)?></p>
            <p>Перенесено: <?=count($zip->updated)?></p>
            <p>Ошибки: <?=count($zip->errors)?><br/><?=implode('; ', $zip->errors)?></p>
            <?php endif; ?>
            <?=$form->field($zip, 'zip')->textarea(['rows' => 8])->label('Список почтовых индексов по одному на строку')?>
        </div>
        <div class="panel-footer">
            <?=Html::submitButton('Перенести', ['class' => 'btn btn-success'])?>
        </div>

    </div>


    <?php
        \kartik\form\ActiveForm::end();
    ?>

</div>
