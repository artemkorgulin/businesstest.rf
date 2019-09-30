<?php

namespace common\modules\business\backend\controllers;

use backend\controllers\DefaultBackendController;
use common\modules\business\common\components\result\BusinessResultComposer;
use common\modules\business\backend\models\BusinessResultExport;
use common\modules\business\backend\models\BusinessResultExportOrg;
use Yii;
use common\modules\business\common\models\BusinessResult;
use common\modules\business\backend\models\BusinessResultSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ResultController implements the CRUD actions for BusinessResult model.
 */
class ResultController extends DefaultBackendController
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

    /**
     * Lists all BusinessResult models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BusinessResultSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a BusinessResultExport model.
     * @return mixed
     */
    public function actionExport()
    {
        $exportModel = new BusinessResultExport();
        $exportResult = $exportModel->export();
        return $this->render('export', [
            'dataProvider' => $exportResult,
        ]);
    }

    /**
     * Displays a BusinessResultExportOrg model.
     * @return mixed
     */
    public function actionExportorg()
    {
        $exportModel = new BusinessResultExportOrg();
        $exportResult = $exportModel->export();
        return $this->render('export', [
            'dataProvider' => $exportResult,
        ]);
    }

    /**
     * Displays a single BusinessResult model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model'  => $this->findModel($id),
            'result' => new BusinessResultComposer(['result_id' => $id]),
        ]);
    }

    /**
     * Displays a single BusinessResult model.
     * @param integer $id
     * @return mixed
     */
    public function actionPupil($id)
    {
        return $this->render('pupil', [
            'model'  => $this->findModel($id),
            'result' => new BusinessResultComposer(['result_id' => $id]),
        ]);
    }



    /**
     * Creates a new BusinessResult model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BusinessResult();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BusinessResult model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BusinessResult model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BusinessResult model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BusinessResult the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BusinessResult::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
