<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Store */

$this->title = 'Update Request: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="request-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="site-index">
        <div class="body-content">
            <div class="upload-form">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
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
