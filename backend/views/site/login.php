<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>
<div class="site-login">

    <div class="loginpage">
        <div class="loginpage__inner">

            <h1 class="text-center"><?=Html::encode($this->title)?></h1>

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'fieldConfig' => [
                    'template' => "<div class=\"row form-group\">{input}\n<div class=\"row-error-hint\">{error}</div></div>",
                ],
            ]); ?>

            <?= $form->field($model, 'username')
                ->textInput(['autofocus' => true, 'placeholder' => $model->getAttributeLabel('username')])
                ->label(false)
            ?>

            <?= $form->field($model, 'password')
                ->passwordInput(['placeholder' => $model->getAttributeLabel('password')])
                ->label(false)
            ?>

            <?= $form->field($model, 'rememberMe')
                ->checkbox(['template' => "<label class=\"row form-group\">{input} {label}\n<div class=\"row-error-hint\">{error}</div></label>",])
            ?>

            <div class="row form-group">
                <div class="col-xs-12">
                    <?= Html::submitButton(Yii::t('users/default', 'Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
