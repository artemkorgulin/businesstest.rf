<?php
namespace frontend\controllers;
use yii\web\Controller;

class ServiceController extends Controller
{

    public function actionIndex()
    {
        if (!isset(\Yii::$app->params['frontend_visibility']) || 'block' != \Yii::$app->params['frontend_visibility']) {
            return $this->redirect('/');
        }

       return $this->renderPartial('index');
    }
}