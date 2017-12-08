<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use frontend\assets\AppAsset;


/* @var $this yii\web\View */
/* @var $model common\models\Camera */

$this->title = Yii::t('yii', 'Share Camera');
?>
<div class="camera-share">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="user-search">
    	<?php $form = ActiveForm::begin([
    	    'method' => 'post',
    	    'action' => ['camera/share', 'id'=>$id],
    	]); ?>
        
            <?= $form->field($findUser, 'targetname') ?>
        
            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
            </div>
        
        <?php ActiveForm::end(); ?>
    </div>
	<br>
	<div class="user-info">
		<?php
		if ($model) {
		    echo DetailView::widget([
		        'model' => $model,
		        'attributes' => [
		            'username',
		            'nickname',
		            'email:email',
		            'phone',
		        ],
		    ]).
		    Html::a(Yii::t('yii', 'Share'), Yii::$app->urlManager->createUrl(['camera/share','id'=>$id, 'targetname' => $model->username]), [
		        'class' => 'btn btn-success',
		        'data' => [
		            'method' => 'post',
		        ],
		    ]);
		} else {
		    echo Yii::t('yii', 'Please find a user by his/her correct username to start sharing.');
		}
		?>
	</div>
	<br>
	<div class="text-danger">
		<?=Html::tag('p', $error) ?>
	</div>

</div>

</div>