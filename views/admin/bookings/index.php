<?php

use yii\helpers\Html;

/** @var \yii\web\View $this */
/** @var \yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Bookings Management';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0"><?= Html::encode($this->title) ?></h4>
        </div>
        <div class="card-body table-responsive">
            <?php if ($dataProvider->getCount() > 0): ?>
                <table class="table table-bordered table-striped table-hover align-middle">
                    <thead class="table-light sticky-top">
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Preferred Date</th>
                            <th>Status</th>
                            <th>Notes</th>
                            <th>Leisure Entry</th>
                            <th>Submitted At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dataProvider->models as $i => $booking): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= Html::encode($booking->full_name) ?></td>
                                <td><?= Html::encode($booking->email) ?></td>
                                <td><?= Html::encode($booking->phone) ?></td>
                                <td><?= $booking->preferred_date ? Html::encode($booking->preferred_date) : '<em>N/A</em>' ?></td>
                                <td><?= Html::encode($booking->status) ?></td>
                                <td><?= Html::encode($booking->notes) ?></td>
                                <td>
                                    <?= Html::a(
                                        'View Entry #' . Html::encode($booking->entry_id),
                                        ['leisure/view', 'id' => $booking->entry_id],
                                        ['target' => '_blank']
                                    ) ?>
                                </td>
                                <td><?= Yii::$app->formatter->asDatetime($booking->created_at) ?></td>
                                <td class="text-nowrap">
                                    <?= Html::a('Update', ['admin/update-booking', 'id' => $booking->id], [
                                        'class' => 'btn btn-sm btn-warning'
                                    ]) ?>
                                    <?= Html::a('Delete', ['admin/delete-booking', 'id' => $booking->id], [
                                        'class' => 'btn btn-sm btn-danger',
                                        'data' => [
                                            'confirm' => 'Are you sure you want to delete this booking?',
                                            'method' => 'post',
                                        ],
                                    ]) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-info">
                    No bookings found.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    thead th {
        position: sticky;
        top: 0;
        z-index: 10;
    }
</style>
