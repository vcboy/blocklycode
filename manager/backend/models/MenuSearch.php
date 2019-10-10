<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use backend\models\Menu;

/**
 * MenuSearch represents the model behind the search form about `backend\models\Menu`.
 */
class MenuSearch extends Menu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent', 'taxis'], 'integer'],
            [['name', 'route', 'data'], 'safe'],
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
        //$query = Menu::find();
        $this->load($params);
        $menu = new Menu();
        $pid = 0;
        if($this->parent){
            $pid = $this->parent;
        }
        $list = $menu->getMenuList($pid,'',$this->name);
        $dataProvider = new ArrayDataProvider([
            'allModels' => $list,
        ]);



        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        return $dataProvider;
    }
}
