<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Member;

/**
 * MemberSearch represents the model behind the search form about `backend\models\Member`.
 */
class MemberSearch extends Member
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'source', 'sid'], 'integer'],
            [['name', 'cid', 'tel', 'username', 'pass'], 'safe'],
            [['jf', 'getway'], 'number'],
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
        $query = Member::find();
        //$query->where('is_delete = 0');
        $query->orderBy('id desc');

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
            'jf' => $this->jf,
            'source' => $this->source,
            'sid' => $this->sid,
            'getway' => $this->getway,
            'is_delete' => 0,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'cid', $this->cid])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'getway', $this->getway])
            ->andFilterWhere(['like', 'pass', $this->pass]);

        return $dataProvider;
    }
}
