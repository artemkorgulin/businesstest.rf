<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error container">

    <div  class="row">
        <div class="col-xs-1">

        </div>
    </div>

    <h1><i class="fa fa-lock"></i> <?= Html::encode($this->title) ?></h1>

    <p>
        <?= nl2br(Html::encode($message)) ?>


</div>
