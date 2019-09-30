<?php

namespace common\modules\business\common\models;

use Yii;

/**
 * This is the model class for table "{{%business_remove}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $removal
 */
class BusinessRemove extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%business_remove}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'removal'], 'required'],
            [['removal'], 'string'],
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
            'name' => 'Исключающая характеристика',
            'removal' => 'Исключаемые характеристики',
        ];
    }
}
