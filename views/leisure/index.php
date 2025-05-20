<?php

/** @var yii\web\View $this */

$this->title = 'LOCAL LEISURE FINDER SYSTEM';
?>
<div class="leisure-index">

    <div class="jumbotron text-center bg-primary text-white mt-5 mb-5 p-5 rounded">
        <h1 class="display-4">Welcome to the Local Leisure Finder System!</h1>

        <p class="lead">Discover exciting leisure spots and activities near you!</p>

        <p><a class="btn btn-lg btn-light" href="https://www.google.com/maps/search/leisure+areas+near+me" target="_blank">Find Leisure Areas</a></p>
    </div>

    <!-- Include admin-entries content -->
    <div>
        <h2 class="text-center">Uploaded Entries</h2>
        <div class="row">
            <?php foreach (\app\models\AdminEntry::find()->all() as $entry): ?>
                <div class="col-lg-4 mb-4">
                    <div class="card hover-effect"> <!-- Added hover-effect class -->
                        <!-- Display the uploaded image -->
                        <a href="<?= \yii\helpers\Html::encode($entry->image_url) ?>" target="_blank">
                            <img src="<?= Yii::getAlias('@web') . '/' . $entry->image_path ?>" class="card-img-top" alt="<?= $entry->title ?>" style="max-height: 200px; object-fit: cover;">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title"><?= \yii\helpers\Html::encode($entry->title) ?></h5>
                            <p class="card-text"><?= \yii\helpers\Html::encode($entry->description) ?></p>
                            
                            <!-- Add a clickable link for the image_url -->
                            <?php if (!empty($entry->image_url)): ?>
                                <p>
                                    <a href="<?= \yii\helpers\Html::encode($entry->image_url) ?>" target="_blank" class="btn btn-secondary">Visit Link</a>
                                </p>
                            <?php endif; ?>

                            <a href="<?= \yii\helpers\Url::to(['leisure/image', 'id' => $entry->id]) ?>" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>

