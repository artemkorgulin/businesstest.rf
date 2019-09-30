<?php
namespace common\modules\business\frontend\controllers;
use common\modules\business\common\components\composer\BusinessTestComposer;
use frontend\controllers\DefaultFrontendController;

class BeginController extends DefaultFrontendController
{
    public function actionIndex()
    {
        $composer = new BusinessTestComposer([
            'user_id' => \Yii::$app->user->id
        ]);

        if ($composer->hasActiveTesting()) {
            return $this->redirect(['/bt/next']);
        } elseif ($composer->compose()) {
            return $this->redirect(['/bt/next']);
        }
    }
}