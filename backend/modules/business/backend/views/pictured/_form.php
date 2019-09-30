<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\business\common\models\BusinessPictured */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="business-pictured-form" id="<?=Yii::$app->controller->actionParams["id"]?>">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Текст вопроса</h3>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'question_text')->textInput(['maxlength' => true])->label(false) ?>
        </div>
    </div>

    <h4>Варианты ответов:</h4>


    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">1 вариант</h3>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'variant1_text')->textInput(['maxlength' => true])->label('Текст') ?>
            <?= $form->field($model, 'variant1_result')->textarea() ?>
            <?= $form->field($model, 'variant1_pict')->widget(\kartik\file\FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => [
                    'initialPreview'=>[
                        $model->getImageUrl('variant1_pict'),
                    ],
                    'initialPreviewAsData'=>true,
                    'showRemove' => false,
                    'showUpload' => false
                ]
            ]); ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">2 вариант</h3>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'variant2_text')->textInput(['maxlength' => true])->label('Текст') ?>
            <?= $form->field($model, 'variant2_result')->textarea() ?>
            <?= $form->field($model, 'variant2_pict')->widget(\kartik\file\FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => [
                    'initialPreview'=>[
                        $model->getImageUrl('variant2_pict'),
                    ],
                    'initialPreviewAsData'=>true,
                    'showRemove' => false,
                    'showUpload' => false
                ]
            ]); ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">3 вариант</h3>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'variant3_text')->textInput(['maxlength' => true])->label('Текст') ?>
            <?= $form->field($model, 'variant3_result')->textarea() ?>
            <?= $form->field($model, 'variant3_pict')->widget(\kartik\file\FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => [
                    'initialPreview'=>[
                        $model->getImageUrl('variant3_pict'),
                    ],
                    'initialPreviewAsData'=>true,
                    'showRemove' => false,
                    'showUpload' => false
                ]
            ]); ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
