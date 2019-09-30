<?php

namespace common\modules\organizations\common\models;

use Yii;

/**
 * This is the model class for table "organization".
 *
 * @property integer $id
 * @property integer $zip
 * @property integer $merge_id
 * @property integer $type_id
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $url
 *
 * @property Zip $zip0
 * @property UserProfile[] $userProfiles
 */
class Organization extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organization';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['zip'], 'required'],
            [['zip', 'merge_id', 'type_id'], 'integer'],
            [['name', 'address', 'phone', 'url', 'partner'], 'string', 'max' => 255],
            [['zip'], 'exist', 'skipOnError' => true, 'targetClass' => Zip::className(), 'targetAttribute' => ['zip' => 'zip']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'zip' => 'Индекс',
            'merge_id' => 'Merge ID',
            'status' => 'Статус',
            'type_id' => 'Тип',
            'type' => 'Тип',
            'name' => 'Наименование',
            'address' => 'Адрес',
            'phone' => 'Телефон',
            'url' => 'Сайт',
        ];
    }

    public function getType()
    {
        return 2 == $this->type_id
            ? 'Школа'
            : 'Колледж';
    }

    public function getStatus()
    {
        if ($this->id === $this->merge_id) {
            return null;
        } else {
            return $this->merge_id;
        }
    }

    public static function getSchoolClasses($withEmpty = false)
    {
        $arr = [
            0  => 'Выберите класс:',
            7  => '7 класс',
            8  => '8 класс',
            9  => '9 класс',
            10 => '10 класс',
            11 => '11 класс',
            1  => 'Остальные классы',
            2  => 'Преподаватели и методисты',
        ];
        if (!$withEmpty) unset($arr[0]);
        return $arr;
    }

    public static function getCollegeGroups($withEmpty = false)
    {
        $arr = [
            0  => 'Выберите курс:',
            7  => 'Первый курс',
            1  => 'Остальные курсы',
            11 => 'Последний курс',
            2  => 'Преподаватели и методисты',
        ];
        if (!$withEmpty) unset($arr[0]);
        return $arr;
    }

    public function getRegion()
    {
        return $this->zipCode->region;
    }


    public function getClasses($withEmpty = false)
    {
        if (31898 == $this->id) {
            return [0  => 'Выберите:', 1 => 'Эксперт'];
        }

        switch ($this->type_id) {
            case 1:
                return static::getCollegeGroups($withEmpty);
                break;

            case 2:
                return static::getSchoolClasses($withEmpty);
                break;

            default:
                return null;
        }
    }

    public static function getTypeItems()
    {
        return [
            1 => 'Колледж',
            2 => 'Школа'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZipCode()
    {
        return $this->hasOne(Zip::className(), ['zip' => 'zip']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfiles()
    {
        return $this->hasMany(UserProfile::className(), ['school_id' => 'id']);
    }
}
