<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

\backend\assets\AppAsset::register($this);
\backend\assets\BootboxAsset::overrideSystemConfirm();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="border header">

    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->params['brandName'],
        'brandUrl' => Yii::$app->homeUrl,
        'innerContainerOptions' => ['class' => 'container-fluid'],
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    $menuItems[] = ['label' => 'Рабочий стол', 'url' => ['/site/index']];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Войти', 'url' => ['/site/login']];
    } else {

        $menuItems[] = [
            'label' => Yii::$app->user->getIdentity()->username,
            'items' => [

                '<li>' . Html::a('<i class="fa fa-fw fa-lock"></i>&nbsp;' . Yii::t('app/default', 'Смена пароля'), \yii\helpers\Url::to(['/my/password'])) . '</li>',


                '<li class="divider"></li>',

                '<li class="col-xs-12">'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    '<i class="fa fa-fw fa-sign-out"></i>&nbsp;' . Yii::t('app/default', 'Выйти'),
                    ['class' => 'btn btn-danger logout pull-right']
                )
                . Html::endForm()
                . '</li>'
            ],
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>


</div>

<div class="border b_container clearfix">
    <div id="left-sidebar-menu" class="border menu hidden-xs">
        <ul>
        <?= \yii\widgets\ListView::widget([
            'dataProvider' => $this->params['_backendMap'],
            'itemView' => '_menu_item',
            'summary' => false,
        ]);
        ?>
        </ul>
    </div>

    <div class="border b_content">
        <div class="border content">

            <div class="panel panel-default" id="main-panel">
                <div class="panel-heading main-panel-heading">
                    <h1><?=Html::encode($this->title)?></h1>
                </div>
                <div class="panel-body main-panel-body">

                    <?php if ($flash = Yii::$app->session->getFlash('global')): ?>
                    <div class="alert alert-<?=$flash['class']?>">
                        <?=$flash['message']?>
                    </div>
                    <?php endif; ?>

                    <?= $content ?>
                </div>
                <div class="panel-footer main-panel-footer">
                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                </div>
            </div>

            <?=$this->render('_modals')?>
        </div>



        <div class="border footer">
            <div class="copyright pull-left">
                WibleYii &trade; CMS <?=Yii::$app->getVersion()?> by WebWizardry, <br/>
                <?=Yii::powered()?> <?=Yii::getVersion()?>
            </div>
        </div>

    </div>

</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
