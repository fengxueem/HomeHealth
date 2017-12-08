<?php

/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('yii', 'Sharing Camera');
?>
<h1><?= Html::encode($this->title) ?></h1>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'camera.nickname',
                'content' => function ($model, $key, $index, $column) {
                    if ($model->status != 1) {
                        return Html::a(Yii::t('yii', $model->camera->nickname), '#',['class' => 'btn disabled']);
                    } else {
                        return Html::a(Yii::t('yii', $model->camera->nickname), 'http://' . $model->camera->url, ['class' => 'btn', 'target' => '_blank']);
                    }
                },
            ],
            [
                'attribute' => 'status',
                'value' => 'status0.name',
                'filter' => \common\models\SharedCameraStatus::find()
                    ->select(['name', 'id'])
                    ->indexBy('id')
                    ->column(),
                // set vertical-align to middle in order to fit for the style of 'btn' 
                'contentOptions' => function ($model) {
                    if ($model->status == 3) {
                        return ['class' => 'danger', 'style' => 'vertical-align:middle'];
                    } elseif ($model->status == 2) {
                        return ['class' => 'info', 'style' => 'vertical-align:middle'];     
                    } else {
                        return ['style' => 'vertical-align:middle'];
                    }
                },
            ],
            [
                'attribute' => 'update_time',
                'format' => ['date', 'php:Y-m-d H:s'],
                // set vertical-align to middle in order to fit for the style of 'btn'
                'contentOptions' => function ($model) {
                    return ['style' => 'vertical-align:middle'];
                },
            ],
            [
                'attribute' => 'camera.password',
                'content' => function ($model, $key, $index, $column) {
                    if ($model->status == 2) {
                        return Yii::t('yii', 'Need to approve it to see the password');
                    } else {
                        return Yii::t('yii', $model->camera->password);
                    }
                },
                // set vertical-align to middle in order to fit for the style of 'btn'
                'contentOptions' => function ($model) {
                    return ['style' => 'vertical-align:middle'];
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{approve}{reject}{deleteshare}',
                // set vertical-align to middle in order to fit for the style of 'btn'
                'contentOptions' => function ($model) {
                    return ['style' => 'vertical-align:middle'];
                },
                'buttons' => [
                    'approve' => function($url, $model, $key){
                        $options = [
                            'title' => Yii::t('yii', 'Accept this camera'),
                            'aria-label' => Yii::t('yii', 'Accept this camera'),
                            'data-confirm' => Yii::t('yii', 'Do you want to accept this camera?'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ];
                        return Html::a('<span class="glyphicon glyphicon-ok"></span> ', $url, $options);
                    },
                    'reject' => function($url, $model, $key){
                        $options = [
                            'title' => Yii::t('yii', 'Reject this camera'),
                            'aria-label' => Yii::t('yii', 'Reject this camera'),
                            'data-confirm' => Yii::t('yii', 'Do you want to reject this camera?'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ];
                        return Html::a('<span class="glyphicon glyphicon-remove"></span> ', $url, $options);
                    },
                    'deleteshare' => function($url, $model, $key){
                        $options = [
                            'title' => Yii::t('yii', 'Delete this camera'),
                            'aria-label' => Yii::t('yii', 'Delete this camera'),
                            'data-confirm' => Yii::t('yii', 'Do you want to delete this camera?'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ];
                        return Html::a('<span class="glyphicon glyphicon-trash"></span> ', $url, $options);
                    },
                 ],
             ],
        ],
    ]); ?>