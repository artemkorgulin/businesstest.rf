<?php
use \kartik\form\ActiveForm;
$this->title = 'Изменение пароля';

$form = ActiveForm::begin();
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Для изменения пароля укажите текущий пароль, новый пароль и подтверждение:</h3>
    </div>
    <div class="panel-body">
        <?=$form->field($model, 'old_password')->passwordInput()?>
        <?=$form->field($model, 'password_repeat')->passwordInput()?>
        <?=$form->field($model, 'password')->passwordInput()?>
    </div>
    <div class="panel-footer">
        <?=\yii\helpers\Html::submitButton('Сменить пароль', ['class'=>'btn btn-primary'])?>
    </div>
</div>




<?php
ActiveForm::end();
