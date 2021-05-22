<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Request */

$this->title = 'Update Request: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="mid">

    <div class="upload-form">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'img_upload')->fileInput()?>
        <?= $form->field($model, 'img_update')->fileInput()?>
        <?= $form->field($model, 'is_solved')->checkbox([], false)?>
        <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'reason')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\modules\admin\models\categories::find()->all(), 'id', 'category_name' )) ?>
        <div class="upload-form__btn">
          <?= Html::submitButton('Загрузить', ['class'=>'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
      </div>
    </div>
