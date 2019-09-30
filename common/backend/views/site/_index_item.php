<?php
/**
 * Created by PhpStorm.
 * User: AAVolkov
 * Date: 02.10.2017
 * Time: 11:40
 */
?>
<div class="col-xs-12 col-lg-3 col-md-4 map-item-container">
    <div class="modicon-box">
    <?php if (isset($model['icon'])) echo '<img class="modicon" src="' . $model['icon'] . '"/>'; ?>
    </div>
    <div class="module-box">
        <h4><?=$model['title']?></h4>
        <div class="tools">
            <?php foreach ($model['tools'] as $url=>$options) {
                echo \yii\helpers\Html::a($options['label'], [$url]) . ' ';
            }
            ?>
        </div>
    </div>
</div>