<?php
namespace common\models;
use yii\base\Model;

/**
 * Class ChangePasswordForm
 * Форма изменения пароля самим пользователем.
 * Для изменения пароля пользователь должен ввести действующий пароль, новый пароль и
 * подтверждение нового пароля.
 *
 * @package common\models
 */
class ChangePasswordForm extends Model
{
    public $old_password;
    public $password;
    public $password_repeat;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['old_password', 'validatePassword'],
            [['old_password', 'password_repeat'], 'required'],
            ['password_repeat', 'string', 'min' => 6],
            ['password', 'required'],
            ['password', 'compare', 'message' => \Yii::t('app', 'Пароль и подтверждение пароля не совпадают')],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'old_password' => 'Действующий пароль',
            'password_repeat' => 'Новый пароль',
            'password' => 'Подьверждение пароля',
        ];
    }

    /**
     * Введенный действующий пароль должен совпадать с паролем текущего пользователя
     * @param $attribute
     * @param $params
     */
    public function validatePassword($attribute, $params)
    {
        /** @var User $user */
        $user = \Yii::$app->user->getIdentity();
        if (!$user->validatePassword($this->old_password)) {
            $this->addError('old_password', 'Вы ошиблись при вводе пароля');
        }
    }

    public function save()
    {
        if (!$this->validate()) return null;

        /** @var User $user */
        $user = \Yii::$app->user->getIdentity();
        $user->setPassword($this->password);
        if ($user->save()) {
            //todo: set flash
            return $user;
        }
        return null;
    }
}