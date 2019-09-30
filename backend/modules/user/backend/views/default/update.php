<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $password \common\modules\user\common\models\PasswordNewForm */

$this->title = 'Редактирование: ' . $model->email;
$this->params['breadcrumbs'][] = ['label' => 'Учетные записи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->email, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="user-update">

    <p>
    <?= Html::a('Вернуться к просмотру', ['view', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Основная информация</h3>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'email') ?>
        </div>
        <div class="panel-footer">
            <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

    <?php ActiveForm::begin();?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Изменение пароля</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-6 col-xs-12">
                    <?= $form->field($password, 'password_repeat')->passwordInput() ?>
                </div>
                <div class="col-lg-6 col-xs-12">
                    <?= $form->field($password, 'password')->passwordInput() ?>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

    <?php $form = ActiveForm::begin();?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Управление доступом</h3>
        </div>
        <div class="panel-body">
            <?=$form->field($model, 'assignment')->checkboxList($model->getAuthRoles())->label(false)?>
        </div>
        <div class="panel-footer">
            <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>
    </div>
    <?php ActiveForm::end();?>

</div>
