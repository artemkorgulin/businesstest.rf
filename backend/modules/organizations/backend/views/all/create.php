<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\organizations\common\models\Organization */

$this->title = 'Добавление учебного заведения';
$this->params['breadcrumbs'][] = ['label' => 'Учебные заведения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organization-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
