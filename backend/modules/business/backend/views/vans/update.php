<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\business\common\models\BusinessVariantsAnswer */

$this->title = 'Редактирование варианта ответа';
$this->params['breadcrumbs'][] = ['label' => 'Business Variants Answers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="business-variants-answer-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
