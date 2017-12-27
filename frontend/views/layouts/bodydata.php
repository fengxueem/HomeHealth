<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\apidoc\templates\bootstrap\SideNavWidget;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use frontend\assets\AppAsset;
use common\models\Developer;
use common\widgets\Alert;
use yii\helpers\Url;
use yii\base\Widget;
use common\models\PhysiologicalDataType;

AppAsset::register($this);
AppAsset::addCSS($this, Yii::$app->request->baseUrl . "/css/layouts/bodydata.css");
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
                                <li>' . Html::a(Yii::t('yii', 'Logout'), Url::to(['/site/logout'])) . '</li>
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
					<?php
					   $types = PhysiologicalDataType::find()->select(['name'])->indexBy('id')->column();
					   $type_items = [];
					   foreach ($types as $i => $type_name) {
					       $type_items[] = [
					           'label' => $type_name,
					           'url' => Url::to(['/type/view', 'id' => $i]),
					       ];
					   }
					   echo SideNavWidget::widget([
					       'items' => [
    					       [
    					           'label' => 'Quick Record',
    					           'url' => Url::to(['/body-data/add']),
    					       ],
					           [
					               'label' => 'Occasions',
					               'url' => Url::to(['/occasion/index']),
					           ],
					           [
					               'label' => 'Types',
					               'items' => $type_items,
					           ],
					       ],
					       'options' => ['class' => 'nav-pills'],
					   ]);
					?>
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
