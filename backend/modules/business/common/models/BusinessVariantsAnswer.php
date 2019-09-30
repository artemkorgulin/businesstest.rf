<?php

namespace common\modules\business\common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "business_variants_answer".
 *
 * @property integer $id
 * @property integer $question_id
 * @property string $name
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property BusinessVariantsQuestion $question
 */
class BusinessVariantsAnswer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'business_variants_answer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question_id', 'created_at', 'updated_at', 'is_correct'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => BusinessVariantsQuestion::className(), 'targetAttribute' => ['question_id' => 'id']],
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
            'question_id' => 'Вопрос',
            'name' => 'Текст ответа',
            'is_correct' => 'Правильный вариант ответа',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(BusinessVariantsQuestion::className(), ['id' => 'question_id']);
    }
}
