<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Zyzgjd;

/**
 * ZyzgjdSearch represents the model behind the search form about `backend\models\Zyzgjd`.
 */
class ZyzgjdSearch extends Zyzgjd
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'plan_id', 'sex', 'edu_level', 'card_type', 'hukou_type', 'zhiye_type', 'zhicheng_type', 'sbjb', 'examtype', 'khkm', 'is_delete'], 'integer'],
            [['name', 'birthday', 'sfz', 'nation', 'company', 'address', 'zipcode', 'tel', 'phone', 'email', 'sbzy'], 'safe'],
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
        $query = Zyzgjd::find();

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
            'sex' => $this->sex,
            'edu_level' => $this->edu_level,
            'card_type' => $this->card_type,
            'hukou_type' => $this->hukou_type,
            'zhiye_type' => $this->zhiye_type,
            'zhicheng_type' => $this->zhicheng_type,
            'sbjb' => $this->sbjb,
            'examtype' => $this->examtype,
            'khkm' => $this->khkm,
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'birthday', $this->birthday])
            ->andFilterWhere(['like', 'sfz', $this->sfz])
            ->andFilterWhere(['like', 'nation', $this->nation])
            ->andFilterWhere(['like', 'company', $this->company])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'zipcode', $this->zipcode])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'sbzy', $this->sbzy]);

        return $dataProvider;
    }
}
