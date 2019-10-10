<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\channel;

/**
 * ChannelSearch represents the model behind the search form about `backend\models\channel`.
 */
class ChannelSearch extends channel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ctime', 'status'], 'integer'],
            [['cid', 'name', 'push_url', 'http_pull_url', 'hls_pull_url', 'rtmp_pull_url'], 'safe'],
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
        $query = Channel::find();
        $query->where('is_delete=0');
        $query->orderBy('is_exists desc,ctime desc');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        if(!empty($params)){
            foreach ($params['ChannelSearch'] as $key => $value) {
                $params['ChannelSearch'][$key]=trim($value);
            }
        }
        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere([
            'ctime' => $this->ctime,
            'status' => $this->status,
        ]);
        $query->andFilterWhere(['like', 'cid', $this->cid])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'push_url', $this->push_url])
            ->andFilterWhere(['like', 'http_pull_url', $this->http_pull_url])
            ->andFilterWhere(['like', 'hls_pull_url', $this->hls_pull_url])
            ->andFilterWhere(['like', 'rtmp_pull_url', $this->rtmp_pull_url]);

        return $dataProvider;
    }
}
