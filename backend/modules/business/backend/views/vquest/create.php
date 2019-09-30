<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

include dirname(__DIR__) . '/pictured/_labels.php';

/* @var $this yii\web\View */
/* @var $model common\modules\business\common\models\BusinessVariantsQuestion */

$this->title = 'Добавление вопроса';
$this->params['breadcrumbs'][] = ['label' => $crumbsTestLabel, 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => 'Вопросы с вариантами ответов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-variants-question-create">

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
    </div>

    <div class="form-group">
        <?= Html::submitButton('Далее', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
