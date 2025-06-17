<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ResetPasswordForm $model */


$this->title = 'Reset Password';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="leisure-reset d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card p-4 shadow" style="width: 100%; max-width: 400px;">
<h1><?= Html::encode($this->title) ?></h1>

<p>Please choose your new password:</p>

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>

    <div class="form-group mt-3">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>
</div>
</div>