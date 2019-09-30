<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\business\common\models\BusinessScale */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="business-scale-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Основная информация</h3>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'result_hi')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'result_me')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'result_lo')->textarea(['rows' => 6]) ?>
        </div>
        <div class="panel-footer">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
