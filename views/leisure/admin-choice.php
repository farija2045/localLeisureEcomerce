<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Welcome Admin';
?>

<div class="container mt-5">
    <div class="card p-4 shadow">
        <h3 class="mb-3">Welcome Admin!</h3>
        <p>Where would you like to go?</p>

        <div class="d-flex gap-3">
            <?= Html::a('Go to Admin Panel', ['admin/index'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Go to Upload Form', ['leisure/admin'], ['class' => 'btn btn-secondary']) ?>
        </div>
    </div>
</div>
