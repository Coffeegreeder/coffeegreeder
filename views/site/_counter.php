<?php
use yii\widgets\Pjax;

 Pjax::begin([
    'id' => 'counter',
    'enablePushState' => false,
    'formSelector' => false,
    'linkSelector' => false
]) ?>
<?= $counter ?>
<?php Pjax::end() ?>
