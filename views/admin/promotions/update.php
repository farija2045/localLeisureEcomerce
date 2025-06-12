<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Promotion $model */

$this->title = 'Update Promotion: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Promotions', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="promotion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
