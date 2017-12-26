<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OccasionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Occasions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="occasion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Occasion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'start_time:datetime',
            'end_time:datetime',
            'illness',
            'hospital',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => ' {deleteendtime}{update} {delete}',
                'buttons' => [
                    'deleteendtime' => function($url, $model, $key){
                        $options = [
                            'title' => Yii::t('yii', 'Delete end time'),
                            'aria-label' => Yii::t('yii', 'Delete end time'),
                            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete end time?'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ];
                        return Html::a('<span class="glyphicon glyphicon-minus"></span>', $url, $options);
                    },
                ],
            ],
        ],
    ]); ?>
</div>