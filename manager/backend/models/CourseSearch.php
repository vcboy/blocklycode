<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Course;

/**
 * CourseSearch represents the model behind the search form about `backend\models\Course`.
 */
class CourseSearch extends Course
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'price', 'bm_num', 'status', 'live_start_time', 'live_end_time', 'is_delete'], 'integer'],
            [['name', 'img', 'teacher_name', 'description', 'desc', 'channel_id'], 'safe'],
            [['score'], 'number'],
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
        $query = Course::find();
        $query->where('is_delete=0');
        //$query->orderBy('create_time desc');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        //dump($params);
        //exit();
        /*if(!empty($params)){
            foreach ($params['CourseSearch'] as $key => $value) {
                $params['CourseSearch'][$key]=trim($value);
            }
        }*/
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'price' => $this->price,
            'bm_num' => $this->bm_num,
            'score' => $this->score,
            'status' => $this->status,
            'live_start_time' => $this->live_start_time,
            'live_end_time' => $this->live_end_time,
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'channel_id', $this->channel_id])
            ->andFilterWhere(['like', 'teacher_name', $this->teacher_name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'desc', $this->desc]);

        return $dataProvider;
    }
     public function getChannel(){
        return $this->hasOne(Platform::className(), ['id' => 'channel_id']);
    }
}
