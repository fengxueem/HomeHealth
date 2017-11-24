<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CameraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cameras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="camera-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'url:url',
            'nickname',
            [
                'attribute' => 'owner_id',
                'value' => 'owner.nickname',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{updateviewers}{delete}',
                'buttons' => [
                    'updateviewers' => function($url, $model, $key) {
                        $options = [
                            'title' => Yii::t('yii', 'Update Viewers'),
                            'aria-label' => Yii::t('yii', 'Update Viewers'),
                            'data-pjax' => '0', // disable pjax
                        ];
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
