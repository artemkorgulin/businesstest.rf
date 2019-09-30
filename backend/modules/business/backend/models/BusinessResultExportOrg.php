<?php

namespace common\modules\business\backend\models;

use Yii;
use yii\db\Query;
use common\modules\business\common\models\BusinessResult;
use common\modules\organizations\backend\models\RegionSearch;

/**
 * BusinessResultSearch represents the model behind the search form about `common\modules\business\common\models\BusinessResult`.
 */
class BusinessResultExportOrg extends BusinessResult
{
    public $csv = 'report_light.csv';
    public $max_limit = 100000;

    public function export()
    {
        $dataProvider = [];
        $csv = '/reports/' . Yii::$app->user->id . '_' . $this->csv;
        $mode = (Yii::$app->request->get('continue') == 1) ? 'a' : 'w';
        $fp = fopen(Yii::getAlias('@webroot') . $csv, $mode);
        fputs($fp, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));

        $parent_id = (int)Yii::$app->request->get('parent');
        if ($parent_id < 1) return false;

        $regions_condition = 'parent_id in(' . $this->getRegionsId($parent_id) . ')';

        $date_condition = 'date_format(FROM_UNIXTIME(user.updated_at), \'%d.%m.%y\') = "' . date('d.m.y', strtotime(Yii::$app->request->get('date'))) . '"';

        $offset = (int)Yii::$app->request->get('offset');
        $limit = (int)Yii::$app->request->get('limit');
        if ($limit < 1 || $limit > $this->max_limit) $limit = $this->max_limit;

        if ($offset < 1) {
            $attributes = ['id', 'Название школы', 'Адрес', 'Населенный пункт', 'Количество заполненных анкет'];
            fputcsv($fp, $attributes, ';');
        }

        $query = new Query;
        $query->from('user_profile')
            ->select('organization.id, organization.name, organization.address, region.name_display, count(user_profile.id)')
            ->leftJoin('user', 'user.id = user_profile.user_id')
            ->leftJoin('organization', 'organization.id = user_profile.school_id')
            ->leftJoin('zip', 'zip.zip = organization.zip')
            ->leftJoin('region', 'region.id = zip.region_id')
            ->where($date_condition)
            ->andWhere($regions_condition)
            ->groupBy('organization.id')
            ->orderBy('user.updated_at')
            ->limit($limit)
            ->offset($offset);

        $i = 0;
        if ($detail = $query->each()) {
            foreach ($detail as $item) {
                $i++;
                if ($i >= $limit) {
                    $dataProvider['error_limit'] = true;
                    if ((int)Yii::$app->request->get('limit') > $this->max_limit) $dataProvider['limit'] = $this->max_limit;
                    return $dataProvider;
                } else $dataProvider['report'] = $csv;

                fputcsv($fp, $item, ';');
            }
        }

        fclose($fp);
        return $dataProvider;
    }

    public function getRegionsId($parent_id)
    {
        $regions_ids = $parent_id;
        $searchModel = new RegionSearch(['parent_id' => $parent_id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $regions = $dataProvider->query->select('id')->all();
        foreach ($regions as $region) {
            $regions_ids .= ',' . $region['id'];
        }
        return trim($regions_ids, ',');
    }
}
