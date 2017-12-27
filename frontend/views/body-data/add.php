<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\PhysiologicalDataType;
use kartik\datetime\DateTimePicker;
use common\models\Occasion;

/* @var $this yii\web\View */
/* @var $model common\models\PhysiologicalDataEntry */

$this->title = 'Create Physiological Data Entry';
$this->params['breadcrumbs'][] = [
    'label' => 'Physiological Data Entries',
    'url' => [
        'index'
    ]
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="physiological-data-entry-create">

	<h1><?= Html::encode($this->title) ?></h1>

	<div class="physiological-data-entry-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'str_time')->widget(DateTimePicker::classname(), 
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

    <?= $form->field($model, 'value')->textInput() ?>

    <?= $form->field($model, 'type_id')->dropDownList(PhysiologicalDataType::find()->select(['name'])->indexBy('id')->column())?>

    <!-- occasion could be -->
    <?= $form->field($model, 'occasion_id')->dropDownList(Occasion::findOccasionsOfUserInArray($id))?>

    <div class="form-group">
        <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>