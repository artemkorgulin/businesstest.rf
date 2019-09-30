<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\business\common\models\BusinessScaleQuestion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="business-scale-question-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Основная информация</h3>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'scale_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\modules\business\common\models\BusinessScale::find()->all(), 'id', 'name')) ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Параметры расчета результата</h3>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'pts_yes')->textInput() ?>
            <?= $form->field($model, 'pts_no')->textInput() ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
