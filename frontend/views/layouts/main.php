<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>Склонности к предпринимательской деятельноси | Тестирование | Университет Синергия</title>
    <?php $this->head() ?>

    <link href="//<?=$_SERVER['HTTP_HOST'] ?>/css/site.css" rel="stylesheet">
    <link href="//<?=$_SERVER['HTTP_HOST'] ?>/css/synergy.css" rel="stylesheet">

    <link rel="stylesheet" href="//<?=$_SERVER['HTTP_HOST'] ?>/css/synergy.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link href="//<?=$_SERVER['HTTP_HOST'] ?>/fonts/fonts.css" rel="stylesheet">
    <link href="//<?=$_SERVER['HTTP_HOST'] ?>/css/main.css" rel="stylesheet">
</head>
<body<?php if (isset($this->params['bbg'])) echo ' style="background: ' . $this->params['bbg'] . ';"';?>>
<?php $this->beginBody() ?>



<div class="wrap">
    <header>
        <div class="container">
            <nav>
                <a href="/" class="logo"><img src="//<?=$_SERVER['HTTP_HOST'] ?>/img/logo.svg" alt=""></a>
                <div class="right-side">
                    <?php /* <a href="<?=\yii\helpers\Url::to(['site/login'])?>" class="logIn">Вход</a>
                <a href="<?=\yii\helpers\Url::to(['bt/reg'])?>" class="signUp">Регистрация</a> */ ?>
                </div>
            </nav>
        </div>
    </header>

    <div class="wrapper">
        <div class="container" style="padding-top: 20px;">
            <?= $content ?>
        </div>
    </div>

</div>
<footer class="footer">
    <div class="container">
        <nav>
            <a href="/" class="logo"><img src="//<?=$_SERVER['HTTP_HOST'] ?>/img/logo.svg" alt=""></a>
            <div class="right-side">
                <span class="copy">© Университет «Синергия» 2018</span>
                <a href="tel:88001009343" class="link">8 800 100–93–43</a>
                <a href="mailto:predpr@synergy.ru" class="link">predpr@synergy.ru</a>
            </div>
        </nav>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
