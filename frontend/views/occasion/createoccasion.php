<?php

use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
$title = Yii::t('yii', 'Create Occasion');
?>
<div class="occasion-create">

    <h1><?= Html::encode($title) ?></h1>

    <div class="occasion-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?=$form->field($model, 'str_start_time')->widget(DateTimePicker::classname(), 
        [
            'options' => ['placeholder' => Yii::t('yii', 'In 24H system')],
            'convertFormat' => true,
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-MM-dd HH:i',
                'todayHighlight' => true,
                'todayBtn' => true
            ]
        ]);?>
        
    <?=$form->field($model, 'str_end_time')->widget(DateTimePicker::classname(), 
        [
            'options' => ['placeholder' => Yii::t('yii', 'In 24H system')],
            'convertFormat' => true,
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-MM-dd HH:i',
                'todayHighlight' => true,
                'todayBtn' => true
            ]
        ]);?>

    <?= $form->field($model, 'illness')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hospital')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('yii', 'Create'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>