<?php

namespace common\modules\business\common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use mongosoft\file\UploadImageBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "business_variants_question".
 *
 * @property integer $id
 * @property integer $block_id
 * @property string $name
 * @property string $picture
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property BusinessVariantsAnswer[] $businessVariantsAnswers
 */
class BusinessVariantsQuestion extends \yii\db\ActiveRecord
{
    public $view = 'variant';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'business_variants_question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created_at', 'updated_at', 'block_id'], 'integer'],
            [['name'], 'string'],
            [['picture'], 'file', 'extensions'=>'png, jpg, jpeg, gif', 'on' => ['insert', 'update', 'delete']]
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),

            [
                'class' => UploadImageBehavior::className(),
                'attribute' => 'picture',
                'scenarios' => ['insert', 'update'],
                'path' => \Yii::$app->params['mediaDirectory'] . '/business/variants/{id}',
                'url'  => \Yii::$app->params['mediaUrl'] . '/business/variants/{id}',
                'thumbs' => [
                    'cover'    => ['width' => 640, ],
                    'mini'     => ['width' => 1280, ],
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

    public function getVariants()
    {
        return ArrayHelper::map(BusinessVariantsAnswer::find()->where(['question_id' => $this->id])->all(), 'id', 'name');
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Текст вопроса',
            'picture' => 'Фотография',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusinessVariantsAnswers()
    {
        return $this->hasMany(BusinessVariantsAnswer::className(), ['question_id' => 'id']);
    }

    /**
     * delete picture in server
     */
    public function deleteBusinessVariantsPictures()
    {
        @unlink(Yii::getAlias("@frontend/web/media/business/variants/{$this->id}/{$this->picture}"));
        @unlink(Yii::getAlias("@frontend/web/media/business/variants/{$this->id}/cover-{$this->picture}"));
        @unlink(Yii::getAlias("@frontend/web/media/business/variants/{$this->id}/mini-{$this->picture}"));
    }
}
