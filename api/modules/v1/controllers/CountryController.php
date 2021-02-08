<?php

namespace api\modules\v1\controllers;

use backend\models\TreeMenuJson;
use yii\rest\ActiveController;
use yii\web\Response;
use yii\data\ActiveDataProvider;

/**
 * Country Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class CountryController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\TreeMenuJson';

    public function actions()
    {
        var_dump("asdasd"); exit;
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = function ($action) {
            return new ActiveDataProvider([
                'query' => $this->modelClass::find()->where('code=:code', [':code' => $_GET['code']]),
            ]);
        };

        return $actions;
    }
}


