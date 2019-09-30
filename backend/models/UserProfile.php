<?php

namespace common\models;

use yii\db\ActiveRecord;
use common\modules\organizations\common\models\Organization;
use common\modules\organizations\common\models\ProftestResult;

/**
 * Class UserProfile
 * @property integer $id
 * @property integer $user_id
 * @property string $name_l
 * @property string $name_f
 * @property string $name_m
 * @property string $phone
 * @property integer $school_id
 * @property integer $class_id
 * @property string $b_date
 * @property integer $gender_id
 *
 * @property Organization $school
 * @property User $user
 *
 * @package common\models
 */
class UserProfile extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_profile}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'name_l', 'name_f', 'phone', 'school_id', 'class_id', 'b_date', 'gender_id'], 'required'],
            [['user_id', 'school_id', 'class_id', 'gender_id'], 'integer'],
            [['b_date'], 'safe'],
            [['name_l', 'name_f', 'name_m', 'phone'], 'string', 'max' => 255],
            [['school_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['school_id' => 'id']],
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
            'name_l' => 'Name L',
            'name_f' => 'Name F',
            'name_m' => 'Name M',
            'phone' => 'Phone',
            'school_id' => 'School ID',
            'class_id' => 'Class ID',
            'b_date' => 'B Date',
            'gender_id' => 'Gender ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchool()
    {
        return $this->hasOne(Organization::className(), ['id' => 'school_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResult()
    {
        return $this->hasOne(ProftestResult::className(), ['user_id' => 'id']);
    }

}