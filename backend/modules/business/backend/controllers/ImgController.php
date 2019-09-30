<?php

namespace common\modules\business\backend\controllers;

use backend\controllers\DefaultBackendController;
use common\modules\business\backend\models\BusinessVariantsAnswerSearch;
use common\modules\business\common\models\BusinessVariantsAnswer;
use Yii;
use common\modules\business\common\models\BusinessVariantsQuestion;
use common\modules\business\backend\models\BusinessVariantsQuestionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\modules\business\common\models\BusinessPictured;
use yii\data\ActiveDataProvider;


/**
 * imgController implements
 */
class ImgController extends DefaultBackendController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionUpdate($id, $source, $section)
    {
        if ($source == "picturedsearch") {
            $customer = BusinessPictured::findOne($id);
            if ($section == "im1") {
                $customer->variant1_pict = '';
                $customer->update();
            }
            if ($section == "im2") {
                $customer->variant2_pict = '';
                $customer->update();
            }
            if ($section == "im3") {
                $customer->variant3_pict = '';
                $customer->update();
            }

            $this->redirect('?r=business%2Fpictured%2Fupdate&id=' . $id, 301);
        }

        if ($source == "vquest") {
            $customer = BusinessVariantsQuestion::findOne($id);
            $customer->picture = null;
            $customer->update();
            $this->redirect('?r=business%2Fvquest%2Fupdate&id=' . $id, 301);
        }
    }

}
