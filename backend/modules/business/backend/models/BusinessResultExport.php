<?php
/**
 * Created by PhpStorm.
 * User: AKoloskova
 * Date: 19.11.2018
 * Time: 13:26
 */

namespace common\modules\business\backend\models;

use Yii;
use yii\db\Query;
use common\modules\business\common\models\BusinessResult;
use common\modules\business\common\models\BusinessScaleQuestion;
use common\modules\business\common\models\BusinessVariantsQuestion;
use common\modules\business\common\models\BusinessVariantsAnswer;
use common\modules\business\common\models\BusinessPictured;

class BusinessResultExport extends BusinessResult
{
    public $csv = 'report.csv';
    public $max_limit = 10000;

    public static function tableName()
    {
        return 'v_pupil_all_details';
    }

    public function export()
    {
        $csv = '/reports/' . Yii::$app->user->id . '_' . $this->csv;
        $mode = (Yii::$app->request->get('continue') == 1) ? 'a' : 'w';
        $fp = fopen(Yii::getAlias('@webroot') . $csv, $mode);
        fputs($fp, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));

        $dataProvider = [];
        $region_condition = [];

        $qa = $this->getQuestionsAndAnswers();

        $level = Yii::$app->request->get('level');
        if ($level == 0) $region_condition = ['or', ['regid_1' => (int)Yii::$app->request->get('region')], ['regid_2' => (int)Yii::$app->request->get('region')], ['regid_3' => (int)Yii::$app->request->get('region')]];
        else $region_condition = ['regid_' . $level . ' = ' . (int)Yii::$app->request->get('region')];

        $date_b = strtotime(Yii::$app->request->get('date_b'));
        $date_e = strtotime(Yii::$app->request->get('date_e'));
        if ($date_b > 1 && $date_e > 1) $date_condition = 'updated_at BETWEEN "' . date('d.m.y', $date_b) . '" AND "' . date('d.m.y', $date_e) . '"';
        else if ($date_b > 1) $date_condition = 'updated_at >= ' . date('d.m.y', $date_b);
        else if ($date_e > 1) $date_condition = 'updated_at <= ' . date('d.m.y', $date_e);
        else $date_condition = 'updated_at >= 1';

        $offset = (int)Yii::$app->request->get('offset');
        $limit = (int)Yii::$app->request->get('limit');
        if ($limit < 1 || $limit > $this->max_limit) $limit = $this->max_limit;

        if ($offset < 1) {
            $attributes = ['Comment', 'Full Name', 'Name L', 'Name F', 'Name M', 'Gender', 'B Date', 'Phone', 'Email', 'Class Id', 'Name', 'Type Id', 'Zip', 'Reg 1', 'Reg 2', 'Reg 3', 'Updated At', 'Question', 'Answer'];
            fputcsv($fp, $attributes, ';');
        }

        $query = new Query;
        $query->from($this->tableName())
            ->select('comment, full_name_region, name_l, name_f, name_m, gender, b_date, phone, email, class_id, name, type_id, zip, reg_1, reg_2, reg_3, updated_at, result_id, block_id, question_id, answer_id')
            ->where($date_condition)
            ->andFilterWhere($region_condition)
            ->offset($offset)
            ->limit($limit);

        $i = 0;
        if ($detail = $query->each()) {
            foreach ($detail as $user_info) {
                $i++;
                if ($i >= $limit) {
                    $dataProvider['error_limit'] = true;
                    if ((int)Yii::$app->request->get('limit') > $this->max_limit) $dataProvider['limit'] = $this->max_limit;
                    return $dataProvider;
                } else $dataProvider['report'] = $csv;
                $answer = '';

                if (empty($qa['questions'][$user_info['block_id']][$user_info['question_id']])) continue;

                if ($user_info['block_id'] == 40) $answer = ($user_info['answer_id'] == 1) ? 'Да' : 'Нет';
                elseif ($user_info['block_id'] == 50) {
                    if (empty($qa['answers'][$user_info['question_id']][$user_info['answer_id']])) continue;
                    $answer = $qa['answers'][$user_info['question_id']][$user_info['answer_id']];
                } else {
                    $incorrect = '';
                    if ($variant_answer = BusinessVariantsAnswer::findOne(['id' => $user_info['answer_id']])) {
                        if ($variant_answer->is_correct != 1) $incorrect = ' (неверно)';
                        $answer = $variant_answer->name . $incorrect;
                    }
                }

                $user_info['question'] = $qa['questions'][$user_info['block_id']][$user_info['question_id']];
                $user_info['question'] = str_replace(array("\r\n", "\r", "\n", "\t", '"', '  ', '    ', '    '), '', $user_info['question']);
                $user_info['question'] = strip_tags(addslashes($user_info['question']));

                $user_info['answer'] = strip_tags($answer);

                unset($user_info['result_id'], $user_info['block_id'], $user_info['question_id'], $user_info['answer_id']);
                fputcsv($fp, $user_info, ';');
            }
        }
        fclose($fp);
        return $dataProvider;
    }

    public function getQuestionsAndAnswers()
    {
        $questions_arr = [];
        $answers__pictured = [];

        $questions_scale = BusinessScaleQuestion::find()->all();
        foreach ($questions_scale as $item) {
            $questions_arr[40][$item->id] = $item->name;
        }

        $questions_pictured = BusinessPictured::find()->all();
        foreach ($questions_pictured as $item) {
            $questions_arr[50][$item->id] = $item->question_text;
            $answers__pictured[$item->id] = [1 => $item->variant1_text, 2 => $item->variant2_text, 3 => $item->variant3_text];
        }

        $questions_variants = BusinessVariantsQuestion::find()->all();
        foreach ($questions_variants as $item) {
            $questions_arr[$item->block_id][$item->id] = $item->name;
        }

        return ['questions' => $questions_arr, 'answers' => $answers__pictured];
    }

}