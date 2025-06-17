<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Promotion $model */
/** @var array $entryList */
/** @var array $imageList */


$this->params['breadcrumbs'][] = ['label' => 'Promotions', 'url' => ['index']];

?>
<div class="promotion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'entryList' => $entryList,
    
    ]) ?>

</div>
