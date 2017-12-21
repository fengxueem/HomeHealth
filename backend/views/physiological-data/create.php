<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PhysiologicalDataType */

$this->title = 'Create Physiological Data Type';
$this->params['breadcrumbs'][] = ['label' => 'Physiological Data Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="physiological-data-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>