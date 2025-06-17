<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
use app\models\RegisterForm;
?>

<div class="leisure-register">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email')->input('email') ?>
    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= Html::submitButton('Register', ['class' => 'btn btn-primary w-100']) ?>

    <?php ActiveForm::end(); ?>
</div>