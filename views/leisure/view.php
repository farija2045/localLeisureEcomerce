<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\AdminEntries $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Leisure Entries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="leisure-view container mt-4">
    <h1><?= Html::encode($model->title) ?></h1>

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <p><strong>Description:</strong></p>
            <p><?= Html::encode($model->description) ?></p>

            <p><strong>Location:</strong> <?= Html::encode($model->location) ?></p>

            <?php if (!empty($model->link)): ?>
                <p><strong>Link:</strong> <?= Html::a($model->link, $model->link, ['target' => '_blank']) ?></p>
            <?php endif; ?>

            <p><strong>Posted At:</strong> <?= Yii::$app->formatter->asDatetime($model->created_at) ?></p>
        </div>
    </div>

    <div class="d-flex justify-content-between">
        <?= Html::a('Book Now', ['leisure/booking-form', 'entry_id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Contact Seller', ['leisure/contact-seller', 'entry_id' => $model->id], ['class' => 'btn btn-secondary']) ?>
    </div>
</div>
