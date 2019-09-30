<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = Yii::t('app', 'Sign Up');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <div class="row">
        <div class="visible-lg col-lg-6">
        </div>
        <div class="col-lg-6 col-xs-12">

            <h1><?= Html::encode($this->title) ?></h1>

            <p><?=Yii::t('app', 'Please fill out the following fields to signup:')?></p>

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




            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                'template' => '<div class="row"><div class="col-xs-6 text-right">{image}</div><div class="col-xs-6">{input}</div></div>',
            ]) ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Signup'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?> <hr/>
                    <?= Html::a(Yii::t('app', 'Login'), ['site/login'], ['class' => 'link']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
