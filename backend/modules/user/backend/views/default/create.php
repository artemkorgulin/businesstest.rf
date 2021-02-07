<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;


/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = 'Создать аккаунт';
$this->params['breadcrumbs'][] = ['label' => 'Учетные записи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

    <div class="row">
        <div class="col-lg-6 col-xs-12">
            <?= $form->field($model, 'name_last') ?>
        </div>
        <div class="col-lg-6 col-xs-12">
            <?= $form->field($model, 'name_first') ?>
        </div>
    </div>

    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '+7 (999) 999-99-99'
    ]) ?>

    <div class="row">
        <div class="col-lg-6 col-xs-12">
            <?= $form->field($model, 'password_repeat')->passwordInput() ?>
        </div>
        <div class="col-lg-6 col-xs-12">
            <?= $form->field($model, 'password')->passwordInput() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Создать аккаунт'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
