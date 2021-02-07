<?php
$this->title = 'Настройки сайта';
$form = \kartik\form\ActiveForm::begin();
?>

<p>
<?=\yii\helpers\Html::submitButton('Сохранить настройки', ['class' => 'btn btn-primary'])?>
</p>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Глобальные настройки доступа</h3>
    </div>
    <div class="panel-body">
        <?=$form->field($model, 'frontend_visibility')->dropDownList([
              'open'  => 'Общий доступ открыт',
              'block' => 'Общий доступ закрыт, отображается страница блокировки',
        ])?>

        <?=$form->field($model, 'frontend_block_mess')->textarea()?>
        <?=$form->field($model, 'frontend_block_date')->widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '9999-99-99 99:99:99'
        ]) ?>
    </div>
</div>

<p>
<?=\yii\helpers\Html::submitButton('Сохранить настройки', ['class' => 'btn btn-primary'])?>
</p>
<?php
\kartik\form\ActiveForm::end();