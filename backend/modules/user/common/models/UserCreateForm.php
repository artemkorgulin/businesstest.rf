<?php
namespace common\modules\user\common\models;
use yii\base\Model;
use backend\models\User;

class UserCreateForm extends Model
{
    public $email;
    public $phone;
    public $password;
    public $password_repeat;

    public $name_last;
    public $name_first;

    public $verifyCode;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\backend\models\User', 'message' => 'E-mail уже используется.'],

            ['phone', 'trim'],
            ['phone', 'required'],
            ['phone', 'unique', 'targetClass' => '\backend\models\User', 'message' => 'Номер телефона уже используется.'],

            ['password_repeat', 'required'],
            ['password_repeat', 'string', 'min' => 6],

            ['password', 'required'],
            ['password', 'compare', 'message' => \Yii::t('app', 'Пароль и подтверждение пароля не совпадают')],


            [['name_last', 'name_first'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => \Yii::t('app', 'E-mail'),
            'phone' => \Yii::t('app', 'Контактный телефон (не отображается на сайте)'),
            'name_last' => \Yii::t('app', 'Фамилия'),
            'name_first' => \Yii::t('app', 'Имя'),
            'password_repeat' => \Yii::t('app', 'Пароль'),
            'password' => \Yii::t('app', 'Подтверждение пароля'),
            'verifyCode' => \Yii::t('app', 'Код подтверждения'),
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new User();
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->name_last = $this->name_last;
        $user->name_first = $this->name_first;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        return $user->save() ? $user : null;
    }
}
