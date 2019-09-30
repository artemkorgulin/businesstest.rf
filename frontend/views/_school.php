<?php
use yii\helpers\Html;

if ($model->schoolNames) echo '<div class="form-group">'
    . Html::activeDropDownList(
        $model,
        'schoolNameSelected',
        $model->schoolNames,
        [
            'class'=>'form-control',
            'data-role' => 'school-name-select'
        ]
    )
    . '</div>';

if ($model->schools) echo '<div class="form-group">'
    . Html::activeDropDownList(
        $model,
        'schoolSelected',
        $model->schools,
        [
            'class'=>'form-control',
            'data-role' => 'school-id-select'
        ]
    )
    . '</div>';

if ($model->classes) echo '<div class="form-group">'
    . Html::activeDropDownList(
        $model,
        'classSelected',
        $model->classes,
        [
            'class'=>'form-control',
            'data-role' => 'class-id-select'
        ]
    )
    . '</div>';
//$arrOneElement = $model->schools;
////20829
//if(count($model->schools)==2){
//    //$arr = array_shift($model->schools);
//    echo '<div class="form-group">'
//    . Html::activeDropDownList(
//        $model,
//        'schoolSelected',
//        $model->schools,
//        [
//            'class'=>'form-control',
//            'data-role' => 'school-id-select'
//        ]
//    )
//    . '</div>';
//
//} else if($model->schools){
//    echo '<div class="form-group">'
//    . Html::activeDropDownList(
//        $model,
//        'schoolSelected',
//        $model->schools,
//        [
//            'class'=>'form-control',
//            'data-role' => 'school-id-select'
//        ]
//    )
//    . '</div>';
//}

