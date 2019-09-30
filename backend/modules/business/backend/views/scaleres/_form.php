<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\business\common\models\BusinessScaleResult */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="business-scale-result-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Набранные баллы</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-6">
                    <?= $form->field($model, 'pts_lo')->textInput() ?>
                </div>
                <div class="col-xs-6">
                    <?= $form->field($model, 'pts_hi')->textInput() ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Описание результата</h3>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'content1')?>
            <?= $form->field($model, 'content2')->textarea(['rows' => 6]) ?>
        </div>
        <div class="panel-footer">
            <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
