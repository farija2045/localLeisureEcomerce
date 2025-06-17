<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Booking $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="booking-form">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Please fill out the following fields to book your leisure spot:</p>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'booking_date')->input('date') ?>

    <?= $form->field($model, 'notes')->textarea(['rows' => 3]) ?>

    <?= Html::activeHiddenInput($model, 'entry_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Book Now', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
