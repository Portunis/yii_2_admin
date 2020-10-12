<?php

/* @var $this yii\web\View */

/* @var $model app\models\LoginForm */

use macgyer\yii2materializecss\widgets\form\ActiveForm;
use macgyer\yii2materializecss\widgets\Modal;
use yii\helpers\Html;

use yii\widgets\Pjax;

$this->title = '';

?>

<?php $form = ActiveForm::begin(

); ?>

            <?= $form->field($model, 'username', ['enableAjaxValidation' => true])->textInput(['autofocus' => true, 'onkeyup' => 'checkParams()']) ?>



            <?= $form->field($model, 'password', ['enableAjaxValidation' => true])->passwordInput([ 'onkeyup' => 'checkParams()']) ?>


        <?= Html::submitButton('Авторизация', ['class' => 'btn ', 'name' => 'login-button', 'disabled' => true,'id' => 'btn-auth']) ?> <br>
        <small>
            У Вас нет аккаунта ? <a id="btn-reg" href="#"> Регистрация</a>.<br>

        </small>

<?php ActiveForm::end(); ?>
<?php Pjax::begin([
    'enablePushState' => false,
]); ?>
<?php
Modal::begin([
        'toggleButton' => false,
]); ?>
<?php Modal::end(); ?>


<?php $this->registerJs("
$('#btn-reg').on('click',function(){
  var data = $(this).data();
  $('.modal').find('.modal-content').load('/user/create');
  console.log(123);
   
  
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
