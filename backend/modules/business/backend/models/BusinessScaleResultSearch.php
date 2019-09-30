<?php

namespace common\modules\business\backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\business\common\models\BusinessScaleResult;

/**
 * BusinessScaleResultSearch represents the model behind the search form about `common\modules\business\common\models\BusinessScaleResult`.
 */
class BusinessScaleResultSearch extends BusinessScaleResult
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'scale_id', 'pts_lo', 'pts_hi'], 'integer'],
            [['content1', 'content2'], 'safe'],
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
        $query = BusinessScaleResult::find();

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
            'scale_id' => $this->scale_id,
            'pts_lo' => $this->pts_lo,
            'pts_hi' => $this->pts_hi,
        ]);

        $query->andFilterWhere(['like', 'content1', $this->content1])
            ->andFilterWhere(['like', 'content2', $this->content2]);

        return $dataProvider;
    }
}
