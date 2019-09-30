<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

include dirname(__DIR__) . '/pictured/_labels.php';

/* @var $this yii\web\View */
/* @var $model common\modules\business\common\models\BusinessVariantsQuestion */

$this->title = 'Редактирование вопроса ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => $crumbsTestLabel, 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => 'Вопросы с вариантами ответов', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Вопрос ' . $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="business-variants-question-update" id="<?=Yii::$app->controller->actionParams["id"]?>">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Текст вопроса:</h3>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'name')->textarea() ?>
            <?= $form->field($model, 'picture')->widget(\kartik\file\FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => [
                    'initialPreview'=>[
                        $model->getImageUrl('picture'),
                    ],
                    'initialPreviewAsData'=>true,
                    'showRemove' => false,
                    'showUpload' => false
                ]
            ]); ?>
        </div>
        <div class="panel-footer">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Варианты ответов:</h3>
        </div>
        <div class="panel-body">
            <?= \yii\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'name',
                    [
                        'attribute' => 'is_correct',
                        'content' => function($data) {
                            return $data->is_correct ? 'Да' : 'Нет';
                        }
                    ],

                    ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}', 'controller' => 'vans'],
                ],
            ]); ?>
        </div>
    </div>


    <?php $form = ActiveForm::begin()?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Добавить вариант ответа:</h3>
        </div>
        <div class="panel-body">
            <?=$form->field($answer, 'name')?>
            <?=$form->field($answer, 'is_correct')->dropDownList([
                0 => 'Нет', 1 => 'Да'
            ])?>
        </div>
        <div class="panel-footer">
            <?=Html::submitButton('Добавить вариант ответа', ['class' => 'btn btn-success'])?>
        </div>
    </div>
    <?php ActiveForm::end()?>


</div>
