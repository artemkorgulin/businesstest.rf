<?php

use yii\helpers\Html;

require dirname(__DIR__) . '/pictured/_labels.php';

/* @var $this yii\web\View */
/* @var $model common\modules\business\common\models\BusinessScaleQuestion */

$this->title = 'Добавление вопроса к шкале ';
$this->params['breadcrumbs'][] = ['label' => $crumbsTestLabel, 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => 'Реестр шкал', 'url' => ['scale/index']];
$this->params['breadcrumbs'][] = ['label' => 'Шкала: ' . $model->scale->name, 'url' => ['scale/view', 'id' => $model->scale_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-scale-question-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
