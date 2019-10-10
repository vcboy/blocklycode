<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Items;

/**
 * ItemsSearch represents the model behind the search form about `backend\models\Items`.
 */
class ItemsSearch extends Items
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vid', 'status', 'completeTime', 'duration', 'typeId', 'initialSize', 'sdMp4Size', 'hdMp4Size', 'shdMp4Size', 'sdFlvSize', 'hdFlvSize', 'shdFlvSize', 'createTime', 'updateTime', 'is_delete', 'is_exists'], 'integer'],
            [['videoName', 'description', 'typeName', 'snapshotUrl', 'origUrl', 'downloadOrigUrl', 'sdMp4Url', 'downloadSdMp4Url', 'hdMp4Url', 'downloadHdMp4Url', 'shdMp4Url', 'downloadShdMp4Url', 'sdFlvUrl', 'downloadSdFlvUrl', 'hdFlvUrl', 'downloadHdFlvUrl', 'shdFlvUrl', 'downloadShdFlvUrl'], 'safe'],
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
        $query = Items::find();
        $query->where('is_delete=0');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if(!empty($params)){
            foreach ($params['ItemsSearch'] as $key => $value) {
                $params['ItemsSearch'][$key]=trim($value);
            }
        }
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'vid' => $this->vid,
            'status' => $this->status,
            'completeTime' => $this->completeTime,
            'duration' => $this->duration,
            'typeId' => $this->typeId,
            'initialSize' => $this->initialSize,
            'sdMp4Size' => $this->sdMp4Size,
            'hdMp4Size' => $this->hdMp4Size,
            'shdMp4Size' => $this->shdMp4Size,
            'sdFlvSize' => $this->sdFlvSize,
            'hdFlvSize' => $this->hdFlvSize,
            'shdFlvSize' => $this->shdFlvSize,
            'createTime' => $this->createTime,
            'updateTime' => $this->updateTime,
            'is_delete' => $this->is_delete,
            'is_exists' => $this->is_exists,
        ]);

        $query->andFilterWhere(['like', 'videoName', $this->videoName])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'typeName', $this->typeName])
            ->andFilterWhere(['like', 'snapshotUrl', $this->snapshotUrl])
            ->andFilterWhere(['like', 'origUrl', $this->origUrl])
            ->andFilterWhere(['like', 'downloadOrigUrl', $this->downloadOrigUrl])
            ->andFilterWhere(['like', 'sdMp4Url', $this->sdMp4Url])
            ->andFilterWhere(['like', 'downloadSdMp4Url', $this->downloadSdMp4Url])
            ->andFilterWhere(['like', 'hdMp4Url', $this->hdMp4Url])
            ->andFilterWhere(['like', 'downloadHdMp4Url', $this->downloadHdMp4Url])
            ->andFilterWhere(['like', 'shdMp4Url', $this->shdMp4Url])
            ->andFilterWhere(['like', 'downloadShdMp4Url', $this->downloadShdMp4Url])
            ->andFilterWhere(['like', 'sdFlvUrl', $this->sdFlvUrl])
            ->andFilterWhere(['like', 'downloadSdFlvUrl', $this->downloadSdFlvUrl])
            ->andFilterWhere(['like', 'hdFlvUrl', $this->hdFlvUrl])
            ->andFilterWhere(['like', 'downloadHdFlvUrl', $this->downloadHdFlvUrl])
            ->andFilterWhere(['like', 'shdFlvUrl', $this->shdFlvUrl])
            ->andFilterWhere(['like', 'downloadShdFlvUrl', $this->downloadShdFlvUrl]);

        return $dataProvider;
    }
    public function getItemsType()
    {
        return $this->hasOne(ItemsType::className(), ['typeId' => 'typeId']);
    }
}
