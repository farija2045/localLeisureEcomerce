<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var \app\models\Booking $model */
/** @var int $entry_id */

$this->registerCssFile('@web/css/booking-form.css');
?>

<div class="booking-form-container">
    <div class="booking-form">
        <h5>Book This Leisure Spot</h5>

        <?php $form = ActiveForm::begin([
            'action' => ['leisure/book', 'entry_id' => $entry_id],
            'method' => 'post',
        ]); ?>

        <?= $form->field($model, 'full_name')->textInput(['maxlength' => true, 'placeholder' => 'Your Full Name']) ?>
        <?= $form->field($model, 'email')->input('email', ['placeholder' => 'Your Email']) ?>
        <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'placeholder' => 'Phone Number']) ?>
        <?= $form->field($model, 'preferred_date')->input('date') ?>
        <?= $form->field($model, 'status')->dropDownList([
            'pending' => 'Pending',
            'confirmed' => 'Confirmed',
            'cancelled' => 'Cancelled',
        ]) ?>
        <?= $form->field($model, 'notes')->textarea(['rows' => 3, 'placeholder' => 'Additional notes (optional)']) ?>

        <div class="form-group mt-4 text-center">
            <?= Html::submitButton('Submit Booking', ['class' => 'btn btn-primary px-5 py-2 shadow-sm']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
