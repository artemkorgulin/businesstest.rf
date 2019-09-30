<?php

namespace common\modules\business\common\models;

use Yii;

/**
 * This is the model class for table "{{%business_scale_result}}".
 *
 * @property integer $id
 * @property integer $scale_id
 * @property integer $pts_lo
 * @property integer $pts_hi
 * @property string $content1
 * @property string $content2
 *
 * @property BusinessScale $scale
 */
class BusinessScaleResult extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%business_scale_result}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['scale_id', 'pts_lo', 'pts_hi'], 'integer'],
            [['pts_lo', 'pts_hi'], 'required'],
            [['content1', 'content2'], 'string'],
            [['scale_id'], 'exist', 'skipOnError' => true, 'targetClass' => BusinessScale::className(), 'targetAttribute' => ['scale_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'scale_id' => 'Шкала',
            'pts_lo' => 'Баллов от',
            'pts_hi' => 'Баллов до',
            'content1' => 'Условия реализации',
            'content2' => 'Описание',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScale()
    {
        return $this->hasOne(BusinessScale::className(), ['id' => 'scale_id']);
    }
}
