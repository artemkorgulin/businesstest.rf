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
use frontend\models\ContactForm;
use yii\web\NotFoundHttpException;
use kartik\mpdf\Pdf;
use yii\web\Response;
use backend\models\TreeMenuJson;
use yii\helpers\ArrayHelper;

/**
 * Api controller
 */
class ApiController extends DefaultFrontendController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [];
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


    public  function RecursiveTree2Delete(&$rs, $parent)
    {
        if(!is_array($_SESSION["out"])) {
            $_SESSION["out"] = array();
        }
        if (!isset($rs[$parent]))
        {
            return $out;
        }
        foreach ($rs[$parent] as $row)
        {
            $chidls = $this->RecursiveTree2Delete($rs, $row['id']);

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
            $_SESSION["out"][] = $row['id'];
        }
        return $_SESSION["out"];
    }


    /**
     * all items json
     *
     * @return mixed
     */
    public function actionIndex()
    {
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
        if (!isset($post['id'])) {
            return ['status' => 'error', 'output' => 'No set parent_id to remove'];
        }

        if ($post['id'] == 0)
            throw new NotFoundHttpException(400, 'Главную категорию нельзя удалить');

        $model = new TreeMenuJson();
        $all = $model->all();
        $ids = $this->RecursiveTree2Delete($all, $post['id']);
        $value = $model->remove($ids);
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
