<?php
namespace common\modules\organizations\components;
use common\modules\organizations\common\models\Region;

class RegionControl extends AbstractControl
{
    /**
     * Выбранный регион
     * @var null
     */
    public $regionSelected = null;

    /**
     * Варианты выбора
     * @var array
     */
    public $region_items = [];

    /**
     * Получение списка регионов на одном уровне
     * @param $parent
     * @param null $selected
     * @return array
     */
    private static function getRegionsList($parent, $selected = null)
    {
        $result = ['variants' => [], 'selected' => $selected];
        $before = Region::find()
            ->where(['is_visible' => 1, 'parent_id' => $parent])
            ->orderBy(['name_display' => SORT_ASC])
            ->all();
        if (is_array($before)) foreach ($before as $region){
            if (empty($result['variants'])) $result['variants'] = ['' => 'Выберите:'];
            $result['variants'][$region->id] = $region->name_display;
        }
        return $result;
    }

    /**
     * Проверка наличия заполненных вариантов региона на заданнном уровне
     *
     * @param $level_id
     * @return bool
     */
    public function hasRegionLevel($level_id)
    {
        return isset($this->region_items[$level_id]['variants'])
            && !empty($this->region_items[$level_id]['variants']);
    }

    /**
     * ID выбранного региона
     * @return integer
     */
    public function getLevel0(){ return $this->region_items[0]['selected']; }

    /**
     * ID выбранного муниципалитета
     * @return integer
     */
    public function getLevel1(){ return $this->region_items[1]['selected']; }

    /**
     * ID выбранного населенного пункта
     * @return integer
     */
    public function getLevel2(){ return $this->region_items[2]['selected']; }

    /**
     * Сборка дерева контролов - варианты и выбранный вариант
     * @param Region $region
     */
    public function reload(Region $region)
    {
        $this->regionSelected = $region;
        $this->model->setRegion($region->id);

        switch ($region->level_id) {

            case 0: // Если выбран ID региона
                $this->region_items[0] = self::getRegionsList(0, $region->id);
                $this->region_items[1] = self::getRegionsList($region->id);
                break;

            case 1: // Муниципалитет
                $this->region_items[0] = self::getRegionsList(0, $region->parent_id);
                $this->region_items[1] = self::getRegionsList($region->parent_id, $region->id);
                $this->region_items[2] = self::getRegionsList($region->id);
                break;

            case 2: // Населенный пункт
                $topRegionID = $region->parent->parent_id;
                $this->region_items[0] = self::getRegionsList(0, $topRegionID);
                $this->region_items[1] = self::getRegionsList($topRegionID, $region->parent_id);
                $this->region_items[2] = self::getRegionsList($region->parent_id, $region->id);
                break;

            // default не нужен :) это не баг
        }
    }

}