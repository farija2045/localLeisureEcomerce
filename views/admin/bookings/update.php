<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Booking $model */

$this->title = 'Update Booking: ' . $model->full_name;
$this->params['breadcrumbs'][] = ['label' => 'Bookings Management', 'url' => ['bookings']];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="booking-update mt-4 p-4 border rounded bg-white shadow-sm">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email')->input('email') ?>
    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'preferred_date')->input('date') ?>
    <?= $form->field($model, 'status')->dropDownList([
        'pending' => 'Pending',
        'confirmed' => 'Confirmed',
        'cancelled' => 'Cancelled',
    ], ['prompt' => 'Select status']) ?>
    <?= $form->field($model, 'notes')->textarea(['rows' => 4]) ?>

    <div class="form-group mt-3">
        <?= Html::submitButton('Update Booking', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Cancel', ['admin/bookings'], ['class' => 'btn btn-secondary ms-2']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
