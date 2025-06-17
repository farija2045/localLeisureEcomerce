<?php
use yii\helpers\Html;

$this->title = Html::encode($entry->title ?? 'Entry Details');
?>

<div class="container image-page mt-4 u-form">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">

            <!-- Poster/Card Frame with hover effect -->
            <div class="entry-frame hover-effect p-3 rounded shadow-sm">
                <h1 class="text-center mb-4"><?= Html::encode($entry->title ?? 'Untitled') ?></h1>

                <!-- Image Carousel -->
                <div>
                    <h3 class="text-center">Images</h3>
                    <?php if (!empty($relatedImages)): ?>
                        <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <?php foreach ($relatedImages as $index => $image): ?>
                                    <button type="button" data-bs-target="#imageCarousel" data-bs-slide-to="<?= $index ?>" 
                                            class="<?= $index === 0 ? 'active' : '' ?>" 
                                            aria-current="<?= $index === 0 ? 'true' : 'false' ?>" 
                                            aria-label="Slide <?= $index + 1 ?>"></button>
                                <?php endforeach; ?>
                            </div>

                            <div class="carousel-inner">
                                <?php foreach ($relatedImages as $index => $image): ?>
                                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                        <img src="<?= Yii::getAlias('@web') . '/' . Html::encode($image->image_path) ?>" 
                                             alt="<?= Html::encode($entry->title ?? 'Image') ?>" 
                                             class="d-block w-100" 
                                             style="max-height: 400px; object-fit: contain;">
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <a class="carousel-control-prev" href="#imageCarousel" role="button" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#imageCarousel" role="button" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </a>
                        </div>
                    <?php else: ?>
                        <p class="text-center"><em>No images available for this entry.</em></p>
                    <?php endif; ?>
                </div>

                <!-- Description Section -->
                <div class="mt-4">
                    <p><strong>Description:</strong> <?= Html::encode($entry->description ?? 'No description available.') ?></p>
                    <p><strong>Type:</strong> <?= Html::encode($entry->type ?? 'N/A') ?></p>
                    <p><strong>Date:</strong> <?= Html::encode($entry->date ?? 'Unknown') ?></p>
                    <p><strong>Location:</strong> <?= Html::encode($entry->location ?? 'Not specified') ?></p>
                </div>
            </div>

        </div>
    </div>
</div>
