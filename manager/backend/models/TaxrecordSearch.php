<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Taxrecord;

/**
 * TaxrecordSearch represents the model behind the search form about `backend\models\Taxrecord`.
 */
class TaxrecordSearch extends Taxrecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'mid','isdone'], 'integer'],
            [['taitou', 'taxno', 'tax_time'], 'safe'],
            [['taxnum'], 'number'],
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
        $query = Taxrecord::find();

        $query->orderBy('isdone asc, id desc');

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
            //'taxnum' => $this->taxnum,
            'mid' => $this->mid,
            'isdone' => $this->isdone,
        ]);

        $query->andFilterWhere(['like', 'taitou', $this->taitou])
            ->andFilterWhere(['like', 'taxno', $this->taxno])
            ->andFilterWhere(['like', 'taxnum', $this->taxnum]);

        if(isset($params['tax_time'])){
            $startTime = strtotime($params['tax_time']);
            $strTime = $params['tax_time']." + 1 day";
            $endTime = strtotime($strTime);
            $query -> andWhere(['between','tax_time',$startTime,$endTime]);
        }
        return $dataProvider;
    }
}
