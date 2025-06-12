<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User[] $users */
/** @var string $search */

$this->title = 'Users & Image Count';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container py-4" style="padding-top: 100px;">
    <h1 class="mb-4"><?= Html::encode($this->title) ?></h1>

    <!-- Search form -->
    <?php $form = ActiveForm::begin([
        'method' => 'get',
        'action' => ['admin/index'],
        'options' => ['class' => 'mb-4 d-flex gap-2 justify-content-start flex-wrap'],
    ]); ?>
        <?= Html::input('text', 'search', $search ?? '', [
            'class' => 'form-control',
            'placeholder' => 'Search username or email...',
            'style' => 'max-width: 300px;',
        ]) ?>
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end(); ?>

    <div class="table-responsive shadow-sm rounded" style="max-height: 600px; overflow-y: auto;">
        <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-primary sticky-top">
                <tr>
                    <th style="width: 60px;">#</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th style="width: 120px;">Image Count</th>
                    <th style="width: 220px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">No users found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($users as $index => $user): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= Html::encode($user->username) ?></td>
                            <td><?= Html::encode($user->email) ?></td>
                            <td>
                                <?= Html::encode(
                                    // Count all images of all entries of the user
                                    array_sum(array_map(
                                        fn($entry) => count($entry->entryImages),
                                        $user->entries ?? []
                                    ))
                                ) ?>
                            </td>
                            <td>
                                <?= Html::a('View', ['admin/view-user', 'id' => $user->id], ['class' => 'btn btn-sm btn-info']) ?>
                                <?= Html::a('Edit', ['admin/update-user', 'id' => $user->id], ['class' => 'btn btn-sm btn-warning']) ?>
                                <?= Html::a('Delete', ['admin/delete-user', 'id' => $user->id], [
                                    'class' => 'btn btn-sm btn-danger',
                                    'data' => [
                                        'confirm' => 'Are you sure you want to delete this user?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    body {
        padding-top: 70px;
    }

    thead th {
        position: sticky;
        top: 0;
        z-index: 10;
    }
</style>
