<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Requests;

class RequestsFinder extends Requests {

  public function rules()
    {
        return [
            [['id'], 'integer'],
            [['is_solved'], 'boolean'],
            [['description', 'name', 'is_solved', 'img_after', 'img_before', 'created_at'], 'safe'],
        ];
    }

    public function scenarios()
  {
      return Model::scenarios();
  }

  public function search($params)
    {
        $query = Requests::find();

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
            'is_solved' => $this->is_solved,
            'description' => $this->description,
        ]);

        $query->andFilterWhere(['like', 'is_solved', $this->is_solved])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'img_before', $this->img_before])
            ->andFilterWhere(['like', 'img_after', $this->img_after])
            ->andFilterWhere(['like', 'descriptiont', $this->description]);

        return $dataProvider;
    }

}
