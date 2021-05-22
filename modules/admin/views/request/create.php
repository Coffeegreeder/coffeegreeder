<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Request */

$this->title = 'Добавить запись';
$this->params['breadcrumbs'][] = ['label' => 'Записи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="mid">

    <div class="upload-form">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'img_upload')->fileInput(['required' => true])?>
        <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
        <div class="upload-form__btn">
          <?= Html::submitButton('Загрузить', ['class'=>'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
      </div>
</div>
