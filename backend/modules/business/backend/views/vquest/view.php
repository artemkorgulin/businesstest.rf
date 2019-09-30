<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\business\common\models\BusinessVariantsQuestion */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Business Variants Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-variants-question-view">


    <p>
        <?= Html::a('Редактировать вопрос', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить вопрос', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="row">
        <div class="col-xs-12 text-center">
            <h4 class="alert alert-warning"><?=$model->name?></h4><br/>
            <?=Html::img($model->getImageUrl('picture', 'mini'))?>
        </div>
    </div>

    <h4>Варианты ответов:</h4>

    <?php if ($answers): ?>
    <?php foreach ($answers as $answer): ?>

    <div class="alert alert-<?=($answer->is_correct ? 'success' : 'danger')?>">
        <?=$answer->name?>
    </div>

    <?php endforeach ?>
    <?php endif ?>

</div>
