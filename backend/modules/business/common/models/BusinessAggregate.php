<?php

namespace common\modules\business\common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "business_aggregate".
 *
 * @property integer $id
 * @property integer $result_id
 * @property integer $block_id
 * @property integer $question_id
 * @property integer $answer_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property $question BusinessScale|BusinessPictured|BusinessVariantQuestion
 *
 * @property BusinessResult $result
 */
class BusinessAggregate extends \yii\db\ActiveRecord
{
    const QUESTION_SCALED = 40;
    const QUESTION_PICTURED = 50;

    private $_object = null;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'business_aggregate';
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
    public function rules()
    {
        return [
            [['result_id', 'block_id', 'question_id'], 'required'],
            [['answer_id'], 'required', 'on' => 'update'],
            [['result_id', 'block_id', 'question_id', 'answer_id', 'created_at', 'updated_at'], 'integer'],
            [['result_id'], 'exist', 'skipOnError' => true, 'targetClass' => BusinessResult::className(), 'targetAttribute' => ['result_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'result_id' => 'Result ID',
            'block_id' => 'Block ID',
            'question_id' => 'Question ID',
            'answer_id' => 'Ваш ответ',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getQuestion()
    {
        $this->ensureObject();
        return $this->_object;
    }

    private function ensureObject()
    {
        if (!$this->_object) {


            switch ($this->block_id) {

                case self::QUESTION_PICTURED:
                    // выпал вопрос на выбор картинки
                    $this->_object = BusinessPictured::findOne(['id' => $this->question_id]);
                break;

                case self::QUESTION_SCALED:
                    // выпал вопрос из шкалы
                    $this->_object = BusinessScaleQuestion::findOne(['id' => $this->question_id]);
                break;

                default:
                    $this->_object = BusinessVariantsQuestion::findOne(['id' => $this->question_id]);
            }
        }
    }

    public function setQuestion($question)
    {
        if ($question instanceof BusinessScaleQuestion) {
            $this->block_id = self::QUESTION_SCALED;
        } elseif ($question instanceof BusinessPictured) {
            $this->block_id = self::QUESTION_PICTURED;
        } elseif ($question instanceof BusinessVariantsQuestion) {
            $this->block_id = $question->block_id;
        }
        $this->question_id = $question->id;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResult()
    {
        return $this->hasOne(BusinessResult::className(), ['id' => 'result_id']);
    }
}
