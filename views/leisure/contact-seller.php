<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var \yii\web\View $this */
/** @var \app\models\ContactMessage $model */
/** @var int $entry_id */

$this->title = 'Contact Seller';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('@web/css/contact-seller.css');
?>

<div class="contact-seller">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'action' => ['leisure/contact-seller', 'entry_id' => $entry_id],
        'method' => 'post',
    ]); ?>

    <?= $form->field($model, 'sender_name')->textInput(['maxlength' => true, 'placeholder' => 'Your full name']) ?>

    <?= $form->field($model, 'sender_email')->input('email', ['placeholder' => 'Your email address']) ?>

    <?= $form->field($model, 'message')->textarea(['rows' => 6, 'placeholder' => 'Write your message here']) ?>

    <div class="form-group">
        <?= Html::submitButton('Send Message', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
