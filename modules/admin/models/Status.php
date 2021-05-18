<?php

namespace app\modules\admin\models;

use Yii;

class Status extends \yii\db\ActiveRecord
{

  public static function tableName(){
      return 'status';
  }

  public function rules()
    {
        return [
            [['status_name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID статуса',
            'status_name' => 'Название статуса',
        ];
    }

    public function getRequests()
    {
        return $this->hasMany(Request::className(), ['status_id' => 'id']);
    }
  }
