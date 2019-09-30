<?php
namespace common\modules\organizations\components;
use yii\base\Model;

abstract class AbstractControl extends Model
{
    /**
     * @var OrganizationDepended
     */
    public $model;

    public function __construct($model, $config = [])
    {
        $this->model = $model;
        parent::__construct($config);
    }

}