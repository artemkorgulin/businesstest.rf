<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->profile->name_f . ' ' . $model->profile->name_l;
$this->params['breadcrumbs'][] = ['label' => 'Учетные записи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">


    <p>
        <?= Html::a('Редактировать аккаунт', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

        <?php if (\backend\models\User::STATUS_ACTIVE == $model->status): ?>

        <?= Html::a('Заблокировать аккаунт', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Подтвердите блокировку аккаунта',
                'method' => 'post',
            ],
        ]) ?>

        <?php else: ?>

            <?= Html::a('Активировать аккаунт', ['restore', 'id' => $model->id], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => 'Подтвердите активацию аккаунта',
                    'method' => 'post',
                ],
            ]) ?>

        <?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'email:email',
            'profile.phone',
            'profile.name_l',
            'profile.name_f',
            'profile.name_m',
            'status',
            'created_at:date',
            'updated_at:date',
        ],
    ]) ?>

</div>
