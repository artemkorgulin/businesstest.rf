<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\business\common\models\BusinessVariantsAnswer */

$this->title = 'Create Business Variants Answer';
$this->params['breadcrumbs'][] = ['label' => 'Business Variants Answers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-variants-answer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
