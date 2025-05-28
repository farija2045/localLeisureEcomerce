<?php
/* @var $users array */

use yii\helpers\Html;

?>

<h1>Users & Image Count</h1>

<table border="1" cellpadding="5" cellspacing="0">
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
            <td><?= Html::encode($index + 1) ?></td>
            <td><?= Html::encode($user['username']) ?></td>
            <td><?= Html::encode($user['email']) ?></td>
            <td><?= (int)$user['image_count'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
