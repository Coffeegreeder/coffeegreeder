<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

$this->title = 'Записи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">
  <h1><?= Html::encode($this->title) ?></h1>
  <p>
    <?= Html::a('Добавить запись', ['create'], ['class' => 'btn btn-success']) ?>
  </p>
  <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $RequestsFinder,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'attribute'=> 'img_before',
                'value' => function($model){
                    return Html::img($model->img_before, ['width' => 150]);
                },
                'format' => 'html'
            ],
            [
                'attribute'=> 'img_after',
                'value' => function($model){
                    return Html::img($model->img_after, ['width' => 150]);
                },
                'format' => 'html'
            ],
            'description',
            'reason',
            'category_id',
            'created_at',
            'is_solved',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
