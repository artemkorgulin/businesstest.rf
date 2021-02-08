<?php

namespace frontend\controllers;

use backend\models\User;
use common\models\UserProfile;
use common\modules\business\common\components\result\BusinessResultComposer;
use common\modules\business\common\models\BusinessResult;
use common\modules\organizations\common\models\Region;
use kartik\datecontrol\DateControl;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\NotFoundHttpException;
use kartik\mpdf\Pdf;
use yii\web\Response;
use backend\models\TreeMenuJson;

/**
 * Site controller
 */
class ApiController extends DefaultFrontendController
{
    public $modelClass = 'backend\models\TreeMenuJson';

    /**
     * @inheritdoc
     */
    protected function verbs()
    {
        return [
            'index' => ['GET', 'HEAD'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = [];

        return $behaviors;
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        $actions = [
            'index' => [
                'class' => ApiController::class,
                'modelClass' => $this->modelClass
            ],
        ];

        return array_merge(parent::actions(), $actions);
    }


    public  function RecursiveTree2(&$rs, $parent)
    {
        $out = array();
        if (!isset($rs[$parent]))
        {
            return $out;
        }
        foreach ($rs[$parent] as $row)
        {
            $chidls = $this->RecursiveTree2($rs, $row['id']);
            if ($chidls)
            {

                if ($row['parent_id'] == 0)
                {
                    $row['toggle'] = false;
                    $row['expanded'] = true;
                    $row['children'] = $chidls;
                    $row['text'] = '';
                }
                else
                {
                    $row['expanded'] = false;
                    $row['children'] = $chidls;
                }
            }
            $out[] = $row;
        }
        return $out;
    }


    /**
     * all items json
     *
     * @return mixed
     */
    public function actionView()
    {
        var_dump("actionView"); exit;
        Yii::$app->response->format = Response::FORMAT_JSON;
        $req = Yii::$app->request;
        $post = $req->post();
        $model = new TreeMenuJson();
        $all = $model->all();
        $value = $this->RecursiveTree2($all, 0);
        return ['status' => 'success', 'output' => $value];
    }


    /**
     * all items json
     *
     * @return mixed
     */
    public function actionIndex()
    {
        var_dump("actionIndex"); exit;
        Yii::$app->response->format = Response::FORMAT_JSON;
        $req = Yii::$app->request;
        $post = $req->post();
        $model = new TreeMenuJson();
        $all = $model->all();
        $value = $this->RecursiveTree2($all, 0);
        return ['status' => 'success', 'output' => $value];
    }

    /**
     * menu item add
     *
     * @return mixed
     */
    public function actionAdd()
    {
        var_dump("actionAdd"); exit;
        Yii::$app->response->format = Response::FORMAT_JSON;
        $req = Yii::$app->request;
        $post = $req->post();
        if (!isset($post['id'])) {
            return ['status' => 'error', 'output' => 'id child, and id_parent set'];
        }
        if (!isset($post['parent_id'])) {
            return ['status' => 'error', 'output' => 'No set parent_id to remove'];
        }
        $model = new TreeMenuJson();
        $value = $model->add($post['id'],$post['parent_id'],$post['name'],$post['url']);
        $model->save();
        return ['status' => 'success', 'output' => $value];
    }

    /**
     * menu item remove
     *
     * @return mixed
     */
    public function actionRemove()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $req = Yii::$app->request;
        $post = $req->post();
        if (!isset($post['parent_id'])) {
            return ['status' => 'error', 'output' => 'No set parent_id to remove'];
        }
        $model = new TreeMenuJson();
        $value = $model->remove($post['parent_id']);
        $model->save();
        return ['status' => 'success', 'output' => $value];
    }

    /**
     * menu item edit
     *
     * @return mixed
     */
    public function actionEdit()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $req = Yii::$app->request;
        $post = $req->post();
        if (!isset($post['id'])) {
            return ['status' => 'error', 'output' => 'No set id to edit'];
        }
        if (!isset($post['parent_id'])) {
            return ['status' => 'error', 'output' => 'No set parent_id to remove'];
        }
        $model = new TreeMenuJson();
        $value = $model->edit($post['id'],$post['parent_id'],$post['name']);
        $model->save();
        return ['status' => 'success', 'output' => $value];
    }
}
