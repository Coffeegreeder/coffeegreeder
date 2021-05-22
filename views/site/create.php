<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

$this->title = 'Добавить запись';
?>
<div class="side-bar">
  <h1><?= Html::encode($this->title) ?></h1>
  <!-- <div class="side-bar__search-form">
    <input type="text" name="search" value="" placeholder="search">
  </div> -->
  <div class="side-bar__counter">
    <p>Опишите свою проблему и приложите к ней фото</p>
  </div>
</div>
<div class="main__content">


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
</div>
