<?php

namespace common\modules\business\backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\business\common\models\BusinessPictured;

/**
 * BusinessPicturedSearch represents the model behind the search form about `common\modules\business\common\models\BusinessPictured`.
 */
class BusinessPicturedSearch extends BusinessPictured
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['question_text', 'variant1_text', 'variant1_pict', 'variant2_text', 'variant2_pict', 'variant3_text', 'variant3_pict'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {

        $query = BusinessPictured::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'question_text', $this->question_text])
            ->andFilterWhere(['like', 'variant1_text', $this->variant1_text])
            ->andFilterWhere(['like', 'variant1_pict', $this->variant1_pict])
            ->andFilterWhere(['like', 'variant2_text', $this->variant2_text])
            ->andFilterWhere(['like', 'variant2_pict', $this->variant2_pict])
            ->andFilterWhere(['like', 'variant3_text', $this->variant3_text])
            ->andFilterWhere(['like', 'variant3_pict', $this->variant3_pict]);

        return $dataProvider;
    }
}
