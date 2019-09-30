<?php

/* @var $this yii\web\View */

$this->title = 'Рабочий стол';
?>
<div class="site-index">
    <div class="row">
    <?= \yii\widgets\ListView::widget([
        'dataProvider' => $this->params['_backendMap'],
        'itemView' => '_index_item',
        'summary' => false,
    ]); ?>
    </div>
</div>
