<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Записи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="request-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены в своём действии?',
                'method' => 'post',
            ],
        ])?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'price',
            'name',
            [
                'attribute'=> 'img_before',
                'value' => function($model){
                    return echo '/'.Html::img($model->img_before, ['width' => 150]);
                },
                'format' => 'html'
            ],
            [
                'attribute'=> 'img_after',
                'value' => function($model){
                    return echo '/'.Html::img($model->img_after, ['width' => 150]);
                },
                'format' => 'html'
            ],
            'created_at',
            'description',
            'price',
            'status_id',
        ],
    ]) ?>
</div>
