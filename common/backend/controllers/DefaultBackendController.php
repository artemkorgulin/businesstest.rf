<?php
namespace backend\controllers;
use yii\db\Exception;
use yii\web\AssetBundle;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use yii\web\ForbiddenHttpException;

class DefaultBackendController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => 'yii\filters\AccessControl',
                'rules' => [
                    [
                        'allow'   => true,
                        'actions' => ['error', 'login'],
                    ],

                    [
                    'allow'   => true,
                    'roles'   => ['backend-user'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function beforeAction($action)
    {
        if ($action->actionMethod == 'actionLogin') {
            return true;
        }

        if (parent::beforeAction($action)) {
            $this->_createBackendMenu();
            return \Yii::$app->user->can('backend-user');
        }
        return false;
    }

    /**
     * Собирает меню админки
     */
    protected function _createBackendMenu()
    {
        $backendMap = [];
        $roles = \Yii::$app->authManager->getRolesByUser(\Yii::$app->user->id);
        if (!isset($roles['backend-user'])) {
            $this->getView()->params['_backendMap']  = new ArrayDataProvider([]);
            return;
        }
        foreach ($modules = \Yii::$app->modules as $id => $module) {
            $className = is_object($module) ? get_class($module) : $module['class'];
            if (method_exists($className, 'backend')) {
                $config = $className::backend();
                $config['id'] = $id;
                if (!isset($config['visible'])) $config['visible'] = true;
                if (!$config['visible']) continue;
                $toolsMap = [];
                if (isset($config['tools']) && is_array($config['tools'])) foreach ($config['tools'] as $tid=>$tool) {
                    if (!is_array($tool)) $tool = [$tool];
                    if (!isset($tool['visible'])) $tool['visible'] = true;
                    if (!$tool['visible']) continue;
                    $toolsMap['/' . $id . '/' . $tid] = ['label' => array_shift($tool), 'url' => '/' . $id . '/' . $tid, 'active' => $this->id == $tid];
                }
                if (!empty($toolsMap)) {
                    $config['tools'] = $toolsMap;
                    unset($config['visible']);

                    if (isset($config['asset'])) {
                        $assetClass = $config['asset'];
                        /** @var AssetBundle $assetClass */
                        $bundle = $assetClass::register($this->getView());
                        if (isset($config['icon'])) $config['icon'] = $bundle->baseUrl . '/' . $config['icon'];
                    }
                    $config['id'] = $id;
                    $config['active'] = ($id == $this->moduleActive->id);
                    $backendMap['/' . $id] = $config;
                }

            }
        }
        $this->getView()->params['_backendMap']  = new ArrayDataProvider(['allModels' => $backendMap]);
    }

    public function getModuleActive()
    {
        return $this->module;
    }

}