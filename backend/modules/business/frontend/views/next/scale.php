<?php
/**
 * @var $model \common\modules\business\common\models\BusinessAggregate
 * @var $question \common\modules\business\common\models\BusinessScaleQuestion
 */
$this->title = 'Тестирование "Склонности к предпринимательской деятельности" - основной блок | Университет СИНЕРГИЯ';
?>

<?=$this->render('_progress', ['progress' => $progress])?>


<p class="alert alert-info">
    <?=$question->name?>
</p>

<div class="row">
    <div class="col-xs-6 text-right">
        <?php $form = \kartik\form\ActiveForm::begin() ?>
            <?=$form->field($model, 'answer_id')->hiddenInput(['value' => 1])->label(false)?>
            <?= \yii\helpers\Html::submitButton('ДА', ['class' => 'btn btn-success btn-lg', 'style' => 'min-width: 100px;'])?>
        <?php \kartik\form\ActiveForm::end(); ?>
    </div>
    <div class="col-xs-6 text-left">
        <?php $form = \kartik\form\ActiveForm::begin() ?>
            <?=$form->field($model, 'answer_id')->hiddenInput(['value' => 2])->label(false)?>
            <?= \yii\helpers\Html::submitButton('НЕТ', ['class' => 'btn btn-success btn-lg', 'style' => 'min-width: 100px;'])?>
        <?php \kartik\form\ActiveForm::end(); ?>
    </div>
</div>
