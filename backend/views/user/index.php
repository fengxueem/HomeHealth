<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', Url::to('homehealth/frontend/web/index.php?r=site/signup', true), ['class' => 'btn btn-success', 'target' => '_blank']) ?>
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
                'attribute' => 'status',
                'value' => 'statusStr',
            ],
            [
                'attribute' => 'create_time',
                'format' => ['date', 'php: Y-m-d H'],
            ],
            [
                'attribute' => 'update_time',
                'format' => ['date', 'php: Y-m-d H:i:s'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{verify}{delete}',
                'buttons' => [
                    'verify' => function($url, $model, $key) {
                        $options = [
                            'data-method' => 'post',
                            'data-pjax' => '0', // disable pjax
                        ];
                        if ($model->status !== User::STATUS_ACTIVE) {
                            $options['title'] = Yii::t('yii', 'Activate User');
                            $options['aria-label'] = Yii::t('yii', 'Activate User');
                            $options['data-confirm'] = Yii::t('yii', 'Do you want to activate this user?');
                            return Html::a('<span class="glyphicon glyphicon-ok"></span>', $url, $options);
                        } else {
                            $options['title'] = Yii::t('yii', 'Deactivate User');
                            $options['aria-label'] = Yii::t('yii', 'Deactivate User');
                            $options['data-confirm'] = Yii::t('yii', 'Do you want to deactivate this user?');
                            return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, $options);
                        }
                    },
                ],
            ],
        ],
    ]); ?>
</div>
