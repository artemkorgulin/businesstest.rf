<?php
/**
 * @var $model \common\modules\business\common\models\BusinessAggregate
 * @var $question \common\modules\business\common\models\BusinessVariantsQuestion
 */
$this->title = 'Тестирование "Склонности к предпринимательской деятельности" - основной блок | Университет СИНЕРГИЯ';

?>
<?=$this->render('_progress', ['progress' => $progress])?>
<p class="alert alert-info">
    <?=$question->name?>
</p>

    <?php if ($question->picture): ?>
        <div class="text-center" style="padding-top: 15px; padding-bottom: 20px">
            <img src="<?=$question->getImageUrl('picture')?>" style="max-width: 90%;">
        </div>
    <?php endif ?>

    <?php $form = \kartik\form\ActiveForm::begin(); ?>

    <?=$form->field($model, 'answer_id')->radioList($question->getVariants())->label('Выберите вариант ответа:')?>
    <?=\yii\helpers\Html::submitButton('Ответить', ['class' => 'btn btn-success btn-lg'])?>

    <?php \kartik\form\ActiveForm::end(); ?>

