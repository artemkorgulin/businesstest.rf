<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\organizations\common\models\Organization */

$this->title = 'Редактирование: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Учебные заведения', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="organization-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
