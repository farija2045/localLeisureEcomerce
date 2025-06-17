<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Promotion $model */
/** @var array $entryList */
/** @var array $imageList */
?>

<div class="promotion-form promotion-form-container mt-4">

    <h3 class="text-center ">
        <?= $model->isNewRecord ? 'Create New Promotion' : 'Update Promotion' ?>
    </h3>

    <div class="promotion-form-center">
        <div class="promotion-form-box">
            <!-- Your form starts here -->
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>
            <?= $form->field($model, 'discount_percent')->input('number', ['min' => 0, 'max' => 100, 'step' => '0.1', 'placeholder' => 'Enter discount percent']) ?>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'start_date')->input('date') ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'end_date')->input('date') ?>
                </div>
            </div>
            <?= $form->field($model, 'entry_id')->dropDownList($entryList, ['prompt' => 'Select Entry']) ?>

            <div class="form-group mt-3">
                <?= Html::submitButton(
                    $model->isNewRecord ? 'Create' : 'Update',
                    [
                        'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
                    ]
                ) ?>
            </div>
            <?php ActiveForm::end(); ?>
            <!-- Your form ends here -->
        </div>
    </div>

</div>
