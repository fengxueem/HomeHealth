<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\models\Developer;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
AppAsset::addCSS($this, Yii::$app->request->baseUrl . "/css/camera/main.css");
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<meta charset="<?= Yii::$app->charset ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Home Health',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top'
        ]
    ]);
    if (Yii::$app->user->isGuest) {
        $menuItems[] = [
            'label' => 'Signup',
            'url' => [
                '/site/signup'
            ]
        ];
        $menuItems[] = [
            'label' => 'Login',
            'url' => [
                '/site/login'
            ]
        ];
    } else {
        $menuItems = [
            [
                'label' => 'Camera',
                'url' => [
                    '/camera/index'
                ]
            ],
            [
                'label' => 'Body Data',
                'url' => [
                    '/body-data/index'
                ]
            ]
        ];
        // $menuItems[] = '<li>'
        // . Html::beginForm(['/site/logout'], 'post')
        // . Html::submitButton(
        // 'Logout (' . Yii::$app->user->identity->username . ')',
        // ['class' => 'btn btn-link logout']
        // )
        // . Html::endForm()
        // . '</li>';
        $menuItems[] = '<li class="dropdown">
                            <a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' . Yii::$app->user->identity->username . '
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">' . Html::a("", "#", [
            'class' => 'dropdown-toggle',
            'data-toggle' => 'dropdown',
            'role' => 'button',
            'aria-haspopup' => 'true',
            'aria-expanded' => 'false'
        ]) . '<li>' . Html::a(Yii::t('yii', 'Setting'), Url::to([
            '/user/index'
        ])) . '</li>
                                <li class="divider" role="separator"></li>
                                <li>' . Html::a(Yii::t('yii', 'Logout'), Url::to([
            '/site/logout'
        ])) . '</li>
                            </ul>
                        </li>';
    }
    echo Nav::widget([
        'options' => [
            'class' => 'navbar-nav navbar-right'
        ],
        'items' => $menuItems
    ]);
    NavBar::end();
    ?>

    <div class="container-fluid">
        <?= Alert::widget() ?>
        <div class="body-content">
			<div class="row">
				<div class="col-sm-3 col-md-2">
					<nav class="d-sm-block sidebar">
						<ul class="nav nav-pills flex-column">
							<li class="nav-item">
								<?= Html::a(Yii::t('yii', 'My Camera'), ['mycamera'], ['class' => 'nav-link']) ?>
							</li>
							<li class="nav-item">
								<?= Html::a(Yii::t('yii', 'Sharing Camera'), ['otherscamera'], ['class' => 'nav-link']) ?>
							</li>
						</ul>
					</nav>
				</div>
				<div class="col-sm-9 col-md-10">
					<?= $content ?>
				</div>
			</div>
		</div>
	</div>
</div>
<footer class="footer">
	<div class="container">
		<p class="pull-left">&copy; Home Health <?= date('Y') ?></p>

		<p class="pull-right"><?= Developer::links() ?></p>
	</div>
</footer>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
