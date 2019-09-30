<?php

use yii\helpers\Html;

include __DIR__ . '/_labels.php';

/* @var $this yii\web\View */
/* @var $model common\modules\business\common\models\BusinessPictured */

$this->title = 'Добавить вопрос';
$this->params['breadcrumbs'][] = ['label' => $crumbsTestLabel, 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => $crumbsLabel, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-pictured-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
