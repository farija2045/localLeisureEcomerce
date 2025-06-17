<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leisure-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'form-label'],
            'inputOptions' => ['class' => 'form-control'],
            'errorOptions' => ['class' => 'invalid-feedback'],
        ],
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'rememberMe')->checkbox([
        'template' => "<div class=\"form-check\">{input} {label}</div>\n{error}",
        'labelOptions' => ['class' => 'form-check-label'],
        'inputOptions' => ['class' => 'form-check-input'],
    ]) ?>

    <div class="form-group w-100">
        <?= Html::submitButton('Login', ['class' => 'btn btn-primary w-100', 'name' => 'login-button']) ?>
        <div class=" text-req" style="margin-top: 10px;">
            <?= Html::a('Forgot your password?', ['leisure/request-password-reset'], ['class' => 'text-secondary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

    <div class="text-center" style="color:#999; margin-top: 20px;">
        <p>Don't have an account? <?= Html::a('Register here', ['leisure/register'], ['class' => 'text-primary']) ?></p>
    </div>
</div>
