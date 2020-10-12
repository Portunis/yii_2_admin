<?php

use yii\helpers\Html;

use macgyer\yii2materializecss\widgets\form\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
    'id' => 'registration-form',
]); ?>

        <?= $form->field($model, 'username', ['enableAjaxValidation' => true])->textInput(['maxlength' => true, 'onkeyup' => 'checkParams()' ]) ?>

        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'onkeyup' => 'checkParams()' ]) ?>

    <?= $form->field($model, 'full_name', ['enableAjaxValidation' => true])->textInput(['maxlength' => true, 'onkeyup' => 'checkParams()' ]) ?>

    <?= $form->field($model, 'email', ['enableAjaxValidation' => true])->textInput(['maxlength' => true, 'onkeyup' => 'checkParams()' ]) ?>


<?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary','disabled' => true,'id' => 'btn-reg2' ]) ?>

<?php ActiveForm::end(); ?>

<?php $this->registerJs("
function checkParams() {
    var fio = $('#user-username').val();
    var email = $('#user-email').val();
    var password = $('#user-password').val();
    var full = $('#user-full_name').val();

    if(fio.length != 0 && email.length != 0 && password.length != 0 && full.length != 0) {
        $('#btn-reg2').removeAttr('disabled');
    } else {
        $('#btn-reg2').attr('disabled', 'disabled');
    }
}"
)

?>
