<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ContactMessage $model */

$this->title = 'Message from: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Contact Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-message-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <td><?= Html::encode($model->sender_name) ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?= Html::encode($model->sender_email) ?></td>
        </tr>
        <tr>
            <th>Message</th>
            <td><?= nl2br(Html::encode($model->message)) ?></td>
        </tr>
        <tr>
            <th>Entry ID</th>
            <td><?= Html::encode($model->entry_id) ?></td>
        </tr>
        <tr>
            <th>Created At</th>
            <td><?= Yii::$app->formatter->asDatetime($model->created_at) ?></td>
        </tr>
    </table>

    <p>
        <?= Html::a('Back to list', ['index'], ['class' => 'btn btn-secondary']) ?>
    </p>

</div>
