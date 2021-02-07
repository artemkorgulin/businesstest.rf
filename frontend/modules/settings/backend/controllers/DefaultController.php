<?php
namespace frontend\modules\settings\backend\controllers;
use backend\controllers\DefaultBackendController;
use frontend\modules\settings\common\models\SettingsValues;

class DefaultController extends DefaultBackendController
{
    public function actionIndex()
    {
        $model = new SettingsValues();

        if ($model->load(\Yii::$app->request->post())) {
            if ($model->save()) {
                \Yii::$app->session->setFlash('global', [
                    'class' => 'success',
                    'message' => 'Настройки сайта успешно сохранены'
                ]);
                return $this->redirect(['/settings']);
            } else {
                \Yii::$app->session->setFlash('global', [
                    'class' => 'danger',
                    'message' => 'Не удалось сохранить настройки сайта'
                ]);
            }

        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
