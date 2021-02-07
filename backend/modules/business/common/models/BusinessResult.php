<?php

namespace common\modules\business\common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use backend\models\User;

/**
 * This is the model class for table "business_result".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $is_complete_main
 * @property integer $is_complete_know
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 */
class BusinessResult extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'business_result';
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
            [['user_id', 'is_complete_main', 'is_complete_know', 'created_at', 'updated_at'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'is_complete_main' => 'Is Complete Main',
            'is_complete_know' => 'Is Complete Know',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
