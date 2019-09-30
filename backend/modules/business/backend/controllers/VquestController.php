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

/**
 * VquestController implements the CRUD actions for BusinessVariantsQuestion model.
 */
class VquestController extends DefaultBackendController
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
     * Lists all BusinessVariantsQuestion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BusinessVariantsQuestionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BusinessVariantsQuestion model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'answers' => BusinessVariantsAnswer::findAll(['question_id' => $id]),
        ]);
    }

    /**
     * Creates a new BusinessVariantsQuestion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BusinessVariantsQuestion();
        $model->setScenario('insert');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BusinessVariantsQuestion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setScenario('update');

        $ans = new BusinessVariantsAnswer(['question_id' => $id]);
        if ($ans->load(Yii::$app->request->post()) && $ans->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        }

        $searchModel = new BusinessVariantsAnswerSearch(['question_id' => $id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model'  => $model,
                'answer' => $ans,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Deletes an existing BusinessVariantsQuestion model.
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
     * Delete picture an existing BusinessVariantsQuestion model
     */
    public function actionDeletepicture($id)
    {
        $model = $this->findModel($id);
        $model->setScenario('update');

        $model->load(Yii::$app->request->post(),'');
        if($model->validate()) {
            if ($model->deleteBusinessVariantsPictures()) {
                Yii::$app->session->setFlash('success', 'Файлы удалены успешно!');
            } else {
                Yii::$app->session->setFlash('error', 'Внимание! Файлы не удалены!!!');
            }

            $model->picture = '';

            if ($model->save()) {
                return $this->refresh();
            }
        }
    }

    /**
     * Finds the BusinessVariantsQuestion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BusinessVariantsQuestion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BusinessVariantsQuestion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
