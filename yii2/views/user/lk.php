<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::$app->user->identity->full_name;

?>
<div class="user-index">
Личный кабинет


    <?php Pjax::begin(); ?>
    <?= Yii::$app->user->identity->username ?><br>
    <?= Yii::$app->user->identity->id_number ?><br>
    <?= Yii::$app->user->identity->full_name ?><br>

    <?php Pjax::end(); ?>

</div>
