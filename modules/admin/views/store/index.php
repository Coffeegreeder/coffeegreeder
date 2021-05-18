<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $StoreRequest app\modules\admin\models\StoreRequest */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Записи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить запись', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $StoreRequest]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $StoreRequest,
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
            'status_id',
            'created_at',
            'price',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
