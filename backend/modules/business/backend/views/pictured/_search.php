<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\business\backend\models\BusinessPicturedSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="business-pictured-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'question_text') ?>

    <?= $form->field($model, 'variant1_text') ?>

    <?= $form->field($model, 'variant1_pict') ?>

    <?= $form->field($model, 'variant2_text') ?>

    <?php // echo $form->field($model, 'variant2_pict') ?>

    <?php // echo $form->field($model, 'variant3_text') ?>

    <?php // echo $form->field($model, 'variant3_pict') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
