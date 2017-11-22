<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admins';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Admin', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'username',
            'nickname',
            'email:email',
            'phone',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}{resetpwd}{privilege}',
                'buttons' => [
                    'resetpwd' => function($url, $model, $key) {
                        $options = [
                            'title' => Yii::t('yii', 'Reset Password'),
                            'aria-label' => Yii::t('yii', 'Reset Password'),
                            'data-pjax' => '0', // disable pjax
                        ];
                        return Html::a('<span class="glyphicon glyphicon-edit"></span>', $url, $options);
                    },
                    'privilege' => function($url, $model, $key) {
                        $options = [
                            'title' => Yii::t('yii', 'Access Control'),
                            'aria-label' => Yii::t('yii', 'Access Control'),
                            'data-pjax' => '0', // disable pjax
                        ];
                        return Html::a('<span class="glyphicon glyphicon-lock"></span>', $url, $options);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
