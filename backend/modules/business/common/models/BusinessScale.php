<?php

namespace common\modules\business\common\models;

use Yii;

/**
 * This is the model class for table "business_scale".
 *
 * @property integer $id
 * @property string $name
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property BusinessScaleQuestion[] $businessScaleQuestions
 */
class BusinessScale extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'business_scale';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'comment', 'result_hi', 'result_me', 'result_lo'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'comment' => 'Описание',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'result_hi' => 'Высокий результат',
            'result_me' => 'Средний результат',
            'result_lo' => 'Низкий результат',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusinessScaleQuestions()
    {
        return $this->hasMany(BusinessScaleQuestion::className(), ['scale_id' => 'id']);
    }
}
