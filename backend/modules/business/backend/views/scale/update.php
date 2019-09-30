<?php

use yii\helpers\Html;
require dirname(__DIR__) . '/pictured/_labels.php';

/* @var $this yii\web\View */
/* @var $model common\modules\business\common\models\BusinessScale */

$this->title = 'Редактирование: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => $crumbsTestLabel, 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => 'Реестр шкал', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="business-scale-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
