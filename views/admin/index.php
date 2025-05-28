<?php
use yii\helpers\Html;
?>

<h1>Users & Image Count</h1>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Username</th>
            <th>Email</th>
            <th>Image Count</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $index => $user): ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= Html::encode($user->username) ?></td>
                <td><?= Html::encode($user->email) ?></td>
                <td><?= count($user->entries) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
