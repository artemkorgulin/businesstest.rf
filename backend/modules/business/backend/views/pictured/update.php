<?php

use yii\helpers\Html;
include __DIR__ . '/_labels.php';

/* @var $this yii\web\View */
/* @var $model common\modules\business\common\models\BusinessPictured */

$this->title = 'Update Business Pictured: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Business Pictureds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="business-pictured-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
