<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Order;

/**
 * OrderSearch represents the model behind the search form about `backend\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'state', 'mid', 'is_delete'], 'integer'],
            [['order_no', 'order_time'], 'safe'],
            [['price'], 'number'],
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
        $query = Order::find();
        //$query->where('is_delete = 0'.$where);
        $query->orderBy('id desc');
        //var_dump($params);
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
            'price' => $this->price,
            'state' => $this->state,
            'mid' => $this->mid,
            'is_delete' => 0,
        ]);

        $query->andFilterWhere(['like', 'order_no', $this->order_no]);
            //->andFilterWhere(['like', 'order_time', strtotime($this->order_time)]);
        if(isset($params['order_time'])){
            $startTime = strtotime($params['order_time']);
            $strTime = $params['order_time']." + 1 day";
            $endTime = strtotime($strTime);
            $query -> andWhere(['between','order_time',$startTime,$endTime]);
        }
        return $dataProvider;
    }
}
