<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';

?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <?php Pjax::begin(); ?>

    <?php
    foreach ($user as $model)
    {?>
        - Логин - <?= $model->username; ?> - <?= Html::a('Просмотр', ['/user/view', 'id' => $model->id], ['class' => '']) ?> <br>

       <?php  } ?>

    <?php Pjax::end(); ?>

</div>
