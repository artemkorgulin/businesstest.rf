<?php
/**
 * @var $model \common\modules\business\common\models\BusinessAggregate
 * @var $question \common\modules\business\common\models\BusinessPictured
 */
$this->title = 'Тестирование "Склонности к предпринимательской деятельности" - основной блок | Университет СИНЕРГИЯ';
?>
<?=$this->render('_progress', ['progress' => $progress])?>
<p class="alert alert-info">
    <?=$question->question_text?>
</p>
<div class="row">
    <div class="col-xs-4 text-center">
        <?php $form = \kartik\form\ActiveForm::begin()?>
            <?= $form->field($model, 'answer_id')->hiddenInput(['value' => 1])->label(false)?>
            <?php
                $btn = \yii\helpers\Html::img($question->getImageUrl('variant1_pict')) . '<br/><span> ' . $question->variant1_text . ' </span>';
                echo \yii\helpers\Html::submitButton($btn, ['class' => 'btn btn-success btn-pictured']);
            ?>
        <?php \kartik\form\ActiveForm::end()?>
    </div>

    <div class="col-xs-4 text-center">
        <?php $form = \kartik\form\ActiveForm::begin()?>
        <?= $form->field($model, 'answer_id')->hiddenInput(['value' => 2])->label(false)?>
        <?php
        $btn = \yii\helpers\Html::img($question->getImageUrl('variant2_pict')) . '<br/><span> ' . $question->variant2_text . ' </span>';
        echo \yii\helpers\Html::submitButton($btn, ['class' => 'btn btn-success btn-pictured']);
        ?>
        <?php \kartik\form\ActiveForm::end()?>
    </div>

    <div class="col-xs-4 text-center">
        <?php $form = \kartik\form\ActiveForm::begin()?>
        <?= $form->field($model, 'answer_id')->hiddenInput(['value' => 3])->label(false)?>
        <?php
        $btn = \yii\helpers\Html::img($question->getImageUrl('variant3_pict')) . '<br/><span> ' . $question->variant3_text . ' </span>';
        echo \yii\helpers\Html::submitButton($btn, ['class' => 'btn btn-success btn-pictured']);
        ?>
        <?php \kartik\form\ActiveForm::end()?>
    </div>
</div>


