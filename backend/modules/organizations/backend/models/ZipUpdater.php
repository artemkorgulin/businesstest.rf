<?php
namespace common\modules\organizations\backend\models;
use common\modules\organizations\common\models\Zip;
use yii\base\Model;

class ZipUpdater extends Model
{
    public $region_id = 0;
    public $zip = '';

    public function rules()
    {
        return [
            [['region_id', 'zip'], 'required'],
            [['region_id'], 'integer']
        ];
    }

    public $done = false;
    public $errors = [];
    public $updated = [];
    public $created = [];

    public function save()
    {
        if (!$this->validate()) return null;

        if (!empty($this->zip)) {
            $transaction = \Yii::$app->db->beginTransaction();
            $zList = explode("\n", $this->zip);
            if (is_array($zList)) foreach ($zList as $zip) {
                $zip = trim($zip);

                if (6 === strlen($zip)) {
                    if ($model = Zip::findOne(['zip' => $zip])) {
                        /** @var Zip $model */
                        $model->region_id = $this->region_id;
                        if ($model->save()) $this->updated[] = $zip;
                    } else {
                        $model = new Zip([
                            'zip' => $zip,
                            'region_id' => $this->region_id
                        ]);
                        if ($model->save()) $this->created[] = $zip;
                    }
                } else {
                    $this->errors[] = $zip;
                }
            }

            $transaction->commit();
            $this->done = true;
            return true;
        }


    }
}