<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Jf;

/**
 * JfSearch represents the model behind the search form about `backend\models\Jf`.
 */
class JfSearch extends Jf
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'mid'], 'integer'],
            [['jf'], 'number'],
            [['way', 'datetime'], 'safe'],
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
        $query = Jf::find();

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
            'mid' => $this->mid,
            'jf' => $this->jf,
        ]);

        $query->andFilterWhere(['like', 'way', $this->way]);

        return $dataProvider;
    }
}
