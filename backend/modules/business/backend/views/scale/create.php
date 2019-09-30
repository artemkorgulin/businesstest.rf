<?php

use yii\helpers\Html;
require dirname(__DIR__) . '/pictured/_labels.php';

/* @var $this yii\web\View */
/* @var $model common\modules\business\common\models\BusinessScale */

$this->title = 'Добавление шкалы';
$this->params['breadcrumbs'][] = ['label' => $crumbsTestLabel, 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => 'Реестр шкал', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-scale-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
