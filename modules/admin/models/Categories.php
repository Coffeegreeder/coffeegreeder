<?php

namespace app\modules\admin\models;

use Yii;

class Categories extends \yii\db\ActiveRecord
{

  public static function tableName(){
      return 'categories';
  }

  public function rules()
    {
        return [
            [['category_name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID статуса',
            'category_name' => 'Название статуса',
        ];
    }

    public function getRequests()
    {
        return $this->hasMany(Request::className(), ['category_id' => 'id']);
    }
  }
