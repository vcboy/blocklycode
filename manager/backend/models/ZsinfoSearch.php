<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Zsinfo;

/**
 * ZsinfoSearch represents the model behind the search form about `backend\models\Zsinfo`.
 */
class ZsinfoSearch extends Zsinfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'plan_id', 'source', 'sid', 'zs_id'], 'integer'],
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
        $query = Zsinfo::find();

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
            'id' => $this->id,
            'plan_id' => $this->plan_id,
            'source' => $this->source,
            'sid' => $this->sid,
            'zs_id' => $this->zs_id,
            'is_delete' => 0,
        ]);

        return $dataProvider;
    }
}
