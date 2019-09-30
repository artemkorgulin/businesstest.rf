<?php
namespace common\modules\business\common\components\result;
use common\modules\business\common\models\BusinessAggregate;
use common\modules\business\common\models\BusinessPictured;
use common\modules\business\common\models\BusinessRemove;
use common\modules\business\common\models\BusinessResult;
use common\modules\business\common\models\BusinessScale;
use common\modules\business\common\models\BusinessScaleQuestion;
use common\modules\business\common\models\BusinessScaleResult;
use common\modules\business\common\models\BusinessVariantsAnswer;
use yii\base\Component;
use yii\web\NotFoundHttpException;

class BusinessResultComposer extends Component
{
    public $result_id;

    public $result_scales = [];
    public $result_chars  = [];

    public $intellect_correct = 0;
    public $history_correct = 0;

    public $result_scale_text = [];
    public $picdif = 0;

    public $picturedByQuestion = [];

    /**
     * Сборка результата тестирования
     */
    public function init()
    {
        if ($main = BusinessResult::findOne(['id' => $this->result_id])) {

            $questions = BusinessAggregate::findAll(['result_id' => $this->result_id]);
            if (is_array($questions)) foreach ($questions as $aggregate) {
                $question = $aggregate->getQuestion();

                if (1 == $question->id) {
                    switch ($aggregate->answer_id) {
                        case 3: $this->picdif = 2; break;
                        case 2: $this->picdif = 1; break;
                    }
                }

                if ($question instanceof BusinessScaleQuestion) {
                    // Вопросы да/нет по шкалам
                    if (!isset($this->result_scales[$question->scale_id])) $this->result_scales[$question->scale_id] = 0;
                    if (1 == $aggregate->answer_id) {
                        $this->result_scales[$question->scale_id] += $question->pts_yes;
                    } else {
                        $this->result_scales[$question->scale_id] += $question->pts_no;
                    }

                } elseif ($question instanceof BusinessPictured) {

                    $field = 'variant' . $aggregate->answer_id . '_result';
                    $fieldAns = 'variant' . $aggregate->answer_id . '_text';
                    if ($question->canGetProperty($field)) {

                        $this->picturedByQuestion[$question->id] = [
                            'question' => $question->question_text,
                            'variant'  => $question->$fieldAns,
                            'chars'    => [],
                        ];

                        $chars = explode("\n", $question->$field);
                        if (is_array($chars)) foreach ($chars as $char) {
                            $this->result_chars[trim($char)] = true;
                            $this->picturedByQuestion[$question->id]['chars'][trim($char)] = true;
                        }
                    }

                } elseif (1 == $question->block_id || 4 == $question->block_id){

                    if ($correct = BusinessVariantsAnswer::findOne(['question_id' => $question->id, 'is_correct' => 1])) {
                        if ($correct->id == $aggregate->answer_id) $this->history_correct ++;
                    }

                } elseif (2 == $question->block_id){

                    if (1 == $question->id) continue;

                    if ($correct = BusinessVariantsAnswer::findOne(['question_id' => $question->id, 'is_correct' => 1])) {
                        if ($correct->id == $aggregate->answer_id) $this->intellect_correct ++;
                    }

                } else {
                   // echo '<li>' . get_class($question);
                   // print_r($question->attributes);
                }

            }

            ksort($this->result_scales);
            ksort($this->result_chars);
            foreach ($this->result_scales as $key=>$scale) {
                $this->result_scale_text[$key] = [
                    'name'  => 'undefined',
                    'scale' => 'undefined',
                    'content1' => 'undefined',
                    'content2' => 'undefined',
                ];

                $r = BusinessScaleResult::find()->where(['scale_id' => $key])->andWhere(['<=', 'pts_lo', $scale])->andWhere(['>=', 'pts_hi', $scale])->one();
                if ($r) {
                    $s = BusinessScale::findOne(['id' => $key]);
                    $this->result_scale_text[$key] = [
                        'name'  => $s->name,
                        'scale' => $s->comment,
                        'content1' => $r->content1,
                        'content2' => $r->content2,
                    ];
                }
            }

            $replace = BusinessRemove::find()->all();
            if (is_array($replace)) foreach ($replace as $r) {
                if (isset($this->result_chars[trim($r->name)]) && $this->result_chars[trim($r->name)]) {
                    $cc = explode("\n", $r->removal);
                    foreach ($cc as $rep) {
                        $rep = trim($rep);
                        if (isset($this->result_chars[$rep])) $this->result_chars[$rep] = false;
                    }
                }
            }

            ksort($this->picturedByQuestion);

            foreach ($this->picturedByQuestion as $k=>$quest) {
                if (is_array($quest['chars'])) foreach ($quest['chars'] as $n=>$active) {
                    if (!isset($this->result_chars[$n]) || !$this->result_chars[$n]) {
                        unset($this->picturedByQuestion[$k]['chars'][$n]);
                    }
                }
            }

        } else {
            throw new NotFoundHttpException();
        }
    }
}