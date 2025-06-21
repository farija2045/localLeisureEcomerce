<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->title = 'UPLOAD FORM';

$this->registerCssFile('@web/css/custom.css');
?>
<div class="u-form">
<div class="admin-form-wrapper">
    <div class="admin-form ">
        <h1 class="adminform"><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'type')->dropDownList([
        'upper' => 'Upper',
        'middle' => 'Middle',
        'lower' => 'Lower',
    ], ['prompt' => 'Select Type']) ?>

    <?= $form->field($model, 'date')->input('date') ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_url')->textInput(['maxlength' => true, 'placeholder' => 'Enter image URL']) ?>

    <?= $form->field($model, 'images[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
    <?= $form->field($model, 'price')->input('number', [
    'step' => '0.01',
    'min' => '0',
    'placeholder' => 'Enter price for this place'
]) ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
</div>
</div>
