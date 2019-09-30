<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\organizations\common\models\Region */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="region-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Основная информация</div>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'parent_id')->dropDownList(\common\modules\organizations\common\models\Region::findAllRegions()) ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'name_display')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'is_visible')->dropDownList([
               0 => 'Скрыт',
               1 => 'Доступен'
            ]) ?>
        </div>
    </div>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
