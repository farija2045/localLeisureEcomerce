<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'LOCAL LEISURE FINDER SYSTEM';
?>
<div class="leisure-index">

    <div class="jumbotron text-center bg-primary text-white mt-5 mb-5 p-5 rounded">
        <h1 class="display-4">Welcome to the Local Leisure Finder System!</h1>
        <p class="lead">Discover exciting leisure spots and activities near you!</p>
        <p><a class="btn btn-lg btn-light" href="https://www.google.com/maps/search/leisure+areas+near+me" target="_blank">Find Leisure Areas</a></p>
    </div>

    <div>
        <h2 class="text-center">Uploaded Entries</h2>
        <div class="row">
            <?php foreach (\app\models\AdminEntry::find()->all() as $entry): ?>
                <div class="col-lg-4 mb-4">
                    <div class="card hover-effect">
                        <a href="<?= Html::encode($entry->image_url) ?>" target="_blank">
                            <img src="<?= Yii::getAlias('@web') . '/' . $entry->image_path ?>" class="card-img-top" alt="<?= $entry->title ?>" style="max-height: 200px; object-fit: cover;">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title"><?= Html::encode($entry->title) ?></h5>
                            <p class="card-text"><?= Html::encode($entry->description) ?></p>

                            <?php if (!empty($entry->image_url)): ?>
                                <p>
                                    <a href="<?= Html::encode($entry->image_url) ?>" target="_blank" class="btn btn-secondary">Visit Link</a>
                                </p>
                            <?php endif; ?>

                            <!-- Existing View Details button -->
                            <a href="<?= Url::to(['leisure/image', 'id' => $entry->id]) ?>" class="btn btn-primary">View Details</a>

                            <!-- New: Booking and Contact Seller Buttons -->
                            <div class="mt-2 d-flex justify-content-between">
                                <?= Html::a('Book Now', ['leisure/book', 'entry_id' => $entry->id], ['class' => 'btn btn-success']) ?>
                                <?= Html::a('Contact Seller', ['leisure/contact-seller', 'entry_id' => $entry->id], ['class' => 'btn btn-info']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>
