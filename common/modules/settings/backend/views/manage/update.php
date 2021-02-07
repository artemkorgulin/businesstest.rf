<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\settings\common\models\Settings */

$this->title = 'Update Settings: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Управление параметрами', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="settings-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
