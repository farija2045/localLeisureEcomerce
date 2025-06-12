<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = 'View User: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users & Image Count', 'url' => ['admin/users-image-count']];
$this->params['breadcrumbs'][] = $model->username;
?>

<div class="user-view container mt-4">
    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table table-bordered table-striped mt-3">
        <tr>
            <th>ID</th>
            <td><?= Html::encode($model->id) ?></td>
        </tr>
        <tr>
            <th>Username</th>
            <td><?= Html::encode($model->username) ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?= Html::encode($model->email) ?></td>
        </tr>
        <tr>
            <th>Role</th>
            <td><?= Html::encode($model->role) ?></td>
        </tr>
        <tr>
            <th>Created At</th>
            <td><?= Yii::$app->formatter->asDatetime($model->created_at) ?></td>
        </tr>
        <tr>
            <th>Updated At</th>
            <td><?= Yii::$app->formatter->asDatetime($model->updated_at) ?></td>
        </tr>
    </table>

    <p>
        <?= Html::a('Update', ['admin/update-user', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Back to List', ['admin/users-image-count'], ['class' => 'btn btn-secondary']) ?>
    </p>
</div>
