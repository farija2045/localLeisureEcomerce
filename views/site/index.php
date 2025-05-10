<?php

/** @var yii\web\View $this */

$this->title = 'LOCAL LEISURE FINDER SYSTEM';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-primary text-white mt-5 mb-5 p-5 rounded">
        <h1 class="display-4">Welcome to the Local Leisure Finder System!</h1>

        <p class="lead">Discover exciting leisure spots and activities near you!</p>

        <p><a class="btn btn-lg btn-light" href="https://www.google.com/maps/search/leisure+areas+near+me" target="_blank">Find Nearby Leisure Areas</a></p>
    </div>

    <!-- Include admin-entries content -->
    <div>
        <?= $this->render('admin-entries', [
            'entries' => \app\models\AdminEntry::find()->all(), // Fetch entries directly
        ]) ?>
    </div>

    <div class="body-content">

        <div class="row text-center">
            <div class="col-lg-4 mb-4">
                <h2 class="text-primary">Explore Activities</h2>

                <p>Find a variety of leisure activities tailored to your preferences, from outdoor adventures to relaxing retreats.</p>

                <p><a class="btn btn-outline-primary" href="#">Explore Now &raquo;</a></p>
            </div>
            <div class="col-lg-4 mb-4">
                <h2 class="text-primary">Discover Venues</h2>

                <p>Browse through a curated list of venues offering unique experiences for individuals, families, and groups.</p>

                <p><a class="btn btn-outline-primary" href="#">Discover More &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2 class="text-primary">Upcoming Events</h2>

                <p>Stay updated with the latest events happening in your area and never miss out on the fun!</p>

                <p><a class="btn btn-outline-primary" href="#">View Events &raquo;</a></p>
            </div>
        </div>

    </div>
</div>