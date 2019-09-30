<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\business\common\models\BusinessRemove */

$this->title = 'Добавить исключение';
$this->params['breadcrumbs'][] = ['label' => 'Исключение характеристик', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-remove-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
