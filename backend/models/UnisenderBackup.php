<?php
namespace common\models;
use yii\db\ActiveRecord;
use Yii;

/**
 * Class UnisenderBackup
 * Подписка контакта на списки рассылок
 *
 * @package common\models
 */
abstract class UnisenderBackup extends ActiveRecord
{
    /**
     * Хендлер CURL
     * @var null|resource
     */
    private static $ch = null;

    /**
     * Возвращает флаг, выполнять ли подписку на заданный список рассылки
     * @param $listID
     * @return bool
     */
    public function beforeSubscribe($listID)
    {
        if ($listID) return true;
        return false;
    }

    /**
     * Подписывает контакт на списки рассылки,
     * полученные из метода getSubscribeLists() при условии, что
     * beforeSubscribe() вернул true
     */
    public function exchange()
    {
        $subscriptions = $this->getSubscribeLists();
        foreach ($subscriptions as $listID) {
            if ($this->beforeSubscribe($listID)) {
                $this->_subscribeToList($listID);
            }
        }
    }

    /**
     * Подписка на один список по идентификатору
     * @param $listID
     */
    public function subscribe($listID)
    {
        if ($listID) $this->_subscribeToList($listID);
    }


    /**
     * Сборка модели из иденити пользователя
     * @param $user
     * @return static
     */
    public static function compose(User $user)
    {
        $model = static::findOne(['email' => $user->email]);
        if (!$model) {

            $region = [];
            /** @var Region $reg */
            $reg = $user->profile->school->getRegion();
            if ($p = $reg->parent) {
                if ($g = $p->parent) {
                    $region[] = $g->name;
                }
                $region[] = $p->name;
            }
            $region[] = $reg->name;

            if (!isset($region[0])) $region[0] = null;
            if (!isset($region[1])) $region[1] = null;
            if (!isset($region[2])) $region[2] = null;

            $classes = $user->profile->school->getClasses();

            $model = new static([
                'email' => $user->email,
                'VAR_HAS_MSK_CITY' => 0,
                'VAR_HAS_MSK_DIST' => 0,
                'VAR_NAME_L' => $user->profile->name_l,
                'VAR_NAME_F' => $user->profile->name_f,
                'VAR_NAME_M' => $user->profile->name_m,
                'VAR_REGION' => $region[0],
                'VAR_MUNICIPALITY' => $region[1],
                'VAR_PLACEMENT' => $region[2],
                'VAR_SCHOOL_TYPE' => $user->profile->school->getType(),
                'VAR_SCHOOL_NAME' => $user->profile->school->name,
                'VAR_GRADUATION'  => $classes[$user->profile->class_id],
                'VAR_ACCESS_TOKEN'  => \Yii::$app->security->generateRandomString(32),
                'VAR_SEND_STATUS'   => '',
                'VAR_RECOVERY_CODE' => '',
                'VAR_RECOVERY_PT'   => $user->token_proftest,
                'VAR_RECOVERY_FG'   => $user->token_fgtest,
                'VAR_RECOVERY_BT'   => $user->token_btest
            ]);

            $model->save();
        }
        return $model;
    }


    // ==================================== OLD FUNCTIONALITY NOT REFACTORED YET =====================================

    const SCHOOL_MANAGERS = '10828265';

    const SCHOOL_PUPILS = '10828257';


    const CABINET_MAIN  = '12403973';   // активация личного кабинета
    const CABINET_PASS  = '12403981';   // восстановление пароля
    const PROFTEST_2018 = '12403985';   // профтест с токенами
    const FGTEST_2018   = '12403989';   // финграмотность с токенами

    /**
     * Списки рассылок, в которые будет добавлен контакт методом exchange()
     * @return array
     */
    abstract public function getSubscribeLists();

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%unisender_backup}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['send_id', 'VAR_HAS_MSK_CITY', 'VAR_HAS_MSK_DIST'], 'integer'],
            [['email'], 'required'],
            [['updated_at'], 'safe'],
            [['token_btest', 'token_fgtest', 'token_proftest'], 'safe'],
            [
                ['email',
                    'VAR_NAME_L', 'VAR_NAME_F', 'VAR_NAME_M',
                    'VAR_REGION', 'VAR_MUNICIPALITY', 'VAR_PLACEMENT',
                    'VAR_SCHOOL_TYPE', 'VAR_SCHOOL_NAME', 'VAR_GRADUATION',
                    'VAR_ACCESS_TOKEN', 'VAR_SEND_STATUS', 'VAR_RECOVERY_CODE',
                    'VAR_RECOVERY_PT', 'VAR_RECOVERY_FG', 'VAR_RECOVERY_BT'
                ],
                'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'send_id' => 'Send ID',
            'email' => 'Email',
            'VAR_NAME_L' => 'Var  Name  L',
            'VAR_NAME_F' => 'Var  Name  F',
            'VAR_NAME_M' => 'Var  Name  M',
            'VAR_REGION' => 'Var  Region',
            'VAR_MUNICIPALITY' => 'Var  Municipality',
            'VAR_PLACEMENT' => 'Var  Placement',
            'VAR_SCHOOL_TYPE' => 'Var  School  Type',
            'VAR_SCHOOL_NAME' => 'Var  School  Bane',
            'VAR_GRADUATION' => 'Var  Graduation',
            'VAR_ACCESS_TOKEN' => 'Var  Access  Token',
            'VAR_HAS_MSK_CITY' => 'Var  Has  Msk  City',
            'VAR_HAS_MSK_DIST' => 'Var  Has  Msk  Dist',
            'VAR_SEND_STATUS' => 'Var  Send  Status',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @param $listID
     */
    protected function _subscribeToList($listID)
    {
        $attributes = $this->attributes;
        unset($attributes['id']);
        unset($attributes['send_id']);
        unset($attributes['updated_at']);
        unset($attributes['email']);
        $post = [
            'api_key' => Yii::$app->params['unisender']['apiKey'],
            'list_ids' => $listID,
            'fields[email]'    => $this->email,
            'overwrite' => 1
        ];
        foreach ($attributes as $k => $v) $post["fields[{$k}]"] = $v;
        $this->ensureCurl();

        curl_setopt(self::$ch, CURLOPT_URL, Yii::$app->params['unisender']['apiUrl'] . 'subscribe?format=json');
        curl_setopt(self::$ch, CURLOPT_POSTFIELDS, $post);
        $result = curl_exec(self::$ch);

        $log = new UnisenderLog([
            'email' => $this->email,
            'request' => json_encode($post),
            'response' => $result
        ]);

        $log->save();

        $result = json_decode($result, true);

        if (isset($result['result']['person_id'])) {
            $this->send_id = $result['result']['person_id'];
            if (!$this->save()) {
                // print_r($this->getErrors());
            }
        }

    }




    private function ensureCurl()
    {
        if (null === self::$ch) {
            self::$ch = curl_init();
            curl_setopt(self::$ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt(self::$ch, CURLOPT_POST, 1);
            curl_setopt(self::$ch, CURLOPT_TIMEOUT, 10);
        }
    }

    public function __destruct()
    {
        if (null !== self::$ch) curl_close(self::$ch);
    }

}