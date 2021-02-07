<?php
namespace common\modules\user\common\models;
use backend\models\User;
use yii\base\Model;
use yii\web\IdentityInterface;

/**
 * Class PasswordNewForm
 * Форма создания пароля с подтверждением
 *
 * @package common\modules\user\common\models
 */
class PasswordNewForm extends Model
{
    public $password;
    public $password_repeat;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password_repeat', 'required'],
            ['password_repeat', 'string', 'min' => 6],
            ['password', 'required'],
            ['password', 'compare', 'message' => \Yii::t('app', 'Password confirmation is not equal to Password')],
        ];
    }

    public function attributeLabels()
    {
        return [
            'password_repeat' => 'Пароль',
            'password' => 'Подтверждение пароля',
        ];
    }

    /**
     * Устанавливает новый пароль пользователю $idenity
     *
     * @param IdentityInterface $identity
     * @return null|IdentityInterface
     */
    public function save(IdentityInterface $identity)
    {
        if ($this->validate()) {
            /** @var $idenity User*/
            $identity->setPassword($this->password);
            if ($identity->save()) {
                return $identity;
            }
        }
        return null;
    }
}
