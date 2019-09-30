<?php

namespace common\modules\organizations\common\models;

use Yii;

/**
 * This is the model class for table "organization".
 *
 * @property integer $id
 * @property integer $zip
 * @property integer $merge_id
 * @property integer $type_id
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $url
 *
 * @property Zip $zip0
 * @property UserProfile[] $userProfiles
 */
class ProftestResult extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'business_result';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
        ];
    }
}
