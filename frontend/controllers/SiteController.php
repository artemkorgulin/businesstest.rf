<?php

namespace frontend\controllers;

use common\models\User;
use common\models\UserProfile;
use common\modules\business\common\components\result\BusinessResultComposer;
use common\modules\business\common\models\BusinessResult;
use common\modules\organizations\common\models\Region;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\NotFoundHttpException;
use kartik\mpdf\Pdf;

/**
 * Site controller
 */
class SiteController extends DefaultFrontendController
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
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->renderPartial('index');
        } else {
            return $this->render('index-inner');
        }
    }

    public function actionInstruction()
    {
        $completePath = Yii::getAlias('@webroot') . '/instruction.pdf';
        return Yii::$app->response->sendFile($completePath, 'instruction.pdf', ['inline' => true]);
    }


    public function actionCert($id, $token)
    {
        if ($user = User::findOne(['id' => $id, 'token_btest' => $token])) {
            if ($result = BusinessResult::findOne(['user_id' => $user->id])) {
                $profile = UserProfile::findOne(['user_id' => $id]);

                $RegionId = (new \yii\db\Query())
                    ->select(['r.id'])
                    ->from('user_profile up')
                    ->join('JOIN', 'organization o', 'up.school_id = o.id')
                    ->join('JOIN', 'zip z', 'o.zip = z.zip')
                    ->join('JOIN', 'region r', 'z.region_id = r.id')
                    ->where("up.user_id = $id")
                    ->all();

                $Moscow = Region::findOne(['name' => 'Москва']);
                $Region = Region::findOne(['id' => intval($RegionId[0]['id'])]);

                $isMoscowRegion = false;
                if ($Region->id == $Moscow->id || $Region->parent_id == $Moscow->id) {
                    $isMoscowRegion = true;
                }

                // после 09.11.18 выводим сертификаты нового образца
                if ($result->created_at > 1541721600) {
                    $view = 'cert_2018';
                    $orientation = Pdf::ORIENT_LANDSCAPE;
                } else {
                    $view = 'cert';
                    $orientation = Pdf::ORIENT_PORTRAIT;
                }

                $content = $this->renderPartial($view, [
                    'model' => $profile,
                    'isMoscowRegion' => $isMoscowRegion,
                ]);

                $pdf = new Pdf([
                    //mode' => Pdf::MODE_CORE,
                    // A4 paper format
                    //'format' => Pdf::FORMAT_A4,
                    // portrait orientation
                    'orientation' => $orientation,
                    'marginLeft' => 0,
                    'marginRight' => 0,
                    'marginTop' => 0,
                    'marginBottom' => 0,
                    // stream to browser inline
                    'destination' => Pdf::DEST_BROWSER,
                    // your html content input
                    'content' => $content,
                    // format content from your own css file if needed or use the
                    // enhanced bootstrap css built by Krajee for mPDF formatting
                    'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
                    // any css to be embedded if required
                    'cssInline' => '.kv-heading-1{font-size:18px;color:red}',
                ]);

                return $pdf->render();

            }
        }
        throw new NotFoundHttpException('Результат тестирования не найден');
    }

    public function actionResult($id, $token, $toPdf = true)
    {
        if ($user = User::findOne(['id' => $id, 'token_btest' => $token])) {
            if ($result = BusinessResult::findOne(['user_id' => $user->id])) {
                $pdf = null;

                $content = $this->renderPartial('@common/modules/business/backend/views/result/_pupil', [
                    // 'model'  => $result,
                    'model' => new BusinessResultComposer(['result_id' => $result->id])
                ]);

                $profile = UserProfile::findOne(['user_id' => $id]);

                if ($toPdf) {


                    $pdf = new Pdf([
                        // set to use core fonts only
                        // 'mode' => Pdf::MODE_CORE,
                        // A4 paper format
                        'format' => Pdf::FORMAT_A4,
                        // portrait orientation
                        'orientation' => Pdf::ORIENT_PORTRAIT,
                        // stream to browser inline
                        'destination' => Pdf::DEST_BROWSER,
                        // your html content input
                        'content' => $content,
                        // format content from your own css file if needed or use the
                        // enhanced bootstrap css built by Krajee for mPDF formatting
                        'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
                        // any css to be embedded if required
                        'cssInline' => '.kv-heading-1{font-size:18px}',
                        // set mPDF properties on the fly
                        'options' => ['title' => 'Krajee Report Title'],
                        // call mPDF methods on the fly

                    ]);

                    return $pdf->render();

                } else {
                    return $content;
                }
            }
        }
        throw new NotFoundHttpException('Результат тестирования не найден');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Регистрация участника тестирования.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['index']);
        }
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect(['index']);
                }
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
