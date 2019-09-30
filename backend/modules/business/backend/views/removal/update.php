<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\business\common\models\BusinessRemove */

$this->title = 'Исключения для характеристики ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Исключение характеристик', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="business-remove-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
