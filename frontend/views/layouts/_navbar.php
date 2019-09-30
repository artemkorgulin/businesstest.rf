<?php
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\bootstrap\Html;

NavBar::begin([
    'brandLabel' => '<img src="/img/logo-header.svg">',
    'brandUrl' => Yii::$app->homeUrl,
]);
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => [
        ['label' => 'Вход', 'url' => ['/site/login'], 'visible' => Yii::$app->user->isGuest],
        Yii::$app->user->isGuest ? (
        ['label' => 'Регистрация', 'url' => ['/bt/reg']]
        ) : (
            '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Выход (' . Yii::$app->user->identity->email . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>'
        )
    ],
]);
NavBar::end();
?>
