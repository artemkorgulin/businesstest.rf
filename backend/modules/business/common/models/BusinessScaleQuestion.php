<?php

namespace common\modules\business\common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "business_scale_question".
 *
 * @property integer $id
 * @property integer $scale_id
 * @property string $name
 * @property integer $pts_yes
 * @property integer $pts_no
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property BusinessScale $scale
 */
class BusinessScaleQuestion extends \yii\db\ActiveRecord
{
    public $view = 'scale';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'business_scale_question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['scale_id', 'pts_yes', 'pts_no', 'created_at', 'updated_at'], 'integer'],
            [['name', 'pts_yes', 'pts_no'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['scale_id'], 'exist', 'skipOnError' => true, 'targetClass' => BusinessScale::className(), 'targetAttribute' => ['scale_id' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'scale_id' => 'Шкала оценки',
            'name' => 'Текст вопроса',
            'pts_yes' => 'Баллов за ответ ДА',
            'pts_no' => 'Баллов за ответ НЕТ',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
