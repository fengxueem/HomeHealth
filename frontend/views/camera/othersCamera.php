<?php

/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = Yii::t('yii', 'Sharing Camera');
?>
<h1><?= Html::encode($this->title) ?></h1>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'camera_id',
            'status',
            'update_time',
        ],
    ]); ?>