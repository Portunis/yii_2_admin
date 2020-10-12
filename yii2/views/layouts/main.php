<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use macgyer\yii2materializecss\widgets\Modal;
use macgyer\yii2materializecss\widgets\navigation\Nav;
use macgyer\yii2materializecss\widgets\navigation\NavBar;
use yii\helpers\Html;
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
            'class' => 'navbar-fixed nav-wrapper',

        ],
    ]);
    echo Nav::widget([

        'items' => [
            ['label' => 'Главная', 'url' => ['/site/index']],
            ['label' => 'Панель администратора', 'url' => ['/admin/index'], 'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin()],


            ['label' => 'Обратная связь', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Авторизация','options' => ['id' => 'login', 'class' => 'modal-trigger', 'data-target' => 'w4']  ]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Выйти (' . Yii::$app->user->identity->username . ')'

                )
                . Html::endForm()
                . '</li>'
            )
        ],'options' => ['class' => 'right hide-on-med-and-down'],
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
<?php Pjax::begin([
    'enablePushState' => false,
]); ?>
<?php Modal::begin([

    'closeButtonPosition' => Modal::CLOSE_BUTTON_POSITION_BEFORE_FOOTER,
    'closeButton' => [
        'tag' => 'div',
        'label' => 'Закрыть',
        'class' => 'light-grey btn btn-flat blue lighten-4'
    ]
]) ?>

<?php Modal::end() ?>


<?php $this->registerJs("

$('#login').on('click',function(){
   var data = $(this).data();
   $('.modal').modal();
   $('.modal').find('.modal-content').load('/site/login');
   console.log(123);
   
});

");

?>
<?php Pjax::end(); ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
