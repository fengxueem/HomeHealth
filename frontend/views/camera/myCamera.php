<?php

/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = Yii::t('yii', 'My Camera');
?>
<h1><?= Html::encode($this->title) ?></h1>
<p>
	<?= Html::a(Yii::t('yii', 'Create Camera'), ['create'], ['class' => 'btn btn-success']) ?>
</p>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'nickname',
                'content' => function ($model, $key, $index, $column) {
                    return Html::a(Yii::t('yii', $model->nickname), $model->url, ['target' => '_blank']);
                },
            ],
            'password',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{share} {update} {delete}',
                'buttons' => [
                    'share' => function($url, $model, $key){
                        $options = [
                            'title' => Yii::t('yii', 'Share this camera'),
                            'aria-label' => Yii::t('yii', 'Share this camera'),
                            'data-pjax' => '0',
                        ];
                        return Html::a('<span class="glyphicon glyphicon-share"></span>', $url, $options);
                    },
                ],
            ],
        ],
    ]); ?>