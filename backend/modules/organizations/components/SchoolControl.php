<?php

namespace common\modules\organizations\components;

use common\modules\organizations\common\models\Region;
use common\modules\organizations\common\models\Organization;

class SchoolControl extends AbstractControl
{
    /**
     * @var Organization
     */
    private $_school;

    public $schoolSelected = null;

    public $classSelected = null;

    public $schoolNames = null;

    public $schoolNameSelected = null;

    public $schools = null;

    public $classes = null;

    public function getRegion()
    {
        if ($this->_school) {
            return $this->_school->zipCode->region_id;
        } else {
            return null;
        }
    }

    public function loadByID($id)
    {
        if ($this->_school = Organization::findOne(['id' => $id])) {
            $this->classes = $this->_school->getClasses(true);
            $this->schoolNameSelected = $this->_school->name;
            return true;
        }

        return false;
    }

    public function loadByRegion(Region $region)
    {
        $n = \Yii::$app->db->createCommand("
                select distinct o.name from organization o 
                join zip z on z.zip = o.zip 
                where z.region_id = :reg and o.id=o.merge_id order by name", ['reg' => $region->id])->queryAll();

        foreach ($n as $row) {
            if (null === $this->schoolNames) $this->schoolNames = ['' => 'Выберите учебное заведение:'];
            $this->schoolNames[$row['name']] = $row['name'];
        }

        if ($this->schoolNameSelected) {
            $n = \Yii::$app->db->createCommand("
                select o.id as id, o.address as address from organization o 
                join zip z on z.zip = o.zip 
                where z.region_id = :reg and o.name like :oname and o.id=o.merge_id order by name",
                ['reg' => $region->id, 'oname' => $this->schoolNameSelected])->queryAll();

            foreach ($n as $row) {
                if (count($n) === 1){
                    $this->schools[$row['id']] = $row['address'];
                    $this->schoolSelected = [$row['id']];
                    break;
                }
                if (null === $this->schools) $this->schools = ['' => 'Выберите адрес учебного заведения:'];
                $this->schools[$row['id']] = $row['address'];
            }
        }

    }

    public function reload(Organization $school = null, $class = null)
    {
        /*$this->schoolSelected = $school;
        $this->model->setSchool($school->id);
        $this->classSelected = $class;
        $this->model->setClass($class);*/
    }
}