<?php
namespace common\modules\organizations\components;

interface OrganizationDepended
{
    public function setRegion($region);
    public function setSchool($school);
    public function setClass($class);
}
