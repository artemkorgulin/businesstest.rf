<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user backend\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);
?>
<div class="password-reset">
    <p>Здравствуйте, поздравляем с регистрацией в testing.synergyonline.ru</p>

    <p>Ваш логин:  <?=$user->email?></p>
    <p>Ваш пароль: <?=$password?></p>

    <p>Ссылка для входа в систему: <?= Html::a(Html::encode($resetLink), $resetLink) ?></p>

    <p>С уважением,<br/>команда Synergy CRM</p>
</div>
