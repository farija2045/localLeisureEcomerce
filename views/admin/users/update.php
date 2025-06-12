<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = 'Update User: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users & Image Count', 'url' => ['admin/users-image-count']];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="user-update container mt-4">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="card p-4 shadow-sm">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'email')->input('email') ?>
        <?= $form->field($model, 'role')->dropDownList([
            'user' => 'User',
            'admin' => 'Admin',
        ]) ?>

        <div class="form-group mt-3">
            <?= Html::submitButton('Save Changes', ['class' => 'btn btn-success']) ?>
            <?= Html::a('Cancel', ['admin/users-image-count'], ['class' => 'btn btn-secondary ms-2']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
