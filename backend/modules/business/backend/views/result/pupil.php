<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\business\common\models\BusinessResult */

require dirname(__DIR__) . '/pictured/_labels.php';

$this->title = $model->user->profile->name_l . ' ' . $model->user->profile->name_f . ' ' . $model->user->profile->name_m;
$this->params['breadcrumbs'][] = ['label' => $crumbsTestLabel, 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => 'Результаты тестирования', 'url' => ['result/index']];
$this->params['breadcrumbs'][] = $this->title;



?>
<div class="business-result-view">
    <div class="row">
        <div class="col-sm-2">
            <ul>
                <li><a href="<?=\yii\helpers\Url::to(['view', 'id' => $model->id])?>">Полный результат</a></li>
                <li>Результат для участника</li>
                <li><a href="<?=\yii\helpers\Url::to(['cert', 'id' => $model->id])?>">Сертификат</a></li>
            </ul>
        </div>
        <div class="col-sm-10">
            <?=$this->render('_pupil', ['model' => $result])?>
        </div>
    </div>
</div>