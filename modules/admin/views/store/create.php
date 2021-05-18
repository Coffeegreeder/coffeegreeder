<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

$this->title = 'Добавить запись';
$this->params['breadcrumbs'][] = ['label' => 'Записи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-create">

  <h1><?= Html::encode($this->title) ?></h1>

  <div class="site-index">
    <div class="body-content">
      <div class="upload-form">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'img_upload')->fileInput()?>
        <?= $form->field($model, 'img_update')->fileInput()?>
        <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'status_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\modules\admin\models\status::find()->all(), 'id', 'status_name' )) ?>
        <div class="upload-form__btn">
          <?= Html::submitButton('Загрузить', ['class'=>'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
      </div>
    </div>
  </div>
</div>
