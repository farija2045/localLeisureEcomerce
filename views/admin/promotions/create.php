<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Promotion $model */

$this->title = 'Create Promotion';
$this->params['breadcrumbs'][] = ['label' => 'Promotions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promotion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
