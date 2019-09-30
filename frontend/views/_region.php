<?php
use yii\helpers\Html;

for ($i = 0; $i < 3; $i++)
    if ($model->hasRegionLevel($i)) {
        if ($i == 2 ) {
            foreach ($model->region_items[$i]['variants'] as $key => $item) {
                $region_items = explode(',', $item);
                if (count($region_items) > 1) {
                    foreach ($region_items as $in => $region_item) {
                        $model->region_items[$i]['variants'][$key . '[' . $in . ']'] = trim($region_item);
                    }
                    unset($model->region_items[$i]['variants'][$key]);
                }
            }
        }
        echo '<div class="form-group">'
            .  /*\kartik\select2\Select2::widget([
                    'model' => $model,
                    'attribute' => 'level' . $i,
                    'data' => $model->region_items[$i]['variants'],
                    'options' => [
                        'placeholder' => 'Выберите:',
                        'class'=>'form-control',
                        'data-role' => 'region-level-select'
                    ],
                ])*/


            Html::activeDropDownList(
                $model,
                'level' . $i,
                $model->region_items[$i]['variants'],
                [
                    'class' => 'form-control',
                    'data-role' => 'region-level-select'
                ]
            )
            . '</div>';
    }
