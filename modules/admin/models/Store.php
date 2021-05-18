<?php

namespace app\modules\admin\models;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

use Yii;
use yii\db\Expression;

class Store extends \yii\db\ActiveRecord
{
    public $img_upload;
    public $img_update;
    public function __construct($config = [])
    {
        parent::__construct($config);
        $this->status_id = '1';
    }

    public static function tableName()
    {
        return 'store';
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
            [['name', 'img_upload'], 'required'],
            [['price'], 'integer'],
            [['created_at'], 'safe'],
            [['img_upload'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, bmp', 'maxSize' => 10 * 1024 * 1024  ],
            [['img_update'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, bmp', 'maxSize' => 10 * 1024 * 1024 ],
            [['description', 'name', 'img_after', 'img_before'], 'string', 'max' => 255],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
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
            'created_at' => 'дата создания',
            'price' => 'цена',
            'status_id' => 'ID статуса',
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

    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }
}
