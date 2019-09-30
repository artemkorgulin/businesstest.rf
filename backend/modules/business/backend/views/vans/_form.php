<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\business\common\models\BusinessVariantsAnswer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="business-variants-answer-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="alert alert-info">
        <?=$model->question->name?>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Ответ:</h3>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'is_correct')->dropDownList([
                0 => 'Нет', 1 => 'Да'
            ]) ?>
        </div>
        <div class="panel-footer">
            <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
