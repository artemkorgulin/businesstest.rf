<?php
namespace common\modules\organizations\backend\controllers;
use backend\controllers\DefaultBackendController;
use common\modules\organizations\common\models\Organization;
use moonland\phpexcel\Excel;
use yii\web\ForbiddenHttpException;

class UploadController extends DefaultBackendController
{
    public $result = [
        'u' => 0, 'a' => 0, 'e' => 0,
    ];

    private function uploadFile($fileName, $partnerName = null)
    {
        if (file_exists($fileName)) {
            if ($excel = Excel::import($fileName)) {
                foreach ($excel as $row) {
                    if (!empty($row['ID']) && ($o = Organization::findOne(['id' => $row['ID']]))) {
                        $o->zip  = intval(trim($row['zip']));
                        $o->name = trim($row['name']);
                        $o->address = trim($row['address'] . ', ' . $row['zip']);
                        $o->phone = '+' . trim($row['phones']);

                        $o->type_id = ('Школа' == $row['type']) ? 2 : 1;

                        $o->partner = $partnerName;
                        if ($o->save()) ++ $this->result['u'];
                        else ++ $this->result['e'];

                    } elseif (empty($row['ID'])) {
                        $o = new Organization([
                            'zip' => intval(trim($row['zip'])),
                            'name' => trim($row['name']),
                            'address' => trim($row['address'] . ', ' . $row['zip']),
                            'phone' => '+' . trim($row['phones']),
                        ]);

                        $o->type_id = ('Школа' == $row['type']) ? 2 : 1;

                        $o->partner = $partnerName;

                        if ($o->save()) {
                            $o->merge_id = $o->id;
                            $o->save();
                            ++ $this->result['a'];
                        }
                        else {
                            print_r($row);
                            print_r($o->getErrors());
                            ++ $this->result['e'];
                        }

                    } else {
                        ++ $this->result['e'];
                    }
                }

                echo '<pre> partner: ' . $partnerName;
                print_r($this->result);
            }
        }
    }

    public function actionIndex()
    {
        throw new ForbiddenHttpException();

        set_time_limit(0);

        $this->uploadFile(\Yii::getAlias('@common' . '/docs/dp1.xlsx'), 'pstolbova');
        $this->uploadFile(\Yii::getAlias('@common' . '/docs/dp2.xlsx'), 'pverkholantseva');

        echo '<pre>';
        print_r($this->result);
        echo '</pre>';

        die('<li> upload done');
    }
}