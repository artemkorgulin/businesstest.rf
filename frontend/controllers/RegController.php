<?php

namespace frontend\controllers;

use common\models\BitrixLead;
use common\models\UnisenderBackup;
use common\modules\business\frontend\models\Unisender;
use frontend\models\Registration;
use common\modules\organizations\components\RegionControl;
use common\modules\organizations\components\SchoolControl;
use common\modules\organizations\common\models\Region;

class RegController extends DefaultFrontendController
{
    /**
     * Флаг передачи в юнисендер
     * установить в true для реальной подписки в юнисендер
     */
    const UNISENDER_ENABLED = false;

    /**
     * Флаг передачи в битрикс
     * установить в true для реальной отправки лидов
     */
    const BITRIX_ENABLED = true;

    protected $registration = null;
    protected $regions = null;
    protected $schools = null;

    protected $currentRegion;

    public function actionSchoolControl($region = 1, $schoolName = null, $school = null, $class = null)
    {
        $this->ensureControls();

        $this->schools->schoolNameSelected = $schoolName;

        $this->schools->schoolSelected = $school;
        $this->registration->school_id = $school;

        $this->schools->classSelected = $class;
        $this->registration->class_id = $class;

        if (!$this->loadSchool($school)) {
            $this->loadRegion($region);
            $this->schools->loadByRegion($this->currentRegion);
        } else {
            $this->loadRegion($this->schools->getRegion());
            $this->schools->loadByRegion($this->currentRegion);
        }
        return $this->renderPartial('//_full-control', [
            'model' => $this->registration,
            'regions' => $this->regions,
            'schools' => $this->schools,

            'region' => $this->currentRegion->id,
            'school' => $this->schools->schoolSelected,
            'class' => $this->schools->classSelected,
        ]);

    }

    protected function registerUser()
    {
        $this->registration->source = 'default';
        if ($this->registration->validate()) {
            if ($user = $this->registration->save()) {
                Unisender::compose($user)->exchange(self::UNISENDER_ENABLED);
                BitrixLead::compose($user)->send(self::BITRIX_ENABLED);
                return true;
            }
        }
        return false;
    }

    public function actionIndex($region = 1, $schoolName = null, $school = null, $class = null, $source = 'default')
    {

        if (!\Yii::$app->user->isGuest) return $this->goHome();
        $this->ensureControls();

        if ($this->registration->load(\Yii::$app->request->post())) {
            if ($this->registerUser()) $this->goHome();
        }

        return $this->render('//sign-up', [
            'model' => $this->registration,
            'regions' => $this->actionSchoolControl(
                $region,
                $schoolName,
                $this->registration->school_id,
                $this->registration->class_id
            ),
            'errors' => $this->registration->getErrorSummary(false),
        ]);
    }

    /**
     * Построение контрола региона/школы по ID школы
     * @param $id
     * @return boolean
     */
    public function loadSchool($id)
    {
        $this->ensureControls();
        return $this->schools->loadByID($id);
    }

    /**
     * Постоенние контрола региона/школы по ID региона
     * @param int $id
     */
    public function loadRegion($id = 1)
    {
        $this->ensureControls();
        if ($region = Region::findOne(['id' => $id])) {
            $this->regions->reload($region);
        } else {
            $region = Region::findOne(['id' => 1]);
            $this->regions->reload($region);
        }
        $this->currentRegion = $region;
    }


    protected function getErrorsSummary()
    {
        return [];
    }

    protected function ensureControls()
    {
        if (null === $this->registration) $this->registration = new Registration();
        if (null === $this->regions) $this->regions = new RegionControl($this->registration);
        if (null === $this->schools) $this->schools = new SchoolControl($this->registration);
    }
}