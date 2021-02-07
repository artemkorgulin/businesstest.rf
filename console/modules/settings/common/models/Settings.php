<?php

namespace common\modules\settings\common\models;

use Yii;

/**
 * This is the model class for table "{{%settings}}".
 *
 * @property integer $id
 * @property string $const_name
 * @property string $title
 * @property string $value
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%settings}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['const_name', 'title'], 'required'],
            [['value'], 'string'],
            [['const_name'], 'string', 'max' => 20],
            [['title'], 'string', 'max' => 255],
            [['const_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'const_name' => 'Имя свойства приложения',
            'title' => 'Назначение свойства',
            'value' => 'Значение',
        ];
    }
}
