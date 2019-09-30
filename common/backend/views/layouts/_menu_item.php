<?php
use yii\helpers\Html;
if (!isset($model['icon'])) $model['icon'] = '';
else $model['icon'] = '<img src="' .$model['icon']. '"/>';

$activeModule = $model['active'];
?>
<li<?php if($activeModule) echo ' class="active"';?> data-toggle="<?=$model['id']?>"><span class="modtitle" id="<?=$model['id']?>"><?=Html::a($model['icon'] . '<span class="title">' . $model['title'] . '</span>', ['#'])?></span>
    <ul <?php if(!$activeModule) echo ' class="hidden"';?>"  data-parent="<?=$model['id']?>">
        <?php foreach ($model['tools'] as $url=>$options) {
            echo '<li>' . \yii\helpers\Html::a($options['label'], [$url]) . '</li>';
        }
        ?>
    </ul>
</li>