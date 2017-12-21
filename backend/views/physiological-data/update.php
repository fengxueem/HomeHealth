<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PhysiologicalDataType */

$this->title = 'Update Physiological Data Type: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Physiological Data Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="physiological-data-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
