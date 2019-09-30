<?php

namespace common\modules\organizations\common\models;

use Yii;

/**
 * This is the model class for table "zip".
 *
 * @property integer $id
 * @property integer $zip
 * @property integer $region_id
 *
 * @property Organization[] $organizations
 * @property Region $region
 */
class Zip extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zip';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['zip', 'region_id'], 'required'],
            [['zip', 'region_id'], 'integer'],
            [['zip'], 'unique'],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'zip' => 'Zip',
            'region_id' => 'Region ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizations()
    {
        return $this->hasMany(Organization::className(), ['zip' => 'zip']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }
}
