<?php

namespace app\modules\admin\models;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

use Yii;
use yii\db\Expression;

class Requests extends \yii\db\ActiveRecord
{
    public $img_upload;
    public $img_update;
    public function __construct($config = [])
    {
        parent::__construct($config);
        $this->category_id = '1';
    }

    public static function tableName()
    {
        return 'requests';
    }
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['is_solved'], 'boolean'],
            [['created_at'], 'safe'],
            [['img_upload'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, bmp', 'maxSize' => 10 * 1024 * 1024  ],
            [['img_update'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, bmp', 'maxSize' => 10 * 1024 * 1024 ],
            [['description', 'name', 'reason', 'img_after', 'img_before'], 'string', 'max' => 255],
            [['description', 'name', 'reason'], 'filter','filter'=>'\yii\helpers\HtmlPurifier::process'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'название',
            'img_upload' => 'загрузка картинки',
            'img_update' => 'обновление картинки',
            'img_before' => 'картинка "до"',
            'img_after' => 'картинка "после"',
            'description' => 'описание',
            'reason' => 'причина',
            'created_at' => 'дата создания',
            'is_solved' => 'проблема решена?',
            'category_id' => 'ID категории',
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            if ($this->img_upload){
                $path1 = 'images/' . $this->img_upload->baseName . '.' . $this->img_upload->extension;
                $this->img_upload->saveAs($path1);
                $this->img_before = $path1;
            }
            if ($this->img_update){
                $path2 = 'images/' . $this->img_update->baseName . '.' . $this->img_update->extension;
                $this->img_update->saveAs($path2);
                $this->img_after = $path2;
            }
            return true;
        } else {
            return false;
        }
    }

    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }
}
