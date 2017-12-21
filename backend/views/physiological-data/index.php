<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PhysiologicalDataTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Physiological Data Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="physiological-data-type-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Physiological Data Type', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'unit',
            'name',
            'description',
            'range_top',
            'range_bottom',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
