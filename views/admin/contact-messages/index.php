<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Contact Messages';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="contact-messages-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if ($dataProvider->getCount() > 0): ?>
        <table class="table table-bordered table-hover">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Created At</th>
                    <th>Entry ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dataProvider->models as $i => $message): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= Html::encode($message->sender_name) ?></td>
                        <td><?= Html::encode($message->sender_email) ?></td>
                        <td><?= Html::encode(\yii\helpers\StringHelper::truncate($message->message, 60)) ?></td>
                        <td><?= Yii::$app->formatter->asDatetime($message->created_at) ?></td>
                        <td><?= Html::encode($message->entry_id) ?></td>
                        <td>
                            <?= Html::a('View', ['view', 'id' => $message->id], ['class' => 'btn btn-sm btn-primary']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No messages found.</p>
    <?php endif; ?>
</div>
