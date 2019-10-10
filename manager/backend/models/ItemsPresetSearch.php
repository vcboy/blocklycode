<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ItemsPreset;

/**
 * ItemsPresetSearch represents the model behind the search form about `backend\models\ItemsPreset`.
 */
class ItemsPresetSearch extends ItemsPreset
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['presetId', 'sdMp4', 'hdMp4', 'shdMp4', 'sdFlv', 'hdFlv', 'shdFlv', 'sdHls', 'hdHls', 'shdHls', 'isDel', 'is_delete', 'is_exists'], 'integer'],
            [['presetName'], 'safe'],
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
        $query = ItemsPreset::find();
        $query->where('is_delete=0')->orderBy('is_exists desc,presetId desc');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        if(!empty($params)){
            foreach ($params['ItemsPresetSearch'] as $key => $value) {
                $params['ItemsPresetSearch'][$key]=trim($value);
            }
        }
        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'presetId' => $this->presetId,
            'sdMp4' => $this->sdMp4,
            'hdMp4' => $this->hdMp4,
            'shdMp4' => $this->shdMp4,
            'sdFlv' => $this->sdFlv,
            'hdFlv' => $this->hdFlv,
            'shdFlv' => $this->shdFlv,
            'sdHls' => $this->sdHls,
            'hdHls' => $this->hdHls,
            'shdHls' => $this->shdHls,
            'isDel' => $this->isDel,
            'is_delete' => $this->is_delete,
            'is_exists' => $this->is_exists,
        ]);

        $query->andFilterWhere(['like', 'presetName', $this->presetName]);

        return $dataProvider;
    }
}
