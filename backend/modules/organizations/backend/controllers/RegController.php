<?php

namespace common\modules\organizations\backend\controllers;

use backend\controllers\DefaultBackendController;
use common\modules\organizations\backend\models\ZipUpdater;
use Yii;
use common\modules\organizations\common\models\Region;
use common\modules\organizations\backend\models\RegionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RegController implements the CRUD actions for Region model.
 */
class RegController extends DefaultBackendController
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
     * Lists all Region models.
     * @return mixed
     */
    public function actionIndex($parent = 0)
    {
        $current = null;
        if ($parent) {
            $current = Region::findOne(['id' => $parent]);
        }

        $searchModel = new RegionSearch(['parent_id' => $parent]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'current'      => $current,
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Region model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $zip = new ZipUpdater(['region_id' => $id]);

        if ($zip->load(Yii::$app->request->post()) && $zip->save()) {
            Yii::$app->session->setFlash('global', [
                'class' => 'success',
                'message' => 'Индексы добавлены/перенесены в регион'
            ]);
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
            'zip' => $zip,
        ]);
    }

    /**
     * Creates a new Region model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionCreate($parent = 0)
    {
        $model = new Region();
        $current = null;
        if ($parent) {
            if (!($current = Region::findOne(['id' => $parent]))) throw new NotFoundHttpException();
            $model->parent_id = $current->id;
        } else {
            $model->parent_id = 0;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Region model.
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
     * Deletes an existing Region model.
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
     * Finds the Region model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Region the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Region::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
