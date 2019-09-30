<?php
/**
 * @var \yii\web\View $this
 */

use yii\helpers\Html;

\frontend\assets\RegistrationAsset::register($this);

$this->title = 'Регистрация участника тестирования';

$form = \yii\widgets\ActiveForm::begin();
?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1 class="panel-title"><?= $this->title ?></h1>
        </div>

        <?php /* if ($errors): ?>
    <div class="alert alert-danger" style="border-radius: 0;">
        <pre>
            <?php print_r($errors); ?>
        </pre>
    </div>
    <?php endif; */ ?>

        <div class="panel-body">
            <h4>Представьтесь, пожалуйста:</h4>
            <?= $form->field($model, 'name_l')->textInput(); ?>
            <?= $form->field($model, 'name_f')->textInput(); ?>
            <?= $form->field($model, 'name_m')->textInput(); ?>
            <div class="row">
                <div class="col-xs-12 col-md-6"><?= $form->field($model, 'b_date')->widget(
                        \kartik\datecontrol\DateControl::className(),
                        [
                            'convertFormat' => true,
                            'pluginOptions' => [
                                'format' => 'dd.MM.yyyy',
                                'todayHighlight' => true
                            ],
                        ]
                    ) ?></div>
                <div class="col-xs-12 col-md-6"> <?= $form->field($model, 'gender_id')->
                    dropDownList($model->getGenders(), ['prompt' => 'Выберите пол...']) ?> </div>
            </div>
            <hr/>
            <h4>Выберите учебное заведение:</h4>
            <div id="school-selection-default">
                <?php echo $regions ?>
            </div>
            <?php
            echo $form->field($model, 'region_id')->hiddenInput(['id' => 'currentRegion',])->label(false);
            echo $form->field($model, 'school_id')->hiddenInput(['id' => 'currentSchool',])->label(false);
            echo $form->field($model, 'class_id')->hiddenInput(['id' => 'currentClass',])->label(false);
            ?>
            <hr/>
            <h4>Контактные данные для получения результатов:</h4>

            <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
                'mask' => '+7 (999) 999-99-99'
            ]) ?>
            <?= $form->field($model, 'email')->textInput()->label('E-mail (будет именем пользователя для входа в базу знаний)'); ?>

            <?php /*
        <?=$form->field($model, 'password')->widget(\kartik\password\PasswordInput::className());?>
        */ ?>

            <hr/>
            <h4>Дополнительно:</h4>
            <?= $form->field($model, 'agree')->checkbox(['label' => 'Я даю согласие на обработку персональных данных, согласен на получение информационных рассылок от Университета «Синергия» и соглашаюсь c <a href="/site/terms/"  style="color: #069; text-decoration: underline;" target="_terms">политикой конфиденциальности</a>.'])->label(false); ?>

        </div>


        <?php /*
    <pre>
        <?php print_r($model->attributes); ?>
    </pre>
    */ ?>

        <div class="panel-footer">
            <?= Html::submitButton('Перейти к тестированию', ['class' => 'btn btn-danger btn-lg']) ?>
        </div>

    </div>
<style>
    .text-right{
        float:right;
    }
</style>

<?php
\yii\widgets\ActiveForm::end();

