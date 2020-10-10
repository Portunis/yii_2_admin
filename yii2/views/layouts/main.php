<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\widgets\Pjax;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-lg navbar-light bg-light',
        ],
    ]);
    echo Nav::widget([

        'items' => [
            ['label' => 'Главная', 'url' => ['/site/index']],
            ['label' => 'Панель администратора', 'url' => ['/admin/index'], 'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin()],


            ['label' => 'Обратная связь', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Авторизация','options' => ['id' => 'btn-login']  ]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Выйти (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],'options' => ['class' => 'navbar-nav navbar-right', 'id' => 'knopka'],
    ]);
    NavBar::end();
    ?>

    <div class="container">

        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; AdminPanel <?= date('d:M:Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>
<?php
yii\bootstrap\Modal::begin([
    'id' => 'modal',
    'size' => 'modal-md',
]);

?>
<div id='modal-content'>Загружаю...</div>
<?php yii\bootstrap\Modal::end(); ?>

<?php Pjax::begin([
    'enablePushState' => false,
]); ?>
<?php $this->registerJs("
$('#btn-login').on('click',function(){
   var data = $(this).data();
   $('#modal').modal('show');
   $('#modal').find('.modal-title').text('Авторизация');
   $('#modal').find('#modal-content').load('/site/login');
   
   
});

");

?>
<?php Pjax::end(); ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
