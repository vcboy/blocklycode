<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ItemsWatermark;

/**
 * ItemsWatermarkSearch represents the model behind the search form about `backend\models\ItemsWatermark`.
 */
class ItemsWatermarkSearch extends ItemsWatermark
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['watermarkId'], 'integer'],
            [['watermarkName', 'description', 'coordinate', 'scale'], 'safe'],
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
        $query = ItemsWatermark::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'watermarkId' => $this->watermarkId,
        ]);

        $query->andFilterWhere(['like', 'watermarkName', $this->watermarkName])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'coordinate', $this->coordinate])
            ->andFilterWhere(['like', 'scale', $this->scale]);

        return $dataProvider;
    }
}
