<?php

namespace common\modules\business\common\models;

use mongosoft\file\UploadImageBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%business_pictured}}".
 *
 * @property integer $id
 * @property string $question_text
 * @property string $variant1_text
 * @property string $variant1_pict
 * @property string $variant2_text
 * @property string $variant2_pict
 * @property string $variant3_text
 * @property string $variant3_pict
 * @property integer $created_at
 * @property integer $updated_at
 */
class BusinessPictured extends \yii\db\ActiveRecord
{
    public $view = 'picture';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%business_pictured}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),

            [
                'class' => UploadImageBehavior::className(),
                'attribute' => 'variant1_pict',
                'scenarios' => ['insert', 'update'],
                'path' => \Yii::$app->params['mediaDirectory'] . '/business/pictured/{id}',
                'url'  => \Yii::$app->params['mediaUrl'] . '/business/pictured/{id}',
                'thumbs' => [
                    'cover'    => ['width' => 640, ],
                    'mini'     => ['width' => 320, ],
                ]
            ],

            [
                'class' => UploadImageBehavior::className(),
                'attribute' => 'variant2_pict',
                'scenarios' => ['insert', 'update'],
                'path' => \Yii::$app->params['mediaDirectory'] . '/business/pictured/{id}',
                'url'  => \Yii::$app->params['mediaUrl'] . '/business/pictured/{id}',
                'thumbs' => [
                    'cover'    => ['width' => 640, ],
                    'mini'     => ['width' => 320, ],
                ]
            ],

            [
                'class' => UploadImageBehavior::className(),
                'attribute' => 'variant3_pict',
                'scenarios' => ['insert', 'update'],
                'path' => \Yii::$app->params['mediaDirectory'] . '/business/pictured/{id}',
                'url'  => \Yii::$app->params['mediaUrl'] . '/business/pictured/{id}',
                'thumbs' => [
                    'cover'    => ['width' => 640, ],
                    'mini'     => ['width' => 320, ],
                ]
            ],
        ];
    }

    public function getImageUrl($attribute, $size = null)
    {
        if ($size) {
            return $this->getThumbUploadUrl($attribute, $size);
        } else {
            return $this->getUploadUrl($attribute);
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question_text', 'variant1_text', 'variant2_text', 'variant3_text'], 'required'],
            [['variant1_result', 'variant2_result', 'variant3_result', ], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['question_text', 'variant1_text', 'variant2_text', 'variant3_text'], 'string', 'max' => 255],
            [['variant1_pict', 'variant2_pict', 'variant3_pict'], 'file', 'extensions'=>'png, jpg, jpeg, gif', 'on' => ['insert', 'update']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question_text' => 'Текст вопроса',
            'variant1_text' => 'Текст 1 варианта ответа',
            'variant1_result' => 'Результат 1 варианта ответа',
            'variant2_result' => 'Результат 2 варианта ответа',
            'variant3_result' => 'Результат 3 варианта ответа',
            'variant1_pict' => 'Изображение 1 варианта ответа',
            'variant2_text' => 'Текст 2 варианта ответа',
            'variant2_pict' => 'Изображение 2 варианта ответа',
            'variant3_text' => 'Текст 3 варианта ответа',
            'variant3_pict' => 'Изображение 3 варианта ответа',
            'created_at' => 'Добавлено',
            'updated_at' => 'Отредактировано',
        ];
    }
}
