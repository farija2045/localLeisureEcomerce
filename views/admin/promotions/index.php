<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Promotions';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="promotion-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Promotion', ['admin/create-promotion'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php if ($dataProvider->getCount() > 0): ?>
        <table class="table table-bordered table-striped">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Entry ID</th>
                     <th>Discount Percent</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dataProvider->models as $i => $promotion): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= Html::encode($promotion->title) ?></td>
                        <td><?= Html::encode($promotion->description) ?></td>
                        <td><?= Html::encode($promotion->start_date) ?></td>
                        <td><?= Html::encode($promotion->end_date) ?></td>
                        <td><?= Html::encode($promotion->entry_id) ?></td>
                        <td><?= Html::encode($promotion->discount_percent) ?>%</td> 
                        <td><?= Yii::$app->formatter->asDatetime($promotion->created_at) ?></td>
                        <td>
                            <?= Html::a('Edit', ['admin/update-promotion', 'id' => $promotion->id], ['class' => 'btn btn-sm btn-primary']) ?>
                            <?= Html::a('Delete', ['admin/delete-promotion', 'id' => $promotion->id], [
                                'class' => 'btn btn-sm btn-danger',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this promotion?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No promotions found.</p>
    <?php endif; ?>
</div>
