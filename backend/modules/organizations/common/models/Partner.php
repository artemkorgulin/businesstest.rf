<?php

namespace common\modules\organizations\common\models;

use Yii;

/**
 * This is the model class for table "{{%partner}}".
 *
 * @property integer $id
 * @property string $key
 * @property string $hint
 */
class Partner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%partner}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'hint'], 'string', 'max' => 255],
            [['key'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => 'Key',
            'hint' => 'Hint',
        ];
    }
}
