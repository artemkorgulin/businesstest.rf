<?php
namespace common\modules\business\frontend\controllers;
use common\models\BitrixLead;
use common\models\User;
use common\models\UserProfile;
use common\modules\business\common\models\BusinessResult;
use common\modules\organizations\common\models\Region;
use frontend\controllers\DefaultFrontendController;
use common\modules\business\common\components\composer\BusinessTestComposer;
use yii\web\NotFoundHttpException;
use common\modules\business\common\components\result\BusinessResultComposer;

class NextController extends DefaultFrontendController
{
    public function actionIndex()
    {
        $composer = new BusinessTestComposer(['user_id' => \Yii::$app->user->id]);
        if ($composer->hasActiveTesting()) {
            if ($aggregate = $composer->getAggregateNext()) {
                $aggregate->setScenario('update');
                if ($aggregate->load(\Yii::$app->request->post()) && $aggregate->save()) {
                    return $this->redirect(['index']);
                }
                $object = $aggregate->getQuestion();
                return $this->render($object->view, [
                    'model' => $aggregate,
                    'question' => $object,
                    'progress' => $composer->countQuestions(),
                    'result' => BusinessResult::findOne(['user_id' => \Yii::$app->user->id])
                ]);
            } else {

                $user = UserProfile::findOne(['user_id' => \Yii::$app->user->id]);

                $data = [
                    'source' => 'business.synergyonline.ru',
                    'LOGIN'  => \Yii::$app->user->identity->email,
                    'NAME'   => $user->name_f . ' ' . $user->name_l,
                    'PERSONAL_MOBILE' =>  preg_replace("/[^0-9]/", '', $user->phone)
                ];

                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://my.synergy.ru/api/synergybase/v2/user/",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING   => "",
                    CURLOPT_MAXREDIRS  => 10,
                    CURLOPT_TIMEOUT    => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "PUT",
                    CURLOPT_POSTFIELDS => http_build_query($data),
                    CURLOPT_HTTPHEADER => array(
                        "authorization: dCOD4iGzjePn6rHtcpO6",
                        "content-type: application/x-www-form-urlencoded",
                    ),
                ));

                $response = curl_exec($curl);
                $info     = curl_getinfo($curl);
                $err      = curl_error($curl);

                curl_close($curl);

                $isMoscow = false;
                /**
                 * @var $region Region
                 */
                $region = $user->school->zipCode->region;

                if (in_array($region->id, [1, 2])) $isMoscow = true;
                else {
                    if($parent = $region->parent) {
                        if (in_array($parent->id, [1, 2])) $isMoscow = true;
                        else {
                            if($parent = $parent->parent) {
                                if (in_array($parent->id, [1, 2])) $isMoscow = true;
                            }
                        }
                    }
                }
                

                return $this->render('result', [
                    'model'    => new BusinessResultComposer(['result_id' => $composer->result->id]),
                    'response' => $response,
                    'info'     => $info,
                    'err'      => $err,
                    'region'   => $isMoscow,
                ]);
            }
        } else {
            throw new NotFoundHttpException();
        }
    }

    protected function showResultPage()
    {


        return $this->render('result');
    }
}