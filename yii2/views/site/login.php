<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;

$this->title = '';

?>

<?php $form = ActiveForm::begin(

); ?>
    <form>
        <div class="form-group">
            <?= $form->field($model, 'username', ['enableAjaxValidation' => true])->textInput(['autofocus' => true, 'onkeyup' => 'checkParams()']) ?>

        </div>
        <div class="form-group">
            <?= $form->field($model, 'password', ['enableAjaxValidation' => true])->passwordInput([ 'onkeyup' => 'checkParams()']) ?>
        </div>

        <?= Html::submitButton('Авторизация', ['class' => 'btn btn-primary', 'name' => 'login-button', 'disabled' => true,'id' => 'btn-auth']) ?> <br>
        <small>
            У Вас нет аккаунта ? <a id="btn-reg" href="#"> Регистрация</a>.<br>

        </small>
    </form>
<?php ActiveForm::end(); ?>
<?php
yii\bootstrap\Modal::begin([

    'id' => 'modal',
    'size' => 'modal-md',
]); ?>
<div id='modal-content'>Загружаю...</div>
<?php yii\bootstrap\Modal::end(); ?>

<?php Pjax::begin([
    'enablePushState' => false,
]); ?>
<?php $this->registerJs("
$('#btn-reg').on('click',function(){
   var data = $(this).data();
   $('#modal').find('.modal-title').text('Регистрация');
   $('#modal').find('#modal-content').load('/user/create');
   
  
});

");

?>
<?php Pjax::end(); ?>
<?php $this->registerJs("
function checkParams() {
    var password_login = $('#loginform-password').val();

    var username_login = $('#loginform-username').val();


    if(password_login.length != 0 && username_login.length != 0 ) {
        $('#btn-auth').removeAttr('disabled');
    } else {
        $('#btn-auth').attr('disabled', 'disabled');
    }
}"
)

?>
