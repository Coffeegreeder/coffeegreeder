<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Store;

class StoreRequest extends Store {

  public function rules()
    {
        return [
            [['id', 'price',], 'integer'],
            [['description', 'name', 'price', 'img_after', 'img_before', 'created_at'], 'safe'],
        ];
    }

    public function scenarios()
  {
      return Model::scenarios();
  }

  public function search($params)
    {
        $query = Store::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->created_at,
            'price' => $this->price,
            'description' => $this->description,
        ]);

        $query->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'img_before', $this->img_before])
              ->andFilterWhere(['like', 'img_after', $this->img_after])
            ->andFilterWhere(['like', 'descriptiont', $this->description]);

        return $dataProvider;
    }

}
