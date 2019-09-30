<?php
namespace backend\controllers;

use common\models\ChangePasswordForm;

class MyController extends DefaultBackendController
{
    public function actionPassword()
    {
        $model = new ChangePasswordForm();
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->session->setFlash('global', [
                'class' => 'success',
                'message' => 'Ваш пароль успешно изменен'
            ]);
            return $this->goHome();
        }
        return $this->render('password', [
            'model' => $model,
        ]);
    }
}