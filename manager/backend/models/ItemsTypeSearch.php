<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ItemsType;

/**
 * ItemsTypeSearch represents the model behind the search form about `backend\models\ItemsType`.
 */
class ItemsTypeSearch extends ItemsType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['typeId', 'number', 'isDel', 'createTime'], 'integer'],
            [['typeName', 'desc'], 'safe'],
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
        $query = ItemsType::find();
        $query->where('is_delete=0');
        $query->orderBy('is_exists desc,createTime desc');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        if(!empty($params)){
            foreach ($params['ItemsTypeSearch'] as $key => $value) {
                $params['ItemsTypeSearch'][$key]=trim($value);
            }
        }
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'typeId' => $this->typeId,
            'number' => $this->number,
            'isDel' => $this->isDel,
            'createTime' => $this->createTime,
        ]);

        $query->andFilterWhere(['like', 'typeName', $this->typeName])
            ->andFilterWhere(['like', 'desc', $this->desc]);

        return $dataProvider;
    }
}
