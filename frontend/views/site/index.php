<?php
use frontend\assets\AppAsset;

/* @var $this yii\web\View */
$this->title = 'My Yii Application';
AppAsset::register($this);
AppAsset::addCSS($this, Yii::$app->request->baseUrl . "/css/index.css");
?>
<div class="site-index">
	<div class="body-content">
		<div class="row">
			<div class="col-xs-12 col-md-5">
				<div class="camera">  <!-- flexible container-->
					<a class="btn btn-camera"
						href="/homehealth/frontend/web/index.php?r=site%2Fcamera"> Camera</a>
				</div>
			</div>
			<div class="col-xs-12 col-md-2">
				<div class="split"></div>
			</div>
			<div class="col-xs-12 col-md-5">
				<div class="body-data"> <!-- flexible container-->
					<a class="btn btn-body-data"
						href="/homehealth/frontend/web/index.php?r=site%2Fbodydata">Body
						Data</a>
				</div>
			</div>
		</div>
	</div>
</div>