<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Jianding;

/**
 * JiandingSearch represents the model behind the search form about `backend\models\Jianding`.
 */
class JiandingSearch extends Jianding
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sex', 'plan_id'], 'integer'],
            [['company', 'name', 'nation', 'birthday', 'sfz', 'bkzs', 'bkfx', 'zsdj', 'tel', 'education', 'job'], 'safe'],
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
    public function search($params,$where)
    {
        $query = Jianding::find();
        $query->where('is_delete = 0'.$where);
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
            'sex' => $this->sex,
        ]);

        $query->andFilterWhere(['=', 'plan_id', $this->plan_id])
            ->andFilterWhere(['like', 'company', $this->company])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'nation', $this->nation])
            ->andFilterWhere(['like', 'birthday', $this->birthday])
            ->andFilterWhere(['like', 'sfz', $this->sfz])
            ->andFilterWhere(['like', 'bkzs', $this->bkzs])
            ->andFilterWhere(['like', 'bkfx', $this->bkfx])
            ->andFilterWhere(['like', 'zsdj', $this->zsdj])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'education', $this->education])
            ->andFilterWhere(['like', 'job', $this->job]);

        return $dataProvider;
    }
}
