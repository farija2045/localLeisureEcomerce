<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Admin Form';
?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: rgba(121, 118, 118, 0.83); /* grey(100) */
    }
    form {
        font-family: Arial, sans-serif;
        max-width: 400px;
        margin: auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    input, textarea, select, button {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    input:focus, textarea:focus, select:focus {
        border-color: #007BFF;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    button {
        background-color: #007BFF;
        color: white;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #0056b3;
    }

    .image-preview {
        display: inline-block;
        margin-top: 10px;
        max-width: 100px;
        max-height: 100px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-right: 10px;
    }
</style>

<div class="admin-form">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

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

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>


