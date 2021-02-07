<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\settings\common\models\Settings */

$this->title = 'Добавление параметра';
$this->params['breadcrumbs'][] = ['label' => 'Управление параметрами', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="settings-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
