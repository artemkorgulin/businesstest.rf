<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
include __DIR__ . '/_labels.php';
/* @var $this yii\web\View */
/* @var $model common\modules\business\common\models\BusinessPictured */

$this->title = 'Вопрос № ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => $crumbsTestLabel, 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => $crumbsLabel, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-pictured-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Добавить вопрос', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="row">
        <div class="col-xs-12">
            <h4 class="alert alert-warning text-center"><?=$model->question_text?></h4>
        </div>

        <div class="col-md-4 text-center">
            <div class="alert alert-info"><?=$model->variant1_text?></div>
            <div style="height: 180px;" class="image-vbox">
            <?=Html::img($model->getImageUrl('variant1_pict', 'mini'))?> <br/>
            </div>
            <pre><?=$model->variant1_result?></pre>
        </div>

        <div class="col-md-4 text-center">
            <div class="alert alert-info"><?=$model->variant2_text?></div>
            <div style="height: 180px;" class="image-vbox">
            <?=Html::img($model->getImageUrl('variant2_pict', 'mini'))?> <br/>
            </div>
            <pre><?=$model->variant2_result?></pre>
        </div>

        <div class="col-md-4 text-center">
            <div class="alert alert-info"><?=$model->variant3_text?></div>
            <div style="height: 180px;" class="image-vbox">
            <?=Html::img($model->getImageUrl('variant3_pict', 'mini'))?> <br/>
            </div>
            <pre><?=$model->variant3_result?></pre>
        </div>
    </div>

</div>
