<?php

namespace common\modules\organizations\common\models;

use Yii;

/**
 * This is the model class for table "region".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $level_id
 * @property string $name
 * @property string $name_display
 * @property integer $is_visible
 *
 * @property Zip[] $zips
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'level_id', 'is_visible'], 'integer'],
            [['name', 'name_display'], 'required'],
            [['name', 'name_display'], 'string', 'max' => 255],
            [['level_id'], 'validateRegion'],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZips()
    {
        return $this->hasMany(Zip::className(), ['region_id' => 'id']);
    }

    public static function findAllRegions()
    {
        $result = [0 => 'РФ'];
        $all = static::find()->orderBy(['name' => SORT_ASC])->all();
        foreach ($all as $reg) {
            /** @var Region $reg */
            $result[$reg->id] = $reg->name;
        }
        return $result;
    }

    public function validateRegion($attribute, $param)
    {
        if (0 == $this->parent_id) {
            $this->level_id = 0;
            return true;

        } elseif ($parent = Region::findOne(['id' => $this->parent_id])) {
            if ($parent->level_id < 2) {
                $this->level_id = $parent->level_id + 1;
            } else {
                $this->addError($attribute, 'Невозможно добавить регион. Регион назодится на нижнем уровне деления');
            }
        } else {
            $this->addError($attribute, 'Регион не найден');
        }
        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(self::className(), ['id' => 'parent_id']);
    }

    public function getPath($delimiter = '&nbsp;/&nbsp;')
    {
        $path = '';
        if ($p = $this->parent) {
            if ($g = $p->parent) $path .= $g->name_display . $delimiter;
            $path .= $p->name_display . $delimiter;
        }
        $path .= $this->name_display;
        return $path;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'           => 'ID',
            'parent_id'    => 'Родительский регион',
            'level_id'     => 'Уровень вложенности',
            'name'         => 'Название',
            'name_display' => 'Отображаемое название',
            'is_visible'   => 'Доступен для регистрации',
        ];
    }

    public function delete()
    {
        $this->is_visible = 0;
        return $this->save();
    }

    public function restore()
    {
        $this->is_visible = 1;
        return $this->save();
    }

}
