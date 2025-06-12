<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Promotion $model */
?>

<div class="promotion-form promotion-form-container mt-4">

    <h3>
        <?= $model->isNewRecord ? 'Create New Promotion' : 'Update Promotion' ?>
    </h3>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'start_date')->input('date') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'end_date')->input('date') ?>
        </div>
    </div>

    <?= $form->field($model, 'entry_id')->textInput() ?>

    <div class="form-group mt-3">
        <?= Html::submitButton(
            $model->isNewRecord ? 'Create' : 'Update',
            [
                'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            ]
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
