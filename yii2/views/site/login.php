<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;

$this->title = '';

?>
<div class="site-login">




    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>



        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Авторизация', ['class' => 'btn btn-primary', 'name' => 'login-button', ]) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

    <div class="col-lg-offset-1" style="color:#999;">
         У Вас нет аккаунта ? <button id="btn-reg" class="btn btn-primary"> Регистрация</button>.<br>

    </div>
</div>
<?php Pjax::begin([
    'enablePushState' => false,
]); ?>
<div class="modal fade" id="modal-lg" style="padding-right: 17px; display: none;" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Large Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>One fine body…</p>
            </div>


        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php Pjax::end(); ?>
<?php Pjax::begin([
    'enablePushState' => false,
]); ?>
<?php $this->registerJs("
$('#btn-reg').on('click',function(){
   var data = $(this).data();
   $('#modal-lg').find('.modal-title').text('Регистрация');
   $('#modal-lg').find('.modal-body').load('/user/create');
   
});
");

?>
<?php Pjax::end(); ?>
