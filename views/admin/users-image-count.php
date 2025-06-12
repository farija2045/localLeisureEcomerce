<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Users & Image Count';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="container-fluid mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><?= Html::encode($this->title) ?></h4>
        </div>
        <div class="card-body table-responsive">
            <?php if (count($users) > 0): ?>
                <table class="table table-hover table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Image Count</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $index => $user): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= Html::encode($user['username']) ?></td>
                                <td><?= Html::encode($user['email']) ?></td>
                                <td><?= Html::encode($user['image_count']) ?></td>
                                <td>
                                    <?= Html::a('View', ['admin/view-user', 'id' => $user['id']], ['class' => 'btn btn-sm btn-info']) ?>
                                    <?= Html::a('Edit', ['admin/update-user', 'id' => $user['id']], ['class' => 'btn btn-sm btn-warning']) ?>
                                    <?= Html::a('Delete', ['admin/delete-user', 'id' => $user['id']], [
                                        'class' => 'btn btn-sm btn-danger',
                                        'data' => [
                                            'confirm' => 'Are you sure you want to delete this user?',
                                            'method' => 'post',
                                        ],
                                    ]) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-warning">No user data found.</div>
            <?php endif; ?>
        </div>
    </div>
</div>
