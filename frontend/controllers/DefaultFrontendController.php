<?php
namespace frontend\controllers;
use yii\web\Controller;

class DefaultFrontendController extends Controller
{
    public function beforeAction($action)
    {
        if (isset(\Yii::$app->params['frontend_visibility']) && 'block' == \Yii::$app->params['frontend_visibility']) {
            return $this->redirect(['/service']);
        }
        return parent::beforeAction($action);
    }
}