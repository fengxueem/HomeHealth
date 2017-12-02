<?php
use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
$this->title = 'Welcome to Home Health';
AppAsset::register($this);
AppAsset::addCSS($this, Yii::$app->request->baseUrl . "/css/site/index.css");
?>
<div class="site-index">
	<div class="body-content">
		<div class="row">
			<div class="col-xs-12 col-md-5">
				<div class="camera">  <!-- flexible container-->
					<?= Html::a(Yii::t('yii', 'Camera'), Url::to(['/camera/index']), ['class' => 'btn btn-camera'])?>
				</div>
			</div>
			<div class="col-xs-12 col-md-2">
				<div class="split"></div>
			</div>
			<div class="col-xs-12 col-md-5">
				<div class="body-data"> <!-- flexible container-->
					<?= Html::a(Yii::t('yii', 'Body Data'), Url::to(['/body-data/index']), ['class' => 'btn btn-body-data'])?>
				</div>
			</div>
		</div>
	</div>
</div>