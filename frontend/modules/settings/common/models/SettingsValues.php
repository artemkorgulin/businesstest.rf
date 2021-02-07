<?php
namespace frontend\modules\settings\common\models;
use yii\base\Model;

/**
 * Class SettingsValues
 * Разворачивает модель Settings для упрощения формы установки параметров
 * @package common\modules\settings\common\models
 */
class SettingsValues extends Model
{
    protected $_settings = null;

    protected $_labels = [];

    public function __get($name)
    {
        $this->ensureSettings();
        if (isset($this->_settings[$name])) {
            return $this->_settings[$name]->value;
        }
        else return parent::__get($name);
    }

    public function __set($name, $value)
    {
        $this->ensureSettings();
        if (isset($this->_settings[$name])) {
            $this->_settings[$name]->value = $value;
        } else {
            return parent::__set($name, $value);
        }

    }

    public function save()
    {
        $this->ensureSettings();
        foreach ($this->_settings as $setting) {
            if (!$setting->save()) return null;
        }
        return $this;
    }

    public function load($data, $formName = null)
    {
        $this->ensureSettings();
        if (isset($data['SettingsValues'])) {
            foreach ($data['SettingsValues'] as $k=>$v) {
                $this->$k = $v;
            }
            return true;
        } else {
            return parent::load($data, $formName);
        }
    }

    public function attributeLabels()
    {
        $this->ensureSettings();
        return $this->_labels;
    }

    public function ensureSettings()
    {
        if (null === $this->_settings) {
            $this->_settings = [];
            if ($all = Settings::find()->all()) foreach ($all as $setting) {
                /** @var Settings $setting */
                $this->_settings[$setting->const_name] = $setting;
                $this->_labels[$setting->const_name] = $setting->title;
            }
        }
    }
}
